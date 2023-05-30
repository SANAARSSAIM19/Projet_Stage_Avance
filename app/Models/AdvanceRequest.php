<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceRequest extends Model
{
    use HasFactory;



    protected $table = 'advance_requests';

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }
}
