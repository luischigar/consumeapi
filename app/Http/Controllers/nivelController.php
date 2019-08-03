<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nivel;

class nivelController extends Controller
{
    /**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="API nivel",
 *     version="1.0.0"
 *   )
 * )
 */
    public function index()
    {
        $nivel= Nivel::all();
        return response()->json(['nivel'=>$nivel, 'code'=>'200']) ; 
    }

    /**
 * @SWG\Get(
 *   path="/nivel",
 *   tags={"Nivel"},
 *   summary="nivel",
 *   operationId="getCustomerRates1",
 *   @SWG\Response(response=200, description="successful operation"),
 *   @SWG\Response(response=406, description="not acceptable"),
 *   @SWG\Response(response=500, description="internal server error")
 * )
 *
 */
    /**
     * @SWG\Post(
     *   path="/nivel",
     *   tags={"Nivel"},
     *   summary="Ingresar Nivel",
     *   operationId="getCustomerRates2",
     *   @SWG\Parameter(
     *     name="descripcion",
     *     in="formData",
     *     description="ingresar la descripcion",
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
        if(empty($request->descripcion)) {

            return response()->json(['message'=>'Todos los campos son reueridos', 'code'=>'406']);
        }

        $nivel = new Nivel();
        $nivel->descripcion=$request->descripcion;
        $nivel->save();
        return response()->json(['message'=>'nivel creado correctamente', 'code'=>'201']);
    }
    /**
     * @SWG\Get(
     *   path="/nivel/{id}",
     *   tags={"Nivel"},
     *   summary="obtener Nivel",
     *   operationId="getRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar id del nivel",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="el id de Nivel existe"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Put(
     *   path="/nivel/{id}",
     *   tags={"Nivel"},
     *   summary="actualizar Nivel",
     *   operationId="sharedRed",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar id del nivel",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="descripcion",
     *     in="formData",
     *     description="ingresar la descripcion",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="datos obtenidos correctamente"),
     *   @SWG\Response(response=404, description="Nivel no encontrado"),
     *   @SWG\Response(response=422, description="no se permiten valores nulos"),
     * )
     *
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
     * @SWG\Delete(
     *   path="/nivel/{id}",
     *   tags={"Nivel"},
     *   summary="eliminar nivel",
     *   operationId="deleteRedes",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="ingresar el id que va a eliminar",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Nivel eliminada correctamente"),
     *   @SWG\Response(response=404, description="Nivel no encontrada"),
     * )
     *
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
