<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class JobPostingFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [];
}
