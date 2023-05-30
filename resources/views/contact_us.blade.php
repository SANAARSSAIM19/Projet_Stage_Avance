<!doctype html>
<html lang="en">
  <head>
  	<title>Contactez-Nous</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="{{ asset('https://fonts.googleapis.com/css?family=Roboto:400,100,300,700')}}" rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
	
	<link rel="stylesheet" href="{{ asset('bootstrap4/css/style.css')}}">

	</head>
	<body>
	<section class="ftco-section"  >
		<div class="container">
		
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">
						<div class="row no-gutters mb-5">
							<div class="col-md-7">
								<div class="contact-wrap w-100 p-md-5 p-4">
									<h3 class="mb-4">Contactez-Nous</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
                                Votre message a été envoyé, merci !
				      		</div>   
                              <form method="post" action="{{ route('employee.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="nom"><br><br>
                            </div>
                        </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                <input type="text" class="form-control" name="prenom" id="email" placeholder="Prenom"><br><br>
                                
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="email"><br><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                         <input type="text" class="form-control" name="objet" id="objet" placeholder="objet"><br><br>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">       
                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea><br><br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" value="Envoyer" class="btn btn-primary" height="425">
                            </div>
                        </div>
                    </div>
                            </form>
								</div>
							</div>
                    
							<div class="col-md-5 d-flex align-items-stretch">
								<div id="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3372.654850336315!2d-9.229959538251734!3d32.29425637397787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2sma!4v1684159343037!5m2!1sar!2sma" width="465" height="425" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>			          </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-map-marker"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Message:</span> Avenue Moulay Driss 1er. BP : 218. SAFI. MAROC</p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-phone"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Téléphone:</span> <a href="tel://1234567920"> 05.24.61.91.20</a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-paper-plane"></span>
			        		</div>
			        		<div class="text">
				            <p><span>E-mail:</span> <a href="mailto:info@yoursite.com">
                                radees@radeesafi.ma
                            </a></p>
				          </div>
			          </div>
							</div>
							<div class="col-md-3">
								<div class="dbox w-100 text-center">
			        		<div class="icon d-flex align-items-center justify-content-center">
			        			<span class="fa fa-globe"></span>
			        		</div>
			        		<div class="text">
				            <p><span>Site Internet</span> <a href="#">radees.ma</a></p>
				          </div>
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('bootstrap4/js/jquery.min.js')}}"></script>
  <script src="{{ asset('bootstrap4/js/popper.js')}}"></script>
  <script src="{{ asset('bootstrap4/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('bootstrap4/js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('bootstrap4/https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false')}}"></script>
  <script src="{{ asset('bootstrap4/js/google-map.js')}}"></script>
  <script src="{{ asset('bootstrap4/js/main.js')}}"></script>

	</body>
</html>

