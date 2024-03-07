<?php

namespace App\Models;

use App\Filters\BPOFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BPO extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = BPOFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
		'bpo_name',
		'profile_image',
		'office_image',
    ];


}
