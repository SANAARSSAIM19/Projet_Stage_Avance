
@include('menu')

<!--<form action="post" action= enctype="multipart/form-data ">
@csrf
<input type="file" name="file"/>
<button type="submit">Import</button> -->

<!-- Affichage du formulaire de sélection de département -->


<!-- Affichage de la table des employés -->










    <div class="container">
        <form action="{{ route('employees.display') }}" method="GET">
            <div class="form-group row mb-4">
                <label for="department" class="col-sm-2 col-form-label">Sélectionnez un département:</label>
                <div class="col-sm-6">
                    <select name="deps_id" id="department" class="form-control">
                        <option value="">Tous les départements</option>
                        @foreach ($deps as $department)
                            <option value="{{ $department->id }}" {{ $department->id == $request->input('deps_id') ? 'selected' : '' }}>{{ $department->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                </div>
            </div>
      


<!--
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tableau des Employes </h1>
 
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      
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
                    <td><a href="{{route('employees.delete',$employee->id)}}" class="btn btn-danger">Supprimer</a>  </td>
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