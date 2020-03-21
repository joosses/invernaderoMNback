<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\medicion;
use App\invernadero;
use Carbon\Traits\Timestamp;
use Mockery\Matcher\Any;

class MedicionController extends Controller
{
    //
    
    public function index(){
        $medicions=medicion::all()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicions
        ],200);
    }
    public function show($id){
        $medicions=medicion::find($id);

        if(is_object($medicions)){
            $data=[
                'code'=>200,
                'status'=>'success',
                'estado'=>$medicions->estado
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
    

    public function grafica(){
        $medicions=medicion::all();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicions
        ],200);
    }
    public function graficaTemperatura($id){
        
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','temperatura')->where('chipid',$var)->get();
        


        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    public function graficaHumedad($id){
        
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','humedad')->where('chipid',$var)->get();
        


        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    public function graficaHumedadSuelo($id){
        
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','humedad suelo')->where('chipid',$var)->get();
        


        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    public function graficaCo2($id){
        
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','co2')->where('chipid',$var)->get();
        


        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
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
/*
    public function index(Request $request){
        
        //Recoger los datos por post
        $json=$request->input('json',null);
        $params_array=json_decode($json,true);

        if(!empty($params_array)){
            //validar los datos
            $validate=\Validator::make($params_array,[
                'valor' => 'required',
                'chipid'=> 'required'
                
             
            ]);

            //guardar el estudiante
            if($validate->fails()){
                $data=[
                    'code'=>400,
                    'status'=>'error',
                    'message'=> 'No se ha guardado la entrevista.'
                ];
            }else{
                //en caso de no haber errores, guarda el estudiante en la base de datos
                $medicion=new medicion();
                $medicion->valor= $params_array['valor'];
                $tiempo = date('Y-m-d H:i:s');
                $medicion->tiempo= $tiempo;
                $medicion->chipid= $params_array['chipid'];

                $medicion->save();

                $data=[
                    'code'=>200,
                    'status'=>'success',
                    'medicion'=> $medicion
                ];
            }
        }else{
            $data=[
                'code'=>400,
                'status'=>'error',
                'message'=> 'No has enviado ninguna entrevista.'
            ];
        }
        return response()->json($data,$data['code']);
    }*/

    public function medicionTemperatura(Request $request){
        
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");
        
        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion=new medicion();
        $medicion->valor= $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo= $tiempo;
        $medicion->chipid= $chipid;
        $medicion->nombre="Temperatura";
        $medicion->save();

    }
    public function medicionHumedad(Request $request){
        
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");
        
        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion=new medicion();
        $medicion->valor= $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo= $tiempo;
        $medicion->chipid= $chipid;
        $medicion->nombre="Humedad";
        $medicion->save();

    }
    public function medicionSuelo(Request $request){
        
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");
        
        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion=new medicion();
        $medicion->valor= $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo= $tiempo;
        $medicion->chipid= $chipid;
        $medicion->nombre="Humedad Suelo";
        $medicion->save();

    }
    public function medicionCo2(Request $request){
        
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");
        
        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion=new medicion();
        $medicion->valor= $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo= $tiempo;
        $medicion->chipid= $chipid;
        $medicion->nombre="Co2";
        $medicion->save();

    }
      
        
    

    public function prueba( ){
        $data="";
        if(isset($_POST['chipid'])){
         $chipid=$_POST['chipid'];
        $valor= $_POST['valor'];
        
 
        $medicion=new medicion();
        $medicion->chipid= $chipid;
        $medicion->valor=  $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo= $tiempo;
 
        $medicion->save();
    
     
        $data=[
        'code'=>200,
        'status'=>'success',
        'message'=> 'LO himos we.',
        'medicion'=> $medicion
    ];

}else{
    $medicion=new medicion();
       $medicion->chipid= 2;
       $medicion->valor=  2;
       $tiempo = date('Y-m-d H:i:s');
       $medicion->tiempo= $tiempo;

       $medicion->save();

}
$data=[
    'code'=>400,
    'status'=>'error',
    'message'=> 'No has enviado ninguna entrevista.'
];  
    }
    public function ultimaTemperatura($id){
        
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','temperatura')->where('chipid',$var)->get()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    
    public function ultimaHumedad($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','humedad')->where('chipid',$var)->get()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    public function ultimaHumedadSuelo($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','humedad suelo')->where('chipid',$var)->get()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }
    public function ultimaCo2($id){
        $invernadero=invernadero::where('usuario_id_usuario',$id)->first();
        $var = $invernadero->chipid;
        $medicion=medicion::where('nombre','co2')->where('chipid',$var)->get()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'medicion'=>$medicion
        ],200);
    }

    



}
