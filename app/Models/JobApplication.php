<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = ['job_listing_id', 'candidate_id', 'employer_id', 'interview_id', 'status'];

    public function interview()
    {

    }

    public function job_listing()
    {
        return $this->belongsTo(JobListing::class, 'job_listing_id', 'id');
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }
}
