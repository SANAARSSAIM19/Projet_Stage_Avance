<?php

namespace App\Imports;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/*class EmployeesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $employee = new Employee([
                'N°' => $row[0],
                'nom' => $row[1],
                'prenom' => $row[2],
                'gmail' => $row[3],
                'password' => $row[4],
                'deps_id' => $row[5],
                'posts_id' => $row[6],
                'Salair' => $row[7],
                // Ajoutez ici d'autres champs si nécessaire
            ]);
            $employee->save();
        }


      
    }
}*/


class EmployeesImport implements ToModel ,WithHeadingRow
{
    /** 
   * @param Collection $collection
   * */
public function model(array $row){
   
     return Employee::create([
       
       // 'N°' => $row['id'],
        'nom' => $row['nom'],
        'prenom' => $row['prenom'],
        'password' => $row['password'],
        'email' => $row['email'],
        'deps_id' => $row['deps_id'],
        'posts_id' => $row['posts_id'],
        'Salair' => $row['id'],
     ]);
    
    }
   
}

 
/*
    public function model(array $row){
        return new Employee([
            'id' => $row[0],
                'N°' => $row[1],
                'nom' => $row[2],
                'prenom' => $row[3],
                'password' => $row[4],
                'email' => $row[5],
                'deps_id' => $row[6],
                'posts_id' => $row[7],
                'Salair' => $row[8],
                
                // Ajoutez ici d'autres champs si nécessaire
            ]);
            
        }*/




