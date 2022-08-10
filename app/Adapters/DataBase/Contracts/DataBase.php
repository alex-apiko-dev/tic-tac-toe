<?php

namespace App\Adapters\DataBase\Contracts;

interface DataBase
{
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollBack(): void;
}
