<?php

namespace App\Http\Controllers;

use App\actuador;
use Illuminate\Http\Request;


class ActuadorController extends Controller
{
    //
    public function update($id,Request $request){

        //Recoger datos por post
        $json=$request->input('json',null);
        $params_array=json_decode($json,true);

        if(!empty($params_array)){
            //Validar los datos
            $validate=\Validator::make($params_array,[
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar
           
            unset($params_array['id']);

            //actualizar el registro de modelo
            $actuador=actuador::where('id',$id)->update($params_array);

            $data=[
                'code'=>200,
                'status'=>'success',
                'actuador'=>$params_array
            ];

        }else{
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=> 'No has enviado ningun actuador.'
            ];
        }
        return response()->json($data,$data['code']);
    }
    public function index(){
        $marcas=actuador::all();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'actuador'=>$marcas
        ],200);
    }
    public function show($id)
    {
        $actuador = actuador::find($id);


        if (is_object($actuador)) {
            $data = array(
                'code'=>200,
                'status' => 'success',
                'estado' => $actuador->estado
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'El usuario no existe'
            );
        }
        return response()->json($data, $data['code']);
    }
    public function showLuz(){
        $actuador=actuador::where('nombre','luz')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$actuador
        ],200);
    }
    public function showAgua(){
        $actuador=actuador::where('nombre','agua')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$actuador
        ],200);
    }
    public function showExtractor(){
        $actuador=actuador::where('nombre','extractor')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$actuador
        ],200);
    }
    public function resetTiempo($id,Request $request){


        //Recoger datos por post
       
        $json=$request->input('json',null);
       
        
        $params_array=json_decode($json,true);
        //$auxiliar->estado=0;
        

        if(!empty($params_array)){
            //Validar los datos
            $validate=\Validator::make($params_array,[
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar
           
            unset($params_array['id']);

            //actualizar el registro de modelo
            $params_array['estado']=0;
            
            $actuador=actuador::where('id',$id)->update($params_array);
           
            $data=[
                'code'=>200,
                'status'=>'success',
                'actuador'=>$params_array
            ];

        }else{
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=> 'No has enviado ningun actuador aguaaaaa.'
            ];
        }
        
        return response()->json($data,$data['code']);
    }
    public function register(Request $request)
    {

        //recoger los datos del Sensor enviados por post
        $json=$request->input('json',null);
        $params=json_decode($json);               //decodifica los datos en un objeto
        $params_array=json_decode($json,true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array=array_map('trim',$params_array);

        //validar datos
        if(!empty($params) && !empty($params_array)){

            $validate=\Validator::make($params_array,[
                'nombre'      =>'required|alpha',
                'invernadero_id_invernadero'   =>'required|numeric',
            ]);

            if($validate->fails()){
                $data=array(
                    'status' =>'error',
                    'code'   =>404,
                    'message'=>'El Actuador no se ha creado',
                    'errores'=>$validate->errors()
                );
            }else{
                
                //crear el Actuador
                $act=new actuador();
               
                $act->estado=$params_array['estado'];
                $act->nombre=$params_array['nombre'];
                $act->caracteristica=$params_array['caracteristica'];
                $act->invernadero_id_invernadero=$params_array['invernadero_id_invernadero'];
                
                
                
                //guardar el Sensor
                $act->save();

                $data=array(
                    'status' =>'success',
                    'code'   =>200,
                    'message'=>'El Actuador se ha creado',
                    'usuario'   =>$act
                );
            }

        }else{
            $data=array(
                'status' =>'error',
                'code'   =>404,
                'message'=>'Los datos no se han ingresado correctamente',
            );
        }

        return response()->json($data,$data['code']);

       
    }

    
}
