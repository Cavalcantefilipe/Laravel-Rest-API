<?php

namespace App\Services\Marca;

use Illuminate\Database\QueryException;
use App\Repositories\Marca\MarcaRepositoryInterface as Marca;

class MarcaService
{

    private $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function getMarcas()
    {
        try {
            return $this->marca->getMarcas();
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function getMarca(int $id)
    {
        try {
            return $this->marca->getMarca($id);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function createMarca(array $dados)
    {
        try{
            return $this->marca->createMarca($dados);
        } catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function updateMarca(int $id, array $dados)
    {
        try {
            return $this->marca->updateMarca($id,$dados);
        }catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function deleteMarca(int $id)
    {

        try {
            return $this->marca->deleteMarca($id);
        }catch (QueryException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
