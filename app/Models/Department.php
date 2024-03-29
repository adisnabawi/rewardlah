<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getTotalPointsAttribute()
    {
        return $this->users->sum('points');
    }

    public function getTotalEmployeesAttribute()
    {
        return $this->users->count();
    }
}
