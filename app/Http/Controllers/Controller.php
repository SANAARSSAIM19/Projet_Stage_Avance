<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Employee;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
class EmployeeController extends Controller
{
    public function index()
    {
        $employees =Employee::all();
        return view('employees.index',compact('employees'));
    }

   /* public function index(Employee $employee)
    {
        $deps =$employee->deps;
        return view('employees.index',compact('employees','deps'));
    }*/

}
