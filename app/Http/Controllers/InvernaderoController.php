<?php

namespace App\Http\Controllers;

use App\Invernadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvernaderoController extends Controller
{
    public function index()
    {
        $invernadero = Invernadero::all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'invernadero' => $invernadero
        ], 200);
    }

    public function lista()
    {
        $invernadero = Invernadero::all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'invernadero' => $invernadero
        ], 200);
    }

    public function tabla()
    {
        $invernadero = DB::table('invernadero')
            ->join('usuario', 'usuario_id_usuario', '=', 'usuario.id')
            ->select('invernadero.id', 'invernadero.usuario_id_usuario', 'cultivo', 'invernadero.placa', 'nombre', 'correo', 'chipid', 'estado')
            ->orderBy('nombre', 'desc')
            ->get();

        if (is_object($invernadero)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $invernadero
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El invernadero  no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function nuevo(Request $request)
    {
        //Recoger los datos por post
        $cultivo = $request->input("cultivo");
        $caracteristicas = $request->input("caracteristicas");
        $placa = $request->input("placa");
        $usuario_id_usuario = $request->input("usuario_id_usuario");
        $chipid = $request->input("chipid");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $invernadero = new invernadero();
        $invernadero->cultivo = $cultivo;

        $invernadero->caracteristicas = $caracteristicas;
        $invernadero->placa = $placa;
        $invernadero->usuario_id_usuario = $usuario_id_usuario;
        $invernadero->chipid = $chipid;

        $invernadero->save();
    }

    public function register(Request $request)
    {

        //recoger los datos del usuario enviados por post
        $json = $request->input('json', null);
        $params = json_decode($json);               //decodifica los datos en un objeto
        $params_array = json_decode($json, true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array = array_map('trim', $params_array);

        //validar datos
        if (!empty($params) && !empty($params_array)) {
            $validate = Validator::make($params_array, [
                'cultivo'      => 'required|alpha',
            ]);

            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code'   => 404,
                    'message' => 'El invernadero no se ha creado',
                    'errores' => $validate->errors()
                );
            } else {
                //crear el invernadero
                $invernadero = new invernadero();
                $invernadero->cultivo = $params_array['cultivo'];
                $invernadero->caracteristicas = $params_array['caracteristicas'];
                $invernadero->placa = $params_array['placa'];
                $invernadero->usuario_id_usuario = $params_array['usuario_id_usuario'];
                $invernadero->chipid = $params_array['chipid'];

                //guardar el usuario
                $invernadero->save();

                $data = array(
                    'status' => 'success',
                    'code'   => 200,
                    'message' => 'El invernadero se ha creado',
                    'invernadero'   => $invernadero
                );
            }
        } else {
            $data = [
                'status' => 'error',
                'code'   => 404,
                'message' => 'Los datos no se han ingresado correctamente',
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function crear(Request $request)
    {
        //recoger los datos del usuario enviados por post
        $json = $request->input('json', null);
        //$params=json_decode($json);               //decodifica los datos en un objeto
        $params_array = json_decode($json, true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array = array_map('trim', $params_array);

        //validar datos
        if (!empty($params_array)) {
            $validate = Validator::make($params_array, [
                'cultivo'   => 'required',
                'caracteristicas'   => 'required',
                'placa'     => 'required'


            ]);

            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code'   => 404,
                    'message' => 'El invernadero no se ha creado',
                    'errores' => $validate->errors()
                );
            } else {
                //crear el ivernadero
                $invernadero = new invernadero();
                $invernadero->cultivo = $params_array['cultivo'];
                $invernadero->caracteristicas = $params_array['caracteristicas'];
                $invernadero->placa = $params_array['placa'];
                $invernadero->usuario_id_usuario = ['usuario_id_usuario'];
                $invernadero->chipid = ['chipid'];

                //guardar el invernadero
                $invernadero->save();

                $data = array(
                    'status' => 'success',
                    'code'   => 200,
                    'message' => 'El invernadero se ha creado',
                    'invernadero'   => $invernadero
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code'   => 404,
                'message' => 'Los datos no se han ingresado correctamente',
            );
        }

        return response()->json($data, $data['code']);
    }

    public function show(int $id)
    {
        $invernadero = Invernadero::find($id);

        if (is_object($invernadero)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $invernadero
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El invernadero  no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function update(int $id, Request $request)
    {

        //Recoger datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            //Validar los datos
            Validator::make($params_array, [
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar
            unset($params_array['id']);

            //actualizar el registro de modelo
            Invernadero::where('id', $id)->update($params_array);

            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $params_array
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No has enviado ningun invernadero.'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function buscar(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->get();

        if (is_object($invernadero)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $invernadero
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El invernadero  no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function buscarDos(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->get();

        if (is_object($invernadero)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $invernadero
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El invernadero  no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function buscarNombre(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->get();

        if (is_object($invernadero)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'invernadero' => $invernadero
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El invernadero no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }
}
