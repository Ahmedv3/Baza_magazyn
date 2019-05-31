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
				echo "<center> Connected successfully </center>";
				

				$imie = $_POST["imie"];
                $nazwisko = $_POST["nazwisko"];
                $tel = $_POST["tel"];
				$data = $_POST["data_zam"];
				$prod_nazwa = $_POST["prod_nazwa"];
				$sztuk = $_POST["sztuk"];
				
				$sqlidk = "select idk 
                from klient
                where nazwisko like '".$nazwisko."'";

                $resultIdk = mysqli_query($conn,$sqlidk);

                if(mysqli_num_rows($resultIdk)>0){
                    while($row = mysqli_fetch_array($resultIdk)){
						$idk = $row[0];
                    }
				} else {
					die("Nie ma takiego klienta.");
				}

				$sqlidp = "select idp 
                from produkt
                where nazwa like '".$prod_nazwa."'";

                $resultIdp = mysqli_query($conn,$sqlidp);

                if(mysqli_num_rows($resultIdp)>0){
                    while($row = mysqli_fetch_array($resultIdp)){
						$idp = $row[0];
                    }
				} else {
					die("Nie ma takiego produktu na magazynie.");
				}

				$sql_insert_klientZam = "INSERT INTO zamowienia(k_id, p_id, data_zamowienia)
                VALUES
                ('$idk','$idp','$_POST[data_zam]')";

                if(!mysqli_query($conn,$sql_insert_klientZam)){
                    die('Error: ' . mysqli_error($conn));
                }
				echo "<center> 1 record added to zamowienia. </center>";

				$sqlidz = "select idz 
                from zamowienia
                where data_zamowienia like '".$data."'";

                $resultIdz = mysqli_query($conn,$sqlidz);

                if(mysqli_num_rows($resultIdz)>0){
                    while($row = mysqli_fetch_array($resultIdz)){
						$idz = $row[0];
                    }
				}

				$sql_insertZam = "INSERT INTO zamow_klienta (z_id, sztuk)
                VALUES
                ('$idz','$sztuk')";

                if(!mysqli_query($conn,$sql_insertZam)){
                    die('Error: ' . mysqli_error($conn));
                }
				echo "<center> 1 record added to zamow_klienta. </center>";

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
