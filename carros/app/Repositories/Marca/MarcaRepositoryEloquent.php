<?php

namespace App\Repositories\Marca;

use App\Repositories\Marca\MarcaRepositoryInterface;
use App\Models\Marca;


class MarcaRepositoryEloquent implements MarcaRepositoryInterface
{
    private $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function getMarcas()
    {
        $query = $this->marca->select();
        return $query->get();
    }

    public function getMarca(int $id)
    {
        return $this->marca->select()
            ->where('id', $id)
            ->first();
    }

    public function createMarca(array $dados)
    {
        return $this->marca->create($dados);
    }

    public function updateMarca(int $id, array $dados)
    {
        return $this->marca
            ->where('id', $id)
            ->update($dados);
    }

    public function deleteMarca(int $id)
    {
        $query = $this->marca->find($id);
        return $query->delete();
    }
}
