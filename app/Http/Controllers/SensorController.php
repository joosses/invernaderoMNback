<?php

namespace App\Http\Controllers;

use App\invernadero;
use App\sensor;
use Illuminate\Http\Request;


class SensorController extends Controller
{
    //
    public function show($id){
        $sensor=sensor::find($id);

        if(is_object($sensor)){
            $data=[
                'code'=>200,
                'status'=>'success',
                'tiempo'=>$sensor->tiempo
            ];
        }else{
            $data=[
                'code'=>404,
                'status'=>'error',
                'message'=>'El tiempo  no existe'
            ];
        }
        return response()->json($data,$data['code']);
    }
    public function showTemperaturaMin($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->id;
        $sensor=sensor::where('nombre','temperatura')->where('invernadero_id_invernadero',$var)->first();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    
    public function showHumedadMin($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->id;
        $sensor=sensor::where('nombre','humedad')->where('invernadero_id_invernadero',$var)->first();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    public function showHumedadSueloMin($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->id;
        $sensor=sensor::where('nombre','humedadsuelo')->where('invernadero_id_invernadero',$var)->first();
        
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    public function showCo2Min($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->id;
        $sensor=sensor::where('nombre','co2')->where('invernadero_id_invernadero',$var)->first();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    public function update($id,Request $request){

        //Recoger datos por post
        $json=$request->input('json',null);
        $params_array=json_decode($json,true);

        if(!empty($params_array)){
            //Validar los datos s
            $validate=\Validator::make($params_array,[
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar
           
            //unset($params_array['id']);

            //actualizar el registro de modelo
            $sensor=sensor::where('id',$id)->update($params_array);

            $data=[
                'code'=>200,
                'status'=>'success',
                'sensor'=>$params_array
            ];

        }else{
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=> 'No has enviado ningun sensor.'
            ];
        }
        return response()->json($data,$data['code']);
    }

    public function nuevo(Request $request){
        
        //Recoger los datos por post
        $nombre = $request->input("nombre");
        $estado = $request->input("estado");
        $caracteristica = $request->input("caracteristica");
        $invernadero_id_invernadero = $request->input("invernadero_id_invernadero");
        $tiempo = $request->input("tiempo");
        $minimo = $request->input("minimo");
        $maximo = $request->input("maximo");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $sensor=new sensor();
        $sensor->nombre= $nombre;
        
        $sensor->estado= $estado;
        $sensor->caracteristica=$caracteristica;
        $sensor->invernadero_id_invernadero=$invernadero_id_invernadero;
        $sensor->tiempo=$tiempo;
        $sensor->minimo=$minimo;
        $sensor->maximo=$maximo;

        $sensor->save();

    }
    

    
    
}
