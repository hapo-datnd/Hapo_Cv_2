<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name', 'adress', 'is_verified',
    ];

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class);
    }
}
