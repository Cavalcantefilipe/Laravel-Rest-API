<?php

namespace App\Repositories\Marca;

interface MarcaRepositoryInterface
{
    public function getMarcas();
    public function getMarca(int $id);
    public function createMarca(array $dados);
    public function updateMarca(int $id,array $dados);
    public function deleteMarca(int $id);
}
