<?php

namespace App\Models;

use App\Filters\CandidateFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Candidate extends Model
{
    use HasFactory, Filterable;

    protected string $default_filters = CandidateFilters::class;

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
		'subscription_type',
		'verified_status',
		'bpo_id',
		'profile_image',
		'resume',
    ];

    public function candidate_details()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
