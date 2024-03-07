<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class BPOFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [];
}
