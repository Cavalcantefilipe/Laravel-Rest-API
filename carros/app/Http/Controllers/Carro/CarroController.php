<?php

namespace App\Http\Controllers\Carro;

use Illuminate\Http\Request;
use App\Services\Carro\CarroService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class CarroController extends Controller
{

    private $carroSrv;

    public function __construct(CarroService $carroSrv)
    {
        $this->carroSrv = $carroSrv;
    }

    public function getCarros()
    {
        $data = $this->carroSrv->getCarros();

        if (isset($data['error'])) {
            return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function getCarro(int $id)
    {
        $validacao = Validator::make(
            [
                'idCarro' => $id
            ],
            [
                'idCarro' => 'required|exists:carro,idCarro'
            ],
            [
                'required'    => 'O campo :attribute é obrigatório.',
                'exists'      => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->carroSrv->getCarro($id);
            return response()->json($data, Response::HTTP_OK);
        }
    }

    public function createCarro(Request $request)
    {
        $validacao = Validator::make(
            $request->all(),
            [
                'carro.*.nome'         => 'required|max:30',
                'carro.*.preco'         => 'required|numeric',
                'carro.*.idMarca'         => 'required|numeric|exists:marca,id'

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
				'numeric'      => 'O campo :attribute deve ser numérico.',
				'required'     => 'O campo :attribute é obrigatório.',
				'exists'       => 'O :attribute deve estar cadastrado.'
            ]
        );
        if ($validacao->fails()) {
            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            $data = $this->carroSrv->createCarro($request->all());
            if (isset($data['error'])) {
                return response()->json($data, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->json($data, Response::HTTP_OK);
            }
        }
    }

    public function updateCarro(int $id, Request $request)
    {

        $data = $request->all();

        $validacao = Validator::make(
            $data,
            [
                'nome'         => 'required|max:30',
                'preco'         => 'required|numeric',
                'idMarca'         => 'required|numeric|exists:marcas,id'

            ],
            [
                'max'          => 'O :attribute deve ter no maximo :max caracteres.',
				'numeric'      => 'O campo :attribute deve ser numérico.',
				'required'     => 'O campo :attribute é obrigatório.',
				'exists'       => 'O :attribute deve estar cadastrado.'
            ]
        );

        if ($validacao->fails()) {

            return response()->json($validacao->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $carro = $this->carroSrv->updateCarro($id,$data);

            if (isset($data['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }

    public function deleteCarro(int $id)
    {

        $validation = Validator::make(
            [
                'idCarro' => $id
            ],
            [
                'idCarro' => 'required|numeric|exists:carro,idCarro',
            ],
            [
                'numeric'      => 'O campo :attribute deve ser numérico.',
                'required' => 'O campo :attribute é obrigatório.',
                'exists' => 'O :attribute deve estar cadastrado.'
            ]
        );
        if ($validation->fails()) {

            return response()->json($validation->errors(), Response::HTTP_BAD_REQUEST);
        } else {

            $carro = $this->carroSrv->deleteCarro($id);

            if (isset($carro['error'])) {

                return response()->json($carro, Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {

                return response()->json($carro, Response::HTTP_OK);
            }
        }
    }
}
