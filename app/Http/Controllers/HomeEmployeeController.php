<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\AdvanceRequest;
use App\Models\Remboursement;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use App\Models\Employee;
use App\Models\Dep;
use App\Models\Post;
use App\Models\Type;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use PhpParser\Node\Expr\PostInc;
use App\Models\Example;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeEmployeeController extends Controller
{
   

   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


     public function info()
     {
         
         return view('info');
     }



     public function contact()
     {
 
         return view('contact_us');
     }
 
     public function storecontact(Request $request)
     {
         $request->validate([
             'nom' => 'required',
             'prenom' => 'required',
             'email' => 'required|email',
             'objet' => 'required',
             'message' => 'required',
         ]);
 
         Contact::create($request->all());
 
         // Envoyer un e-mail de confirmation à l'employé
         $data = [
             'nom' => $request->nom,
             'prenom' => $request->prenom,
             'email' => $request->email,
             'objet' => $request->objet,
             'message' => $request->message,
         ];
 
        
        } 












    public function dashboard()
    {
        $accepter = AdvanceRequest::where('etat', '1')->count();
        $refuser = AdvanceRequest::where('etat', '0')->count();
        $traitment = AdvanceRequest::where('etat', '-1')->count();


        $count = AdvanceRequest::count();
        return view('dashboard', compact('count','accepter','refuser','traitment'));
      
    }

  
    public function d_accepter_employee()
    {


    // Récupérer tous les enregistrements de la table de remboursement
    $remboursements = Remboursement::all();
    // Pour chaque enregistrement, mettre à jour le solde fin en fonction de la période de remboursement
    foreach ($remboursements as $remboursement) {
        // Mettre à jour le solde fin pour chaque mois de remboursement
        $dateCourante = Carbon::parse($remboursement->premiere_echeance)->addMonth();
        while ($dateCourante <= Carbon::parse($remboursement->derniere_echeance)) {
            $remboursement->solde_fin -= $remboursement->retenue;
            $remboursement->save();
            $dateCourante->addMonth();
        }
    }

    // Passer les données à la vue
    return view('d_accepter_employee', compact('remboursements'));
}

    

    public function demander()
    {

        return view('demander');
    }
  

    public function suivi()
    {
    
        return view('suivi');
    }


    

    public function create()
    {
        $employees = Employee::all();
        $types = Type::all();
        return view('demander',compact('employees','types'));
    }
    public function stores(Request $request)
    {
      
        $user = Auth::guard('employee')->user();
        
    
  // Récupérer l'employé connecté
  $employee = Employee::findOrFail($user->id);

  // Récupérer le salaire de l'employé
  $salaire = $employee->Salair;

  // Récupérer le montant saisi dans le formulaire de demande
  $montantDemande = $request->input('advance_amount');

  // Vérifier si le montant est supérieur à 50% du salaire
  if ($montantDemande > ($salaire * 0.5)) {
      return redirect()->back()->with('error', 'Le montant demandé est supérieur à 50% de votre salaire. Veuillez demander un montant inférieur.');
  }

        $demandeAvance = new AdvanceRequest;
        $demandeAvance->employee_id = $user->id;
        $demandeAvance->type_id = $request->type_id;
        $demandeAvance->advance_amount = $request->advance_amount;
        $demandeAvance->comments = $request->comments;
        $demandeAvance->save();
        return redirect()->back()->with('success', 'Votre demande a été soumise avec succès.');


       // return redirect('demander')->with('success', 'La demande d\'avance a été enregistrée avec succès.');
    }
    
 
 

    


public function afficherType(Request $request)
{
    $types = Type::all();

    return view('type', compact('types'));
}
    
}
