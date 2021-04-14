<?php

namespace App\Repositories;

use App\Entities\NewsCollection;

interface NewsRepositoryInterface
{
    public function all(): NewsCollection;
}
