@include('menu1')
    
    <div class="container-fluid">
        <!-- Page Heading -->
      
            
            </form>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h1 class="h3 mb-2 text-gray-800">suivi Remboursement</h1>

            </div>
           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>

            <tr>
                
               
                <th>Rubrique</th>
                <th>Référence</th>
                <th>Montant Initial</th>
                <th>Premiére Échéance </th>
                <th>Dérnière Échéance</th>
                <th>Retenue</th>
                <th>Solde Fin</th>
            </tr>
        </thead>
        <tbody>
          

            <?php  $demandes=DB::table('remboursements')->join('advance_requests','remboursements.id_demande','=','advance_requests.id')->join('employees','advance_requests.employee_id','=','employees.id')->join('types','advance_requests.type_id','=','types.id')->select('remboursements.*','advance_requests.advance_amount as mentant_inicial','advance_requests.etat as etat','advance_requests.type_id as type_id','advance_requests.id as id_demande','employees.nom as employee_nom','employees.prenom as employee_prenom','employees.id as employee_id','types.nom as type_nom','types.id as type_id')->get(); 
       $user = Auth::guard('employee')->user();
            ?>

            @foreach($demandes as $demande)
            @if($user->id == $demande->employee_id)

                <tr>
                 
                    <td>{{ $demande->type_nom }}</td>
                    <td>{{ $demande->employee_id }}</td>
                    <td>{{ $demande->mentant_inicial }}</td>
                    <td>{{ $demande->premiere_echance}}</td>
                    <td>{{ $demande->derniere_echance}}</td>
                    <td>{{ $demande->retenue}}</td>
                    
                        <td>{{ $demande->solde_fin}}</td>
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


    