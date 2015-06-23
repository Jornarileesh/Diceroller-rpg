<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Generator rzutu kośćmi - OnLine</title>
<meta name="description" content="Generator rzutu kośćmi Alea On-Line - ustaw swoje kości do gry!"/>
<meta name="keywords" content="Generator rzutu kośćmi, Symulator rzutu kośćmi, Rzut kostką, Rzut kością online, Kości do gry, Kostka do gry, Gry RPG"/>
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="Shortcut icon" href="icon.gif" />
<script type="text/javascript">
  window.___gcfg = {lang: 'pl'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
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
include('baza.php');
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

$insert = mysql_query ("INSERT INTO ip (ip, data, strona) VALUES ('$ip', '$data', 'index.php')");
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
        <li class="active"><a href="index.php">Generator</a></li>
        <li><a href="info.php">Pomoc</a></li>
        <li><a href="kontakt.php">Kontakt</a></li>
      </ul>
    </div>
    <br class="clear" />
  </div>
</div>

<div class="wrapper">

  <div id="latest">
  <a class="active" href="http://www.alea.cba.pl/new/"><b>--></b> Sprawdź najnowszą wersję strony przystosowaną do telefonów i tabletów <b><--</b></a><br/><br/>
    <div class="fl_right">
      <h2>Generator</h2> 

      <table>
	  <tr>
	  <td></td><td valign='bottom'><div class="g-plusone" data-annotation="inline" data-width="120" data-href="http://www.alea.cba.pl"></div></td>
	  </tr>
	<tr>
		<td>
			<form method='post' action='kostka.php'>
			Ile rzutów
			<input type="text" name="rzuty" size="2" value="1"/>
			Ile kości
			<input type="text" name="mnoznik" size="2" value="1"/>
			<br/><br/>
			Typ kości (k) 
			<input type="text" name="oczka" size="2" value="6"/>
			<br/><br/>
			Modyfikator dla rzutu
			<input type="text" name="plus" size="2" value="0"/>
			<input type='submit' value='Rzucaj'>
			</form>	
		</td>
		<td valign='bottom'>
		<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
		<div class="fb-like" data-href="http://www.alea.cba.pl" data-send="true" data-layout="box_count" data-width="450" data-show-faces="true"></div>
		</td>
	</tr>
</table>	

    </div>
  </div>
  
  <br class="clear" />
  
  <div id="latest">
    <div class="fl_right">
      <h2>Sprawdź wyniki</h2>
		<table><tr><td>
			<form method='post' action='select.php'>
			Wpisz numer rzutu
			<input type="text" name="idrzutu" size="10"/>
			<input type='submit' value='Sprawdź'>
			</form>
		</td></tr></table>
    </div>
	
    <br class="clear" />
  </div>
  
  <div id="latest">
   
		
		<script type="text/javascript" src="http://ppwidget.skapiec.pl/widget/83889-320-flash"></script>
		
    
	
    <br class="clear" />
	  <br/>
  </div>
  
</div>
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
	