<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class EmployerFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [];
}
