<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use App\Models\Code;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CodeController extends Controller
{

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
        $codes=Code::all();
        return $codes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $code_obj=new Code();
        $code_obj->code=$request->code;
        $code_obj->user_id=auth()->id();
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $code_obj->save();
        return response()->json([
            'message' => '¡Code creado exitosamente!',
            'user' => $code_obj
        ], 200);
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
        $code=Code::findOrFail($request->id);
        return $code;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $code_obj=Code::findOrFail($request->id);
        $code_obj->code=$request->code;
        $code_obj->user_id=auth()->id();

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'user_id' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $code_obj->save();

        return response()->json([
            'message' => '¡Code modificado exitosamente!',
            'user' => $code_obj
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
        Code::destroy($request->id);
        return response()->json([
            'message' => '¡Code eliminado exitosamente!'
        ], 204);
    }


    public function mayorCantidadCodigos(Request $request)
    {
        # code...
        $user = DB::table('users')
            ->join('codes', 'users.id', '=', 'codes.user_id')
            ->select('users.id', 'users.name','users.dni')
            ->groupBy('users.id')
            ->orderByRaw('COUNT(users.id) DESC')
            ->first();
        return $user;
    }
}
