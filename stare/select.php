<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Generator rzutu kośćmi</title>
<meta name="description" content="Generator rzutu kośćmi - Znajdź zapisane wyniki." />
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
    <div class="fl_right">
<table><tr><td>
<h2>Zapisane wyniki</h2>
<p>
<?php 

include('baza.php'); /*połączenie się z bazą*/

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

$insert = mysql_query ("INSERT INTO ip (ip, data, strona) VALUES ('$ip', '$data', 'select.php')");
// koniec pobierania danych --------------------------------------------------------------------------------

$idrzutu = $_POST['idrzutu'];

echo "ID rzutu: $idrzutu<br/>";
//query 1
$query = "SELECT sum(liczba) FROM wyniki WHERE id_rzutu = $idrzutu";
$result_set = mysql_query($query);

if($result_set)
	{
		$rows = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i=1; $i<=$rows; $i++)
			{
				$record = mysql_fetch_row($result_set ); //bierzemy kolejny rekord
				foreach($record as $suma_rzutu_koscmi) // i wyświetlamy ten rekord
					{ 
						echo "Wynik rzutu koścmi: $suma_rzutu_koscmi<br/>"; //pokazujemy na stronie
						//$suma_rzutu_koscmi
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
	echo "<br/><p><a href="/"><input type='submit' value='Wróć'></a></p>";
}
//------------------------------------------------------------------------------------------
//query 2 - kość
$query2 = "SELECT DISTINCT dice FROM wyniki WHERE id_rzutu = $idrzutu";
$result_set2 = mysql_query($query2);

if($result_set2)
	{
		$rows2 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i2=1; $i2<=$rows2; $i2++)
			{
				$record2 = mysql_fetch_row($result_set2); //bierzemy kolejny rekord
				foreach($record2 as $kosc) // i wyświetlamy ten rekord
					{ 
						echo "Użyta kość: k$kosc<br/>"; //pokazujemy na stronie
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
}
//------------------------------------------------------------------------------------------
//query 3 - modyfikator
$query3 = "SELECT DISTINCT wyniki.mod FROM wyniki WHERE id_rzutu = $idrzutu";
$result_set3 = mysql_query($query3);

if($result_set3)
	{
		$rows3 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i3=1; $i3<=$rows3; $i3++)
			{
				$record3 = mysql_fetch_row($result_set3); //bierzemy kolejny rekord
				foreach($record3 as $modyfikator) // i wyświetlamy ten rekord
					{ 
						echo "Modyfikator: $modyfikator<br/>"; //pokazujemy na stronie
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
}
//------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------------
//query 4 - ile rzutów
$query4 = "SELECT max(rzut) FROM wyniki WHERE id_rzutu = $idrzutu";
$result_set4 = mysql_query($query4);

if($result_set4)
	{
		$rows4 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i4=1; $i4<=$rows4; $i4++)
			{
				$record4 = mysql_fetch_row($result_set4); //bierzemy kolejny rekord
				foreach($record4 as $rzut) // i wyświetlamy ten rekord
					{ 
						echo "Liczba rzutów: $rzut<br/>"; //pokazujemy na stronie
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
}
//------------------------------------------------------------------------------------------
$wynik = $suma_rzutu_koscmi + ($rzut * $modyfikator);
echo "<b>Podsumowanie wyniku:</b> $wynik<br/>";
?>
</p>	
<br/>
<p><a href="/"><input type='submit' value='Wróć'></a></p>

</td></tr></table>
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