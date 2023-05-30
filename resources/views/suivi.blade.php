@include('menu2')
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Suivez vos demandes </h1>
      
            
            </form>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                
            </div>
           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>

            <tr>
                
           
                <th>Type de Avance</th>
                <th>Montant en DH</th>
                <th>Commentaire</th>
                <th>Date de d'envoi</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                 $demandes=DB::table('advance_requests')->join('employees','advance_requests.employee_id','=','employees.id')->join('types','advance_requests.type_id','=','types.id')->select('advance_requests.*','employees.nom as employee_nom','employees.id as id_employee','employees.prenom as employee_prenom','types.nom as type_id')->get();
                 $user = Auth::guard('employee')->user();
                 ?>

            @foreach($demandes as $demande)
            @if($user->id == $demande->id_employee)
                <tr>
                 
                  
                    <td>{{ $demande->type_id }}</td>
                    <td>{{ $demande->advance_amount }}</td>
                    <td>{{ $demande->comments }}</td>
                    <td>{{ $demande->created_at }}</td>
                   
                    @if($demande->etat == '')
                    <td>En traitement</td>
                @elseif($demande->etat == '1')
                    <td class=" text-success">Accepté</td>
                @elseif($demande->etat == '0')
                    <td class=" text-danger">Refusé</td>
                @endif
                
                </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</table>

          
</div>
</div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
    @include('footer1')


    