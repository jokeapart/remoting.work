<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class CandidateFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [];
}
