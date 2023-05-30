
<?php  use App\Models\Dep;?>


@include('menu')

<!--<form method="POST" action="{{ route('employees.store') }}">
    @csrf

    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom">

    <label for="prenom">prenom :</label>
    <input type="text" name="prenom" id="prenom">
    <label for="gmail">gmail :</label>
    <input type="gmail" name="gmail" id="gmail">
    <label for="password">password :</label>
    <input type="password" name="password" id="password">

    <label for="N°">N° :</label>
    <input type="number" name="N°" id="N°">

    <label for="deps_id">deps_id :</label>
    <input type="number" name="deps_id" id="deps_id">

    <label for="poste">poste :</label>
    <input type="number" name="poste" id="poste">

    <label for="Salair">Salair :</label>
    <input type="text" name="Salair" id="Salair">


    <button type="submit">Ajouter</button>
</form>  -->




<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Modifier un post</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">


<form method="post" action="{{route('post.updatepost',$post->id,$deps->id)}}">
    @csrf
@method('PUT')

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Nom</label>
        <input type="text"name="nom" class="form-control" id="inputEmail4" placeholder="Nom" value="{{ $post->nom}}">
      </div>
        
          <?php  $departement = Dep::get();
?>
      <div class="form-group col-md-6">
      <label for="deps_id">Departement</label>
      <select id="deps_id"name="deps_id" class="form-control" value="{{ $post->deps_id}}">
        @foreach($departement as $deps )
        <option selected  value="{{ $deps->id }}">{{ $deps->nom }}</option>
        @endforeach
      </select>
     </div>
    
      </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
  </form>


</div>
</div>
</div>



@include('footer')