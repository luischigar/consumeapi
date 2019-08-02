<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;

class nivelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nivel= Nivel::all();
        return response()->json(['nivel'=>$nivel, 'code'=>'200']) ; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->descripcion)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }

        $nivel = new Nivel();
        $nivel->descripcion=$request->descripcion;
        $nivel->save();
        return response()->json(['message'=>'nivel creado correctamente', 'code'=>'201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nivel= Nivel::find($id);
       if((empty($nivel))){
        return response()->json(['message'=>'nivel no encontrado', 'code'=>'404']) ;
       }

       return response()->json(['nivel'=>$nivel, 'code'=>'200']) ;
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
        if(empty($request->descripcion)) {

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }


        $nivel=Nivel::find($id);
        if(empty($nivel)){

                return response()->json(['message'=>'nivel no encontrado', 'code'=>'404']);
        }
        
        $nivel->descripcion=$request->descripcion;
        $nivel->update();
        return response()->json(['message'=>'nivel actualizado', 'code'=>'200']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(empty($id)) {

            return response()->json(['message'=>'el id es obligatorio', 'code'=>'406']);
        }


        $nivel=Nivel::find($id);
        if(empty($nivel)){

                return response()->json(['message'=>'nivel no encontrado', 'code'=>'404']);
        }
        
        $nivel->delete();

        return response()->json(['message'=>'nivel borrado', 'code'=>'200']);
    }
}
