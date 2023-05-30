@include('menu')

<div class="container-fluid">
    <!-- Page Heading -->
  
        
        </form>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="h3 mb-2 text-gray-800">le message recus</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        
            <tr>
                
                <th>Nom</th>
                <th>Prenom</th>
                <th>email</th>
                <th>objet</th>
                <th>message</th>
                <th>Reponse</th>
              
            </tr>
        </thead>
        <tbody>

        <?php $contacts=DB::table('contacts')->select('contacts.*')->get();
        ?>
@foreach ($contacts as $contact)
    <tr>
      <td>{{ $contact->nom }}</td>
      <td>{{ $contact->prenom }}</td>
      <td>{{ $contact->email }}</td>
      <td> {{ $contact->objet }}</td>    
     <td>{{ $contact->message }}</td>      
     <td>
     @if (!$contact->replied)
            <form action="{{ route('employee.sendeReplyy', $contact->id) }}" method="POST">
                @csrf
                <div>
                    <label for="reply_message">Réponse :</label>
                    <textarea  id="reply_message" rows="4" cols="50"  ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
            </form>
        @else
            <p>Une réponse a déjà été envoyée</p>
        @endif
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
@include('footer1')
