<?php

namespace App\Repositories\Carro;

use App\Repositories\Carro\CarroRepositoryInterface;
use App\Models\Carro;


class CarroRepositoryEloquent implements CarroRepositoryInterface
{
    private $carro;

    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    public function getCarros()
    {
        $query = $this->carro->select();
        return $query->get();
    }

    public function getCarro(int $id)
    {
        return $this->carro->select()
            ->where('idCarro', $id)
            ->first();
    }

    public function createCarro(array $dados)
    {
        return $this->carro->create($dados);
    }

    public function updateCarro(int $id, array $dados)
    {
        return $this->carro
            ->where('idCarro', $id)
            ->update($dados);
    }

    public function deleteCarro(int $id)
    {
        $query = $this->carro->find($id);
        return $query->delete();
    }
}
