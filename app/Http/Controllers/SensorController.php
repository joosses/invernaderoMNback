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
    public function showTemperatura(){
        $sensor=sensor::where('nombre','temperatura')->get('minimo');

        if(is_object($sensor)){
            $data=[
                'code'=>200,
                'status'=>'success',
                'tiempo'=>$sensor
            ];
        }else{
            $data=[
                'code'=>404,
                'status'=>'error',
                'message'=>'no existe minimo'
            ];
        }
        return response()->json($data,$data['code']);
    }
    
}
