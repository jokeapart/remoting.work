<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobListing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['employer_id', 'title', 'description', 'skills_required', 'requirements', 'status', 'location', 'type'];

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }
}
