<?php

namespace App\Http\Controllers;

use App\Actuador;
use App\Invernadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActuadorController extends Controller
{
    //
    public function update($id, Request $request)
    {

        //Recoger datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            //Validar los datos
            $validate = Validator::make($params_array, [
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar
            unset($params_array['id']);

            //actualizar el registro de modelo
            $actuador = Actuador::where('id', $id)->update($params_array);

            $data = [
                'code' => 200,
                'status' => 'success',
                'actuador' => $params_array
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No has enviado ningun actuador.'
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Show all the "Actuador" instances
     * @return mixed
     */
    public function index()
    {
        $marcas = Actuador::all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'actuador' => $marcas
        ], 200);
    }

    /**
     * Show a single "actuador"
     * @param   int  $id
     * @return mixed
     */
    public function show(int $id)
    {
        $actuador = Actuador::find($id);

        if (is_object($actuador)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'tiempo' => $actuador->estado
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El usuario no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Show a light control
     * @param int $id
     * @return mixed
     */
    public function showLuz(int $id)
    {
        $invernadero = invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $actuador = Actuador::where('nombre', 'luz')->where('invernadero_id_invernadero', $var)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $actuador
        ], 200);
    }

    public function showAgua(int $id)
    {
        $invernadero = invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;

        $actuador = Actuador::where('nombre', 'agua')->where('invernadero_id_invernadero', $var)->get();


        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $actuador
        ], 200);
    }

    public function showExtractor(int $id)
    {
        $invernadero = invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;

        $actuador = Actuador::where('nombre', 'extractor')->where('invernadero_id_invernadero', $var)->get();


        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $actuador
        ], 200);
    }

    public function showExtractor2(int $id)
    {
        $invernadero = invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;

        $actuador = Actuador::where('nombre', 'ventilador2')->where('invernadero_id_invernadero', $var)->get();


        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $actuador
        ], 200);
    }

    /**
     * Reset the time.
     * @param   int      $id     
     * @param   Request  $request
     * @return  mixed
     */
    public function resetTiempo(int $id, Request $request)
    {


        //Recoger datos por post

        $json = $request->input('json', null);


        $params_array = json_decode($json, true);
        //$auxiliar->estado=0;


        if (!empty($params_array)) {
            //Validar los datos
            $validate = Validator::make($params_array, [
                'id' => 'required',
            ]);

            //quitar los datos que no quiero actualizar

            unset($params_array['id']);

            //actualizar el registro de modelo
            $params_array['estado'] = 0;

            $actuador = Actuador::where('id', $id)->update($params_array);

            $data = [
                'code' => 200,
                'status' => 'success',
                'actuador' => $params_array
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No has enviado ningun actuador aguaaaaa.'
            ];
        }

        return response()->json($data, $data['code']);
    }

    public function register(Request $request)
    {

        //recoger los datos del Sensor enviados por post
        $json = $request->input('json', null);
        $params = json_decode($json);               //decodifica los datos en un objeto
        $params_array = json_decode($json, true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array = array_map('trim', $params_array);

        //validar datos
        if (!empty($params) && !empty($params_array)) {

            $validate = Validator::make($params_array, [
                'nombre'      => 'required|alpha',
                'invernadero_id_invernadero'   => 'required|numeric',
            ]);

            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code'   => 404,
                    'message' => 'El Actuador no se ha creado',
                    'errores' => $validate->errors()
                );
            } else {

                //crear el Actuador
                $act = new actuador();

                $act->estado = $params_array['estado'];
                $act->nombre = $params_array['nombre'];
                $act->caracteristica = $params_array['caracteristica'];
                $act->invernadero_id_invernadero = $params_array['invernadero_id_invernadero'];

                //guardar el Sensor
                $act->save();

                $data = array(
                    'status' => 'success',
                    'code'   => 200,
                    'message' => 'El Actuador se ha creado',
                    'usuario'   => $act
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
}
