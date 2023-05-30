<?php

namespace App\Models;
use App\Models\Dep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Maatwebsite\Excel\Concerns\ToModel;
class Employee extends Authenticatable 
{
 
    use Notifiable;
   

    protected $fillable = [
        'N°','nom','prenom', 'email', 'password','deps_id','posts_id','Salair'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function dep(){
        return $this->belongsToMany(Dep::class);
    }
    public function post(){
        return $this->belongsToMany(Post::class);
    }
   /* public function scopeWithDepartement($query){
      
        return  $query->join('deps','employees.deps_id','=','deps.id')
        ->select('employees.*','deps.nom as dept_nom');
    }*/
  

}

