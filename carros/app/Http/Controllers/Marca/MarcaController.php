<?php

namespace App\Http\Controllers\Marca;

use Illuminate\Http\Request;
use App\Services\Marca\MarcaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class MarcaController extends Controller
{

    private $marcaSrv;

    public function __construct(MarcaService $marcaSrv)
    {
        $this->marcaSrv = $marcaSrv;
    }

    public function getMarcas()
    {
        $data = $this->marcaSrv->getMarcas();

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getMarca(int $id)
    {
        $validacao = Validator::make(
            ['id' => $id],
            [
                'id' => 'required|exists:marcas,id'
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'exists'      => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $marca = $this->marcaSrv->getMarca($id);
            return response()->json($marca, Response::HTTP_OK);
        }
    }

    public function createMarca(Request $request)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'marca.*.nome'         => 'required|max:60',
                'marca.*.pais'         => 'sometimes|max:60',
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'max'         => 'O :attribute deve ter no maximo :max caracteres',
            ]
        );
        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $marca = $this->marcaSrv->createMarca($request->all());
            if (isset($marca['error'])) {
                return response()->json($marca, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($marca, Response::HTTP_OK);
            }
        }
    }

    public function updateMarca(int $id, Request $request)
    {

        $data = $request->all();

        $validacao = Validator::make(
            $data,
            [
                'nome'  => 'required|max:60',
                'pais'  => 'sometimes|max:60',
            ],
            [
                'required'  => 'O campo :attribute é obrigatório.',
                'numeric'   => 'O campo :attribute deve ser numérico.',
                'exists'    => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {

            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $marca = $this->marcaSrv->updateMarca($id,$data);

            if (isset($data['error'])) {

                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function deleteMarca(int $id)
    {

        $validation = Validator::make(
            [
                'id' => $id
            ],
            [
                'id' => 'required|numeric|exists:marcas,id',
            ],
            [
                'required' => 'O campo :attribute é obrigatório.',
                'exists' => 'O :attribute deve estar cadastrado.'
            ]
        );
        if ($validation->fails()) {

            return response()->json($validation->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $marca = $this->marcaSrv->deleteMarca($id);

            if (isset($marca['error'])) {

                return response()->json($marca, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($marca, Response::HTTP_OK);
            }
        }
    }
}
