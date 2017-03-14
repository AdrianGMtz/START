<!DOCTYPE html>
<html>
	<head>
		<title>START! | Explore</title>
		<?php include('header.html'); ?>
		<!--Import scripts.js-->
		<script type="text/javascript" src="js/scripts.js"></script>

		<style>

		#digital-art, #animation, #audio {
			margin-top: 10px;
			margin-bottom: 10px;
			border: 4px solid;
			border-radius: 4px;
		}

		</style>

	</head>

	<body>
		<!--Top navigation bar-->
		<?php include('navbar.php'); ?>

		<br>
		<div class="container">
			<div class="row">

					<a class="waves-effect waves-light btn" id="back" style="margin-bottom: 20px;"><i class="material-icons left">chevron_left</i><b>Back</b></a>

					  <ul id="tabs-swipe-demo" class="tabs tabs-fixed-width">
					    <li class="tab col s3"><a class="active red white-text" href="#digital-art">Digital Art</a></li>
					    <li class="tab col s3"><a class="blue white-text" href="#animation">Animation</a></li>
					    <li class="tab col s3"><a class="green white-text" href="#audio">Audio</a></li>
					  </ul>

					  <div id="digital-art" class="col s12 white" style="border-color:red;">

					  	<div class="row" style="margin-top: 10px;">
					  		<div class="col s4 center">
					  			Digital Art 1
					  		</div>
					  		<div class="col s4 center">
					  			Digital Art 2
					  		</div>
					  		<div class="col s4 center">
					  			Digital Art 3
					  		</div>
					  	</div>

					  	<ul class="pagination center">
						    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
						    <li class="active"><a href="#!">1</a></li>
						    <li class="waves-effect"><a href="#!">2</a></li>
						    <li class="waves-effect"><a href="#!">3</a></li>
						    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
						  </ul>

					  </div>


					  <div id="animation" class="col s12 white" style="border-color:blue;">

					  	Animation

					  </div>


					  <div id="audio" class="col s12 white" style="border-color:green;">

					 	 Audio

					  </div>
        
			</div>
		</div>

	</body>
	<!--Footer-->
	<?php include('footer.html'); ?>
</html>