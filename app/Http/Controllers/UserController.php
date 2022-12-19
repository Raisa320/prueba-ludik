<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{

    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::all();
        return $users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $user=User::findOrFail($request->id);
        return $user;
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $user=User::findOrFail($request->id);
        echo($request->input('name'));
        $user->name=$request->input('name');
        $user->lastname=$request->lastname;
        $user->dni=$request->dni;
        $user->email=$request->email;
        if ($request->has('password')) $user->password = bcrypt($request->input('password'));
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'dni' => 'required|string|min:8',
            'email' => 'required|string|email|max:100|unique:users',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        
        $user->save();
        return response()->json([
            'message' => '¡Usuario modificado exitosamente!',
            'user' => $user
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        User::destroy($request->id);
        return response()->json([
            'message' => '¡Usuario eliminado exitosamente!'
        ], 204);
    }


    public function usuariosRegistradosFecha(Request $request)
    {
        $total = User::all()->count();
        $fecha_inicio=$request->fecha_inicio;
        $fecha_fin=$request->fecha_fin;
        $users_count = User::whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get()->count();
        $porcentaje=($users_count*100)/$total;
        return response()->json([
            'ok' => true,
            'porcentaje' =>  number_format((float)$porcentaje, 2, '.', '')
        ], 200);
    }
}
