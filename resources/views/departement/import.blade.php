@include('menu')

@csrf





    <div class="container">
        <div class="row">
          <div class="col-md-6 mx-auto mt-5">
            <div class="card">
              <div class="card-header bg-primary text-white">
                Importer un fichier Excel 
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('importdep') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="file">Fichier :</label>
                    <input type="file" class="form-control-file @error('file') is-invalid @enderror" id="file" name="file" accept=".xlsx,.xls,.csv">
                    @error('file')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Importer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      


@include('footer')