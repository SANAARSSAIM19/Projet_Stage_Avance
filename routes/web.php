<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeEmployeeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Autha\EmployeeAuthController;
use App\Http\Controllers\Auth\EmployeeloginController;
use App\PDF\RemboursementPDF;

use App\Http\Controllers\EmployeesLoginController;
use App\Models\Employee;
use App\Models\Dep;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/








Route::get('/demandes_recues', [App\Http\Controllers\HomeController::class, 'demanderecus'])->name('les_demande_gestionnaire.demanderecus');
Route::put('/demandes_recues/{id}', [App\Http\Controllers\HomeController::class, 'updatedemanderecus'])->name('les_demande_gestionnaire.updatedemanderecus');

Route::get('/employee/loginn', [App\Http\Controllers\Autha\EmployeeAuthController::class, 'showEmployeeLoginForm'])->name('employee.login');
Route::post('/employee/loginn', [App\Http\Controllers\Autha\EmployeeAuthController::class, 'login'])->name('employee.login.submit');
Route::post('/employee/logout', [App\Http\Controllers\Autha\EmployeeAuthController::class, 'logout'])->name('employee.logout');
Route::get('/dashboard', [App\Http\Controllers\HomeEmployeeController::class, 'dashboard'])->name('employee.dashboard');
Route::get('/contact_us', [App\Http\Controllers\HomeEmployeeController::class, 'contact'])->name('employee.contact');
Route::post('/contact_us', [App\Http\Controllers\HomeEmployeeController::class, 'storecontact'])->name('employee.store');
  

Route::get('/contacts', [App\Http\Controllers\HomeController::class, 'showContacts'])->name('employee.reponse');
Route::post('/contacts/{contactId}/reply', [App\Http\Controllers\HomeController::class, 'sendeReplyy'])->name('employee.sendeReplyy');


   Route::get('/d_accepter_employee', [App\Http\Controllers\HomeEmployeeController::class, 'd_accepter_employee'])->name('employee.d_accepter_employee');
   Route::get('/d_accepter_gestinnaire', [App\Http\Controllers\HomeController::class, 'd_accepter_gestionnaire'])->name('employees.d_accepter_gestinnaire');
  // Route::post('/import-remboursement', [RemboursementController::class, 'importRemboursement'])->name('import_remboursement');
  Route::get('/d_accepter_gestinnair', [App\Http\Controllers\HomeController::class, 'export'])->name('export.remboursements');
 /* Route::get('/export-remboursement-pdf', function () {
    $remboursementPDF = new RemboursementPDF;
    return $remboursementPDF->generatePDF();
});*/
  // Route::get('/demander', [App\Http\Controllers\HomeEmployeeController::class, 'create'])->name('advance_request.create');
  // Route::post('/demander', [App\Http\Controllers\HomeEmployeeController::class, 'store'])->name('advance_request.store');
   Route::get('/demander/create', [App\Http\Controllers\HomeEmployeeController::class, 'create'])->name('advance_request.create');
Route::post('/demander', [App\Http\Controllers\HomeEmployeeController::class, 'stores'])->name('advance_request.stores');
//Route::get('/demanderr', [App\Http\Controllers\HomeEmployeeController::class, 'create'])->name('employee.create');

   //Route::get('/employee/loginn', [App\Http\Controllers\Autha\EmployeeAuthController::class, 'logout'])->name('employee.logout');

       // Route::get('/demander', [App\Http\Controllers\HomeEmployeeController::class, 'demander'])->name('employee.demander');
       // Route::post('/demander/avance', [App\Http\Controllers\HomeEmployeeController::class, 'store'])->name('employee.store');

       
        //Route::resource('/advance_requests', [App\Http\Controllers\HomeEmployeeController::class, 'store'])->name('advance_requests.store');
       // Route::resource('/advance_requests', App\Http\Controllers\HomeEmployeeController::class)->name('advance_requests.store')->middleware(['auth', 'auth:employee']);

       // Route::post('/advance_requests', App\Http\Controllers\HomeEmployeeController::class)->only(['index', 'store'])->middleware(['auth']);

  
        Route::get('/suivi', [App\Http\Controllers\HomeEmployeeController::class, 'suivi'])->name('employee.suivi');


    //Route::get('/loginn', [App\Http\Controllers\Auth\EmployeeloginController::class, 'showLoginForm'])->name('employeelogin');
    //Route::post('/loginn', [App\Http\Controllers\Auth\EmployeeloginController::class, 'login'])->name('employee.login.submit');


      

//Route::get('/EmployeesLogin', 'App\Http\Controllers\EmployeesLoginController@showLoginForm')->name('EmployeesLogin');
//Route::post('/EmployeesLogin', 'App\Http\Controllers\EmployeesLoginController@login');
/*Route::get('/employee/login', [App\Http\Controllers\EmployeeAuthController::class, 'showLoginForm'])->name('employee.login');
Route::post('/employee/login', [App\Http\Controllers\EmployeeAuthController::class, 'login'])->name('employee.login');
Route::post('/employee/logout', [App\Http\Controllers\EmployeeAuthController::class, 'logout'])->name('employee.logout');
Route::get('/employee/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employee.dashboard');
Route::get('/EmployeesLogin', [App\Http\Controllers\EmployeesLoginController::class, 'showLoginForm'])->name('EmployeesLogin');
Route::post('/EmployeesLogin', [App\Http\Controllers\EmployeesLoginController::class, 'loginn'])->name('EmployeesLogin.submit');
Route::post('/employees/logout', [App\Http\Controllers\EmployeeAuthController::class, 'logout'])->name('employee.logout');
Route::get('/employees/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('employees.dashboard');
//Route::post('/employee/logout', [EmployeeAuthController::class, 'logout'])->name('employee.logout');*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/information', [App\Http\Controllers\HomeEmployeeController::class, 'info'])->name('info');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/departement', [App\Http\Controllers\HomeController::class, 'afficherDonnees'])->name('departement.afficherDonnees');
Route::get('/post', [App\Http\Controllers\HomeController::class, 'afficherDonneespost'])->name('post.afficherDonneespost');
Route::get('/type', [App\Http\Controllers\HomeEmployeeController::class, 'afficherType'])->name('type.afficherDonneespost');

Route::get('/employees', [EmployeeController::class, 'index']);
Route::get('/employees/create', [App\Http\Controllers\HomeController::class, '_createee'])->name('employees.create');
//Route::POST('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('auth.login');

Route::post('/employees', [App\Http\Controllers\HomeController::class, 'store'])->name('employees.store');
Route::post('/departement', [App\Http\Controllers\HomeController::class, 'storedep'])->name('departement.storedep');
Route::get('/departement/create', [App\Http\Controllers\HomeController::class, '_createeedep'])->name('departement.createdep');
Route::post('/post', [App\Http\Controllers\HomeController::class, 'storepost'])->name('post.storepost');
Route::get('/post/create', [App\Http\Controllers\HomeController::class, '_createeepost'])->name('post.createpost');
//Route::post('/departement', [App\Http\Controllers\HomeController::class, 'storedep'])->name('departement.storedep');
//Route::post('/importe',[App\Http\Controllers\HomeController::class, 'import'])->name('import');
Route::get('/employees/{id}', 'App\Http\Controllers\HomeController@edit');
Route::put('/employees/{id}','App\Http\Controllers\HomeController@update')->name('employees.update');
Route::get('/departement/{id}', 'App\Http\Controllers\HomeController@editdep');
Route::put('/departement/{id}','App\Http\Controllers\HomeController@updatedep')->name('departement.updatedep');
Route::get('/post/{id}', 'App\Http\Controllers\HomeController@editpost');
Route::put('/post/{id}','App\Http\Controllers\HomeController@updatepost')->name('post.updatepost');
//Route::get('employees/import',[App\Http\Controllers\HomeController::class, 'showImportForm'])->name('employees.import');
//Route::post('employees/import',[App\Http\Controllers\HomeController::class, 'import'])->name('employees.import');
Route::get('/employeess/{id}','App\Http\Controllers\HomeController@delete')->name('employees.delete');
Route::get('/departements/{id}','App\Http\Controllers\HomeController@deletedep')->name('departement.deletedep');
Route::get('/posts/{id}','App\Http\Controllers\HomeController@deletepost')->name('post.deletepost');
//Route::get('/employees/indexx', [App\Http\Controllers\HomeController::class, 'indexx'])->name('employees.indexx');
Route::get('/employeess', [App\Http\Controllers\HomeController::class, 'displayEmployees'])->name('employees.display');
//Route::get('/employees', [EmployeeController::class, 'show'])->name('employees.show');
/*Route::get('/employees/{id}', function ($id) {
    $employee = Employee::findOrFail($id);
    $nom_dept = $employee->Dept->nom;
    return view('employee', compact('employee','nom_deps'));});
*/



Route::get('/employees/create', [App\Http\Controllers\HomeController::class, '_createee'])->name('employees.create');
/*Route::get('/employeesss', function () {
    return view('/employees.import');
});*/
Route::get('/employeesss', [App\Http\Controllers\HomeController::class, 'importusere'])->name('employees.importusere');
Route::post('/employeesss', [App\Http\Controllers\HomeController::class, 'importuser'])->name('importuser');

Route::get('/departementss', function () {
    return view('/departement/import');
});

Route::post('/departementss', [App\Http\Controllers\HomeController::class, 'importdep'])->name('importdep');

Route::get('/postss', function () {
    return view('/post/import');
});

Route::post('/import', [App\Http\Controllers\HomeController::class, 'importpost'])->name('importpost');