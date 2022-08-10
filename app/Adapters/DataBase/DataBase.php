<?php

namespace App\Adapters\DataBase;

use App\Adapters\DataBase\Contracts\DataBase as Contract;
use Illuminate\Support\Facades\DB;

final class DataBase implements Contract
{
    public function beginTransaction(): void
    {
        DB::beginTransaction();
    }

    public function commit(): void
    {
        DB::commit();
    }

    public function rollBack(): void
    {
        DB::rollBack();
    }
}
