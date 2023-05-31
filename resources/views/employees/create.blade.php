@include('menu')
@csrf
<!--<form method="POST" action="

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


@if(session()->has('success'))
<div class="alert alert-success"style="width:50%, margin-left: 50%; ">
    {{ session()->get('success') }}
</div>
@endif

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Ajouter un Employee</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3">


  
 
<form method="POST" action="{{ route('employees.store') }}">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Nom</label>
        <input type="text"name="nom" class="form-control" id="inputEmail4" placeholder="Nom">
      </div>
      <div class="form-group col-md-6">
        <label for="inputPassword4">Prenom</label>
        <input type="text"name="prenom" class="form-control" id="inputPassword4" placeholder="Prenom">
      </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputAddress2">N°</label>
            <input type="number"name="N°" class="form-control" id="inputAddress2" placeholder="Nemero">
          </div>
    <div class="form-group col-md-4">
      <label for="inputAddress">Gmail</label>
      <input type="email"name="email" class="form-control" id="inputAddress" placeholder="exemple@gmail.com">
    </div>
    <div class="form-group col-md-4">
        <label for="inputPassword4">Password</label>
        <input type="password"name="password" class="form-control" id="inputPassword4" placeholder="Password">
      </div>
   
</div>
    <div class="form-row">
      <div class="form-group col-md-4">
        <label for="deps_id">Departement</label>
        <select id="deps_id"name="deps_id" class="form-control">
          @foreach($deps as $dep )
          <option selected  value="{{ $dep->id }}">{{ $dep->nom }}</option>
          @endforeach
        </select>
       </div>
       <div class="form-group col-md-4">
        <label for="posts_id">Post</label>
        <select id="posts_id"name="posts_id" class="form-control">
          @foreach($posts as $post )
          <option selected  value="{{ $post->id }}">{{ $post->nom }}</option>
          @endforeach
        </select>
       </div>
      <div class="form-group col-md-4">
        <label for="inputCity">Salaire</label>
        <input type="text"name="Salair" class="form-control" id="inputCity"placeholder="Salaire">
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>


</div>
</div>
</div>



@include('footer')