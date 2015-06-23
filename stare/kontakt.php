<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Generator rzutu kośćmi - Kontakt</title>
<meta name="description" content="Generator rzutu kośćmi - Skontaktuj się z twórcą generatora."/>
<meta name="keywords" content="Generator rzutu kośćmi, Symulator rzutu kośćmi, Rzut kostką, Rzut kością online, Kości do gry, Kostka do gry, Gry RPG"/>
<link rel="canonical" href="http://www.alea.cba.pl/">
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="Shortcut icon" href="icon.gif" />
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-9373110-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body id="top">

<?php
include('baza.php'); /*zapis danych*/
// sesja - pobranie danych ------------------------------------------------
session_start();
        if (!isset($_SESSION['inicjuj']))
        {
                session_regenerate_id();
                $_SESSION['inicjuj'] = true;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        }

$query1 = "SELECT NOW()";
$result_set = mysql_query($query1); 
if($result_set)
	{
		$rows = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i=1; $i<=$rows; $i++)
			{
				$record = mysql_fetch_row($result_set ); //bierzemy kolejny rekord
				foreach($record as $value) // i wyświetlamy ten rekord
					{ 
						$data = $value; //wynik zapytania wsadzamy do zmiennej $data
					}
			}
	}

$ip = $_SESSION['ip'];

$insert = mysql_query ("INSERT INTO ip (ip, data, strona) VALUES ('$ip', '$data', 'kontakt.php')");
// koniec pobierania danych --------------------------------------------------------------------------------
?>

<div class="wrapper">
  <div id="header">
    <div id="logo">
      <h1><a href="/">Generator rzutu kośćmi</a></h1>
      <p>www.alea.cba.pl</p>
    </div>
    <div id="topnav">
      <ul>
        <li><a href="index.php">Generator</a></li>
        <li><a href="info.php">Pomoc</a></li>
        <li class="active"><a href="kontakt.php">Kontakt</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>

<div class="wrapper">
    
  <div id="latest">
    <div class="fl_right">
      
	  <h2>Generator rzutu kośćmi - Kontakt</h2>
		<p>
			Jeżeli chcecie podzielić się ze mną uwagami na temat
			generatora - z chęcią skontaktuje sie z Toba poprzez
			poniższy formularz:</b>
		</p>
		<p>
			<form method='post' action='email.php'>
			Twój e-mail: <input name='email' type='text' /><br /><br />
			Treść:<br /><textarea name='message' rows='15' cols='40'></textarea><br />
			<input type='submit' /></form>
	</p>
	  
    </div>
    <br class="clear" />
  </div>
  <br/>
 
</div>
<div class="wrapper">
  <div id="footer">
    <div class="footbox">
      <h2>Polecane strony</h2>
      <ul>
		<li><a target="_blank" href="http://www.ceneo.pl/Gry_towarzyskie;017Planszowe_P11-46116.htm">Gry planszowe i RPG</a></li>
		<li><a target="_blank" href="http://www.ceneo.pl/Gry;szukaj-kości">Kości do gry</a></li>
		<li><a target="_blank" href="http://www.ceneo.pl/Fantastyka_i_fantasy">Fantastyka i fantasy</a></li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Fora RPG</h2>
      <ul>
        <li><a target="_blank" href="http://www.lastinn.info">Lastinn.pl</a></li>
		<li><a target="_blank" href="http://www.erpg.pl">Erpg.pl</a></li>
		<li><a target="_blank" href="http://www.strefarpg.net">Strefarpg.net</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>

</body>
</html>
