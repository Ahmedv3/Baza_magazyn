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

	<style>
			table, th, td {
			  border: 3px solid #a6a6a6;
			  border-collapse: collapse;
			  text_align: center;
			}
	</style>

	
</head>
<body onload="zegar()">

	<div class="wrapper">
		<div class="header">
            <div class="logo">
                <div id="clock"></div>
                <span style="color: red;">Skompletuj</span><span style="color: blue; "> Zamówienie</span>
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
                echo "<center> Connected successfully </br></br> </center>";

                $imie = $_POST["imie"];
                $nazwisko = $_POST["nazwisko"];
                $tel = $_POST["tel"];
                $data = $_POST["data_zam"];

                $sql = "select imie,nazwisko,data_zamowienia,nazwa,sztuk,rzad,kolumna,kod 
                from klient
                join zamowienia on idk = k_id 
                join produkt on idp=p_id
                join zamow_klienta on idz = z_id
                join miejsce on idm=m_id
                where nazwisko like '".$nazwisko."'";

                $result = mysqli_query($conn,$sql);
				echo "<center><table>";

				echo "<tr> <th>Imie</th>";
				echo "<th>Nazwisko</th>";
				echo "<th>Data Zamówienia</th>";
				echo "<th>Nazwa Produktu</th>";
				echo "<th>Ilość sztuk</th>";
				echo "<th>Rząd</th>";
				echo "<th>Kolumna</th>";
				echo "<th>Kod Produktu</th> </tr>";

                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result)){
                       // echo "<center><b>Imie:</b> ".$row[0]." <b>Nazwisko:</b> ".$row[1]." </br></br><b>Data Zamówienia:</b> ".$row[2]." </br></br><b>Nazwa produktu:</b> ".$row[3]." <b>Ilość sztuk:</b> ".$row[4]." <b>Rząd:</b> ".$row[5]." <b>Kolumna:</b> ".$row[6]." <b>Kod Produktu:</b> ".$row[7]."</center>";
						//echo "</br></br>";
						
						echo "<tr> <td>".$row[0]."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td>".$row[3]."</td>";
						echo "<td>".$row[4]."</td>";
						echo "<td>".$row[5]."</td>";
						echo "<td>".$row[6]."</td>";
						echo "<td>".$row[7]."</td> </tr>";

                    }
				}

				echo "</table></center>";
                mysqli_close($conn);
            ?>
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
