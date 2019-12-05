<?php

namespace App\Http\Controllers;

use App\invernadero;
use Illuminate\Http\Request;

class InvernaderoController extends Controller
{
    //
    public function index(){
        $invernadero=invernadero::all()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'invernadero'=>$invernadero
        ],200);
    }
    public function nuevo(Request $request){
        
        //Recoger los datos por post
        $cultivo = $request->input("cultivo");
        $caracteristicas = $request->input("caracteristicas");
        $placa = $request->input("placa");
        $usuario_id_usuario = $request->input("usuario_id_usuario");
        
        //en caso de no haber errores, guarda la medicion en la base de datos
        $invernadero=new invernadero();
        $invernadero->cultivo= $cultivo;
        
        $invernadero->caracteristicas= $caracteristicas;
        $invernadero->placa=$placa;
        $invernadero->usuario_id_usuario=$usuario_id_usuario;
        $invernadero->save();

    }
    public function crear(Request $request)
    {

        //recoger los datos del usuario enviados por post
        $json=$request->input('json',null);
        //$params=json_decode($json);               //decodifica los datos en un objeto
        $params_array=json_decode($json,true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array=array_map('trim',$params_array);

        //validar datos
        if(!empty($params_array)){

            $validate=\Validator::make($params_array,[
                'cultivo'   =>'required',
                'caracteristicas'   =>'required',
                'placa'     =>'required'
                
                
            ]);

            if($validate->fails()){
                $data=array(
                    'status' =>'error',
                    'code'   =>404,
                    'message'=>'El invernadero no se ha creado',
                    'errores'=>$validate->errors()
                );
            }else{
                
             
                //crear el ivernadero
                $invernadero=new invernadero();
                $invernadero->cultivo=$params_array['cultivo'];
                $invernadero->caracteristicas=$params_array['caracteristicas'];
                $invernadero->placa=$params_array['placa'];
                $invernadero->usuario_id_usuario=['usuario_id_usuario'];
              
                
                
                //guardar el invernadero
                $invernadero->save();

                $data=array(
                    'status' =>'success',
                    'code'   =>200,
                    'message'=>'El invernadero se ha creado',
                    'invernadero'   =>$invernadero
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
    public function show($id){
        $invernadero=invernadero::find($id);

        if(is_object($invernadero)){
            $data=[
                'code'=>200,
                'status'=>'success',
                'invernadero'=>$invernadero
            ];
        }else{
            $data=[
                'code'=>404,
                'status'=>'error',
                'message'=>'El invernadero  no existe'
            ];
        }
        return response()->json($data,$data['code']);
    }
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
            $invernadero=invernadero::where('id',$id)->update($params_array);

            $data=[
                'code'=>200,
                'status'=>'success',
                'invernadero'=>$params_array
            ];

        }else{
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=> 'No has enviado ningun invernadero.'
            ];
        }
        return response()->json($data,$data['code']);
    }
}
