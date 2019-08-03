<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiantes;
use App\Nivel;

class estudiantesController extends Controller
{

    /**
 * @SWG\Get(
 *   path="/estudiantes",
 *   tags={"Estudiantes"},
 *   summary="estudiantes",
 *   operationId="getCustomerRates1",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */
    public function index()
    {
        $estudiantes= Estudiantes::all();
        return response()->json(['estudiantes'=>$estudiantes, 'code'=>'200']) ;
    }

    /**
     * @SWG\Post(
     *   path="/estudiantes",
     *   tags={"Estudiantes"},
     *   summary="Ingresar estudiantes",
     *   operationId="getCustomerRates2",
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="ingresar la nombre",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="ingresar la apellido",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="ingresar la apellido",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="nivelid",
     *     in="formData",
     *     description="ingresar la nivelid",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="not found"),)
     * )
     *
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
     * @SWG\Get(
     *   path="/estudiantes/{id}",
     *   tags={"Estudiantes"},
     *   summary="obtener Estudintes",
     *   operationId="getRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar id del Estudiantes",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="el id de Estudiantes existe"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Put(
     *   path="/estudiantes/{id}",
     *   tags={"Estudiantes"},
     *   summary="actualizar Estudiantes",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar id del Estudiantes",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="nombre",
     *     in="formData",
     *     description="ingresar la nombre",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="apellido",
     *     in="formData",
     *     description="ingresar la apellido",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="cedula",
     *     in="formData",
     *     description="ingresar la cedula",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Parameter(
     *     name="nivelid",
     *     in="formData",
     *     description="ingresar la nivelid",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="Estudiantes no encontrado"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Delete(
     *   path="/estudiantes/{id}",
     *   tags={"Estudiantes"},
     *   summary="eliminar Estudiantes",
     *   operationId="deleteRedes",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar el id que va a eliminar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Estudiantes eliminada correctamente"),
     *   @SWG\Response(response=404, description="Estudiantes no encontrada"),
     * )
     *
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
