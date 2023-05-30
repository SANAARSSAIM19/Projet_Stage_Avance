

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pret a Partir ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selectionnez "Deconnexion" ci-dessous si vous etes pret a mettre fin a votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
      

   <a class="btn btn-primary" href="{{ route('employee.logout') }}"
   onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
    {{ __('se deconnecter') }}
</a>
   <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" class="nav-item">
       @csrf
   </form>
                </div>
            </div>
        </div>
    </div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

    
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('bootstrap/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('bootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('bootstrap/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('bootstrap/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{ asset('bootstrap/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('bootstrap/js/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('bootstrap/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous')}}"></script>