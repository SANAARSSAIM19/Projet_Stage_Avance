<?php

namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Liste;

class ExcelController extends Controller
{

        public function import(Request $request)
        {

            Excel::load($request->file('file'), function($reader) {
                foreach ($reader->toArray() as $row) {
                    Liste::create([
                        'nom' => $row['nom'],
                        'description' => $row['description'],
                        // ...
                    ]);
                }
            });
    
            return redirect()->back()->with('success', 'Liste importée avec succès.');
        }

}
