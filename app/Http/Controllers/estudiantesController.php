<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiantes;
use App\Nivel;

class estudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes= Estudiantes::all();
        return response()->json(['estudiantes'=>$estudiantes, 'code'=>'200']) ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->nombre) || empty($request->apellido)|| empty($request->cedula) || empty($request->nivelid)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }

        $nivel= Nivel::find($request->nivelid);
       if((empty($nivel))){
        return response()->json(['message'=>'nivel no encontrado en la base de datos', 'code'=>'404']) ;
       }

        $estudiantes = new Estudiantes();
        $estudiantes->nombre=$request->nombre;
        $estudiantes->apellido=$request->apellido;
        $estudiantes->cedula=$request->cedula;
        $estudiantes->nivelid=$request->nivelid;
        $estudiantes->save();
        return response()->json(['message'=>'Estudiante creado correctamente', 'code'=>'201']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiantes= Estudiantes::find($id);
           if((empty($estudiantes))){
            return response()->json(['message'=>'estudiantes no encontrado', 'code'=>'404']) ;
           }

           return response()->json(['estudiantes'=>$estudiantes, 'code'=>'200']) ;
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
        if(empty($request->nombre) || empty($request->apellido)|| empty($request->cedula) || empty($request->nivelid)) {

            return response()->json(['message'=>'Todos los campos son requeridos', 'code'=>'406']);
        }

        $nivel= Nivel::find($request->nivelid);
       if((empty($nivel))){
        return response()->json(['message'=>'nivel no encontrado en la base de datos', 'code'=>'404']) ;
       }
        $estudiantes=Estudiantes::find($id);
        if(empty($estudiantes)){

                return response()->json(['message'=>'estudiantes no encontrado', 'code'=>'404']);
        }
        
        $estudiantes->nombre=$request->nombre;
        $estudiantes->apellido=$request->apellido;
        $estudiantes->cedula=$request->cedula;
        $estudiantes->nivelid=$request->nivelid;
        $estudiantes->save();
        return response()->json(['message'=>'Producto actualizado', 'code'=>'200']);
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


        $estudiantes=Estudiantes::find($id);
        if(empty($estudiantes)){

                return response()->json(['message'=>'estudiantes no encontrado', 'code'=>'404']);
        }
        
        $estudiantes->delete();

        return response()->json(['message'=>'estudiantes borrado', 'code'=>'200']);
    }
}
