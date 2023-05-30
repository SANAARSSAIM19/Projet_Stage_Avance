<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    
    public function _createee()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = new Employee;
        $employee->nom = $request->nom;
        $employee->prenom = $request->prenom;
        $employee->N° = $request->N°;
        $employee->deps_id = $request->deps_id;
        $employee->poste = $request->poste;
        $employee->Salair = $request->Salair;
        $employee->save();

        return redirect('/employees');
    }
}
