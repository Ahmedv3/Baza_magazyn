<!DOCTYPE html>
<html lang="pl">
<head>
	<!--Author: Jakub Czarnecki -->
	<meta charset="utf-8"/>
	<meta name="description" content="Panel Magazyniera firmy COS"/>
	<meta name="keywords" content="Panel, Magazyn, Magazynier, COS "/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<title>Panel Magazyniera</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Anton|Lato|Pangolin" rel="stylesheet">
	<script src="jquery-3.2.1.min.js"></script>
	<script src="galleria/galleria-1.5.1.min.js"></script>
	<script type="text/javascript" src="JS/timer.js"></script>

	
</head>
<body onload="zegar()">

	<div class="wrapper">
		<div class="header">
            <div class="logo">
                <div id="clock"></div>
                <span style="color: red;">Dodawanie</span> <span style="color: blue; ">Zamówień</span>
            </div>
		</div>
		<div class="nav">
			<ol>
				<li><a href="index.html">Strona Główna</a></li>
				<li><a href="dodaj.html">Dodaj Zamówienie</a></li>
				<li><a href="skompletuj.html">Skompletuj </a></li>
				<li><a href="#"><i class="icon-facebook-squared"></i>Fanpage</a></li>
				<li><a href="#"><i class="icon-mail"></i>Kontakt</a></li>
			</ol>
		</div>
		<div class="content">
			<br />
			<div style="clear: both;"></div>
			<p>
            <?php
                $servername = "localhost";
                $username = "jczarnecki";
                $password = "huk8Eng0iez9";
                $dbname = "jczarnecki_model";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if($conn -> connect_error) {
                    die("Connection failed: " . $conn -> connect_error);
                }
				echo "<center> Connected </center>";
				

				$imie = $_POST["imie"];
                $nazwisko = $_POST["nazwisko"];
                $miasto = $_POST["miasto"];
                $adres = $_POST["adres"];
				$kod = $_POST["kod"];
				$tel = $_POST["tel"];
				
				$sqlSelect = "select imie, nazwisko, miasto, adres, kod_pocztowy, telefon from klient
				where imie like '".$imie."' and nazwisko like '".$nazwisko."' and miasto like '".$miasto."' and kod_pocztowy like '".$kod."' and telefon like '".$tel."' ";

				$result = mysqli_query($conn,$sqlSelect);


				if(mysqli_num_rows($result)>0){
					die("<center>Klient o takich damych jest już w bazie klientów.</center>");
				} else {

					$sql = "INSERT INTO klient(imie,nazwisko,miasto,adres,kod_pocztowy,telefon)
					VALUES
					('$imie','$nazwisko','$miasto','$adres','$kod','$tel')";


					if(!mysqli_query($conn,$sql)){
						die('Error: ' . mysqli_error($conn));
					}
					echo "<center> Nowy klient dodany! </center>";

				}

                mysqli_close($conn);
				
            ?>

               <center>Aby wrócić do dodawania kliknij <a href="dodaj.html"> tutaj.</a> </center>
			</p>
		</div>
		<div class="footer">
			<div id="stopki">
				<div class="stopka1">
					mag-panel.pl &copy;
				</div>
				<div class="stopka2">
					Jakub Czarnecki
				</div>
				<div class="stopka3">
					Tel: 123-456-789
				</div>
				<div class="stopka4">
					Magazynowa 13 
				</div>
				<div style="clear: both;"></div>
			</div>
			
		</div>
		
	</div>
	
	
	<script>

	$(document).ready(function() {
	var NavY = $('.nav').offset().top;
	 
	var stickyNav = function(){
	var ScrollY = $(window).scrollTop();
		  
	if (ScrollY > NavY) { 
		$('.nav').addClass('sticky');
	} else {
		$('.nav').removeClass('sticky'); 
	}
	};
	 
	stickyNav();
	 
	$(window).scroll(function() {
		stickyNav();
	});
	});
	</script>
</body>
</html>
