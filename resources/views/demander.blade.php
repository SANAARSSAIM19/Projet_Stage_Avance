    
    @include('menu2')

    

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Soumettez votre demande</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">




      

  
    <form  method="POST" action="{{ route('advance_request.stores') }}" >
        @csrf
        <div class="form-row ">
          <div class="form-group col-md-6">
            <label for="type_avance_id">Type d'avance :</label>
            <select id="type_avance_id" name="type_id" class="form-control" required>
              <?php  $types=DB::table('types')->select('types.*')->get();  ?>
                @foreach($types as $type_avance)
                    <option value="{{ $type_avance->id }}">{{ $type_avance->nom }}</option>
                @endforeach
            </select>
        </div>
    
          <div class="form-group col-md-6">
            <label for="inputZip">Montant en DH</label>
            <input type="number" class="form-control" name="advance_amount" id="inputZip">
          </div>
          @if(session('error'))
          <div  class="alert alert-danger" style="margin-left: 530px; width:50% ">
              {{ session('error') }}
          </div> 
      @endif
        </div>

     
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Commentaire</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="comments" rows="3"></textarea>
          </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
      </form>

    </div>
</div>
</div>
      
  @include('footer1')
