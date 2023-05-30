<?php

namespace App\Http\Controllers;
/*use App\Http\Controllers\Post;*/
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeesImport;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Dep;
use App\Models\Post;
use App\Models\Type;
use App\Models\AdvanceRequest;
use Carbon\Carbon;
use App\Models\Remboursement;
use PhpParser\Node\Expr\PostInc;
use App\Models\Example;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
      use Dompdf\Dompdf;
      use PDF;
      use App\Mail\ContactReply;
      use App\Models\Contact;
     
      use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
     
     

     public function showContacts()
     {
         $contacts = Contact::all();
         return view('reponse', compact('contacts'));
     }
     
     public function sendeReplyy($contactId, Request $request)
     {
         $contact = Contact::findOrFail($contactId);
     
         // Envoyer la réponse par e-mail à l'employé
         $replyMessage = $request->input('reply_message');
         Mail::to($contact->email)->send(new ContactReply($replyMessage));
     
         // Marquer le contact comme ayant reçu une réponse
         $contact->replied = true;
         $contact->save();
     
         return redirect()->back()->with('success', 'Réponse envoyée avec succès');
     }
     

     /*public function generatePDF()
     {
         // Récupérer les données à partir de la base de données pour la table approvesment
         $remboursements = Remboursement::all();
         
         // Créer une vue avec les données récupérées
         $pdf_view = view('pdf.d_accepter_gestionnaire', compact('remboursements'));
     
         // Générer le PDF à partir de la vue
         $pdf = new Dompdf();
         $pdf->loadHtml($pdf_view);
         $pdf->setPaper('A4', 'portrait');
         $pdf->render();
     
         // Télécharger le fichier PDF
         return $pdf->stream('pdf.d_accepter_gestionnaire');
     }*/

     


  
     
        /* public function export()
         {
             // Récupérez les données de la table de remboursement
             $remboursements = Remboursement::all();
     
             // Créez une instance de Dompdf
             $dompdf = new Dompdf();
     
             // Générez le contenu du fichier PDF
             $html = view('d_accepter_gestionnaire', compact('remboursements'))->render();
             $dompdf->loadHtml($html);
             $dompdf->setPaper('A4');
     
             // Rendez le contenu du fichier PDF
             $dompdf->render();
             $output = $dompdf->output();
     
             // Retournez le fichier PDF en tant que réponse HTTP
             return new Response($output, 200, [
                 'Content-Type' => 'application/pdf',
                 'Content-Disposition' => 'inline; filename="remboursements.pdf"'
             ]);
         }*/
     
     



    public function d_accepter_gestionnaire()
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
    return view('d_accepter_gestionnaire', compact('remboursements'));
}

/*public function importRemboursement(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        // Valider et importer le fichier Excel
        try {
            Excel::import(new Remboursement, $file);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Une erreur s\'est produite lors de l\'importation du fichier.');
        }

        return redirect()->back()->with('success', 'Le fichier de remboursement a été importé avec succès.');
    }*/




    public function index()
    {
        $countemployee = Employee::count();
        $countdemande = AdvanceRequest::count();
        $countdepartement = Dep::count();
        $countpost = Post::count();
        return view('home', compact('countemployee','countdemande','countdepartement','countpost'));
      
    }
    




    public function demanderecus()
{
    $demandes = AdvanceRequest::all();
    return view('les_demande_gestionnaire/demandes_recues', compact('demandes'));
}
public function updatedemanderecus(Request $request, $id)
{
    $demande = AdvanceRequest::findOrFail($id);
    $demande->etat = $request->etat;
    $demande->save();
    if($demande->etat == '1'){
        $this->calculerEcheances($demande->id,$demande->type_id,$demande->advance_amount);
     }
    return redirect('demandes_recues');
}
 

    public function calculerEcheances($id,$type_id,$advance_amount)
    {
  
       
        $premiere_echeance = now()->addMonth();

        switch ($type_id) {
            case '1': //Avance de congé
                $derniere_echeance = $premiere_echeance->copy()->addMonth();
                $periode_echeance = '1 month';
                break;
            case '2'://Avance de Aïd ELADHA
                $derniere_echeance = $premiere_echeance->copy()->addMonths(10);
                $periode_echeance = '10 months';
                break;
            case '3'://Avance de les affaires sociales
                $derniere_echeance = $premiere_echeance->copy()->addMonths(20);
                $periode_echeance = '20 months';
                break;
            default:
                return response()->json(['message' => 'Type d\'avance non reconnu.']);
        }

        // Enregistrer les échéances dans la table remboursements
        $montant_initial = $advance_amount;
        $retenue = $montant_initial / $derniere_echeance->diffInMonths($premiere_echeance);
        $solde_fin = $montant_initial; 
        for ($date_echeance = $premiere_echeance; $date_echeance < $derniere_echeance; $date_echeance = $date_echeance->add($periode_echeance)) {
            $remboursement = new Remboursement;
                $remboursement->id_demande=$id;
                $remboursement->premiere_echance=$premiere_echeance;
                $remboursement->derniere_echance=$derniere_echeance;
                $remboursement->retenue=$retenue;
                $remboursement->solde_fin=$solde_fin- $retenue;
               
               $remboursement->save();
        }
    }


    public function exportRemboursement()
    {
        return Excel::download(new Remboursement, 'remboursements.xlsx');
    }








   /* public function showEmployees(Request $request)
{
    $employees = Employee::query();

    if ($request->has('dep')) {
        $deps_id = $request->input('dep');
        $employees = $employees->where('deps_id', $deps_id);
    }

    $employees = $employees->get();
    $deps = Dep::all();

    return view('employees.indexx', compact('employees', 'deps'));
}*/


public function displayEmployees(Request $request)
{
    // Récupération de la liste des départements
    $deps = Dep::all();
    
    // Création de la requête pour récupérer tous les employés
    $employeesQuery = Employee::query();
    
    // Si un département a été sélectionné, on ajoute une condition à la requête pour filtrer par ce département
    if ($request->has('deps_id')) {
        $employeesQuery->where('deps_id', $request->input('deps_id'));
    }else{
        $employees = Employee::all();
    }
    
    // Récupération des employés en fonction de la requête
    $employees = $employeesQuery->get();
    
    // Retourne la vue "employees.index" avec les employés et les départements récupérés, ainsi que la requête actuelle
    return view('employees.indexx', [
        'employees' => $employees,
        'deps' => $deps,
        'request' => $request,
    ]);
}


   
        /* public function displayEmployees(Request $request)
            {
                $employee = Employee::all();
                $deps = Dep::all();
                return view('employees.indexx', compact('employees','deps'));
            }*/
     
    /*public function index()
    {
        $employees= Employee::withDept()->get();

        return view('employees.index',['employees'=> $employees]);
    }*/

    public function show()
    {
        $employees=Employee::whereHas('deps',function($query){
            $query->where('nom','=','deps_id');
        })->get();
        return view('employees.show',compact('employees'));
    }

   /* public function show()
    {
        $employees=Employee::with(dept)->get();
        return view('employees.show',compact('employees'));
    }*/


    /*public function _createee()
    {
        return view('employees.create');
    }*/

    public function _createee()
    {
        $deps = Dep::all();
        $posts = Post::all();
        return view('employees.create',compact('deps','posts'));
    }
    public function _createeedep()
    {
        $deps = Dep::all();
    
        return view('departement.create',compact('deps'));
    }
    public function _createeepost()
    {
        $deps = Dep::all();
        $posts = Post::all();
        return view('post.create',compact('deps','posts'));
    }
    
    public function afficherDonnees(Request $request)
    {
        $donnees = Dep::all();
    
        return view('departement/index', compact('donnees'));
    }
    public function afficherDonneespost(Request $request)
    {
        $donnees = Post::all();
        
        return view('post/index', compact('donnees'));
    }


    public function store(Request $request)
    {
       
        $employee = new Employee;
        $employee->N° = $request->N°;
        $employee->nom = $request->nom;
        $employee->prenom = $request->prenom;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->deps_id = $request->deps_id;
        $employee->posts_id = $request->posts_id;
        $employee->Salair = $request->Salair;
        $employee->save();

        
        //return redirect('/employees');
        return redirect()->back()->with('success', 'L\'enregistrement a été créé avec succès.');

        

    }
   

    public function storedep(Request $request)
    {

        $departement = new Dep;
        $departement->nom = $request->input('nom');
        $departement->save();
        return redirect('/departement');
    }

    public function storepost(Request $request)
    {
        $post = new Post;
        $post->nom = $request->input('nom');
        $post->deps_id = $request->input('deps_id');
        $post->save();
        return redirect('/post');
    }
    public function edit($id)
    {  
        $post =Post::find($id);
        $departement =Dep::find($id);
        $employee =Employee::find($id);
        return view('employees.edit',compact('employee','post','departement'));
    }
    public function editdep($id)
    {
        
        $departement =Dep::find($id);
        return view('departement.edit',compact('departement'));
    }
    public function editpost($id)
    {
        $post =Post::find($id);
        $deps =Dep::find($id);
        return view('post.edit',compact('deps','post'));
    }
    /*public function index($id)
    {
        
        $employee =Employee::findOrFail($id);
        return view('home',compact('employee'));
    }*/
     public function update(Request $request ,$id)
    {
        
        $employee =Employee::find($id);
        $departement =Dep::find($id);
        $post =Post::find($id);
        $employee->N° = $request->input('N°');
        $employee->nom    = $request->input('nom');
        $employee->prenom = $request->input('prenom');
        $employee->email  = $request->input('email');
        $employee->password = $request->input('password');
        $employee->deps_id = $request->input('deps_id');
        $employee->posts_id = $request->input('posts_id');
        $employee->Salair = $request->input('Salair');
        $employee->save();
        return redirect()->back()->with('success', 'L\'enregistrement a été modifier avec succès.');
    }

        public function updatedep(Request $request ,$id)
        {
            
            $departement =Dep::find($id);
            $departement->nom = $request->input('nom');
            $departement->save();
    
            return redirect('/departement');    }
            public function updatepost(Request $request ,$id)
            {
                
                $deps =Dep::find($id);
                $post =Post::find($id);
               
                $post->nom = $request->input('nom');
                $deps->deps_id = $request->input('deps_id');
               
                $post->save();
            
        
                return redirect('/post');    }
    /*
    public function update(Request $request, $id){
        $post =Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect()->back()->with('success','Post mis a jour avec succes');

    }*/

    
    public function delete($id){
        $employee=Employee::findOrFail($id);
        $employee->delete();

               return redirect()->back()->with('success', 'L\'enregistrement a été supprimer avec succès.');
 
    }
    public function deletedep($id){
        $departement=Dep::findOrFail($id);
        $departement->delete();
        return redirect()->back()->with('success', 'L\'enregistrement a été supprimer avec succès.');

    }
    public function deletepost($id){
        $post=Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'L\'enregistrement a été supprimer avec succès.');

    }


   /* public function import(Request $request){
        $request->validate([
            'file' => 'required| mimes:xls,xlsx'
        ]);
        Excel::import(new EmployeesImport,$request->file('file'));
        return redirect('/employees');
    }*/
     
   /* public function importuser(Request $request)
{
    $file = $request->file('file');
   // $excel = Excel::load($file)->get();
    $excel=Excel::import($file) ;
    if (!empty($excel)) {
        foreach ($excel as $key => $value) {
            $insert[] = [
                'id' => $value[0],
                'N°' => $value[1],
                'nom' => $value[2],
                'prenom' => $value[3],
                'password' => $value[4],
                'email' => $value[5],
                'deps_id' => $value[6],
                'posts_id' => $value[7],
                'Salair' => $value[8], 
            ];
        }

        if (!empty($insert)) {
            Employee::insert($insert);
            return redirect()->back()->with('success', 'File imported successfully.');
        }
    }

    return redirect()->back()->with('error', 'File not imported.');
}
*/
public function importusere()
     {
         return view('employees.import');
     }
     


public function importuser(Request $request)
{
    $file = $request->file('fichier');
    Excel::import(new EmployeesImport, $file);
    
    return redirect()->back()->with('success', 'Importation terminée avec succès.');
}






     
public function importdep(Request $request)
{
    $file = $request->file('file');
    $excel = Excel::load($file)->get();
      
    if (!empty($excel) && $excel->count()) {
        foreach ($excel as $key => $value) {
            $insert[] = [
                'nom'     => $value[0], 
            ];
        }

        if (!empty($insert)) {
            Dep::insert($insert);
            return redirect()->back()->with('success', 'File imported successfully.');
        }
    }

    return redirect()->back()->with('error', 'File not imported.');
}


public function importpost(Request $request)
{
    $file = $request->file('file');
    $excel = Excel::load($file)->get();

    if (!empty($excel) && $excel->count()) {
        foreach ($excel as $key => $value) {
            $insert[] = [
                'nom'     => $value[0], 
            ];
        }

        if (!empty($insert)) {
            Post::insert($insert);
            return redirect()->back()->with('success', 'File imported successfully.');
        }
    }

    return redirect()->back()->with('error', 'File not imported.');
}
}

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        