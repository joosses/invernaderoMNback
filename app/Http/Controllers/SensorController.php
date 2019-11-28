<?php

namespace App\Http\Controllers;

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
    public function showTemperaturaMin(){
        $sensor=sensor::where('nombre','temperatura')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    
    public function showHumedadMin(){
        $sensor=sensor::where('nombre','humedad')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    public function showHumedadSueloMin(){
        $sensor=sensor::where('nombre','humedadsuelo')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }
    public function showCo2Min(){
        $sensor=sensor::where('nombre','co2')->get()->last();

        return response()->json([
            'code'=>200,
            'status'=>'success',
            'tiempo'=>$sensor
        ],200);
    }

    
    
}
