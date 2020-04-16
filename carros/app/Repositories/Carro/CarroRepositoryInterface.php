<?php

namespace App\Repositories\Carro;

interface CarroRepositoryInterface
{
    public function getCarros();
    public function getCarro(int $id);
    public function createCarro(array $dados);
    public function updateCarro(int $id,array $dados);
    public function deleteCarro(int $id);
}
