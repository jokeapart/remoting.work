<?php

namespace App\Models;

use App\Filters\JobPostingFilters;
use Essa\APIToolKit\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class JobPosting extends Model
{
    use HasFactory, Filterable;

    //protected string $default_filters = JobPostingFilters::class;
    protected $table = 'jobPostings';

    /**
     * Mass-assignable attributes.
     *
     * @var array
     */
    protected $fillable = [
        'employer_id',
		'title',
		'description',
		'skills_required',
		'requirements',
		'application_status',
    ];


}
