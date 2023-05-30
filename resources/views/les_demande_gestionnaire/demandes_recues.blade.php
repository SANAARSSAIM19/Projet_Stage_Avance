@include('menu')
    
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Liste des demandes </h1>
      
            
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
                
                <th>Nom</th>
                <th>Prenom</th>
                <th>Type de Avance</th>
                <th>Montant en DH</th>
                <th>Commentaire</th>
                <th>Date de la demande</th>
                <th>État</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  $demandes=DB::table('advance_requests')->join('employees','advance_requests.employee_id','=','employees.id')->join('types','advance_requests.type_id','=','types.id')->select('advance_requests.*','employees.nom as employee_nom','employees.prenom as employee_prenom','types.nom as type_id')->get(); ?>
 
            @foreach($demandes as $demande)
                <tr>
                 
                    <td>{{ $demande->employee_nom }}</td>
                    <td>{{ $demande->employee_prenom }}</td>
                    <td>{{ $demande->type_id }}</td>
                    <td>{{ $demande->advance_amount }}</td>
                    <td>{{ $demande->comments }}</td>
                    <td>{{ $demande->created_at }}</td>
                   
                    @if($demande->etat == '')
                    <td>En traitement</td>
                @elseif($demande->etat == '1')
                    <td>Accepté</td>
                @elseif($demande->etat == '0')
                    <td>Refusé</td>
                @endif
                

                    <td>
                      

                        <form method="POST" action="{{ route('les_demande_gestionnaire.updatedemanderecus', $demande->id)}}">
                            @csrf
                            @method('PUT')
                            <select name="etat" onchange="this.form.submit()"  class=" bg-primary text-white"> 
                                <option value="" {{ $demande->etat == 'null' ? 'selected' : '' }}>En traitement</option>

                                <option value="1" {{ $demande->etat == 'accepte' ? 'selected' : '' }}>Accepté</option>
                                <option value="0" {{ $demande->etat == 'refuse' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </form>
                    </td>
                </tr>
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
    @include('footer')


    