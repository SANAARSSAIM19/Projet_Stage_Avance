
@include('menu')
@csrf
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tableau des Employes </h1>
@if(session('success'))
<div  class="alert alert-danger" style="margin-left: 530px; width:50% ">
    {{ session('success') }}
</div> 
@endif
        </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ url('/employees/create') }}" class="btn btn-primary">Ajouter un Employee</a> 
            
        </div>
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>email</th>
                          
                            <th>N°</th>
                            <th>Departement</th>
                            <th>Poste</th>
                            <th>Salaire</th>
                            <th>Modifier</th>
                            <th>Suprimer</th>
                        </tr>
                    </thead>
                    <tbody>
               <?php  $employees=DB::table('employees')->join('deps','employees.deps_id','=','deps.id')->join('posts','employees.posts_id','=','posts.id')->select('employees.*','deps.nom as deps_id','posts.nom as posts_id')->get(); 
               ?>
                        @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->nom }}</td>
                            <td>{{ $employee->prenom }}</td>
                            <td>{{ $employee->email }}</td>
                          
                            <td>{{ $employee->N° }}</td>
                            <td>{{ $employee->deps_id}}</td>
                            <td>{{ $employee->posts_id}}</td>
                            <td>{{ $employee->Salair }}</td>
                            <td> <a href="{{route('employees.update',$employee->id)}}" class="btn btn-success">Modifier</a> </td>
                            <td>  
                            <a href="{{route('employees.delete',$employee->id)}}" class="btn btn-danger">Supprimer</a>  </td>
                        </tr>
                        
                        @endforeach
                       
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@include('footer')