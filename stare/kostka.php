<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Generator rzutu kośćmi - Wynik</title>
<meta name="description" content="Generator rzutu kośćmi - Skopiuj swoje wyniki rzutów."/>
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
<table>
	<tr>
		<td>
			<h2>Wyniki</h2>
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

$insert = mysql_query ("INSERT INTO ip (ip, data, strona) VALUES ('$ip', '$data', 'kostka.php')");
// koniec pobierania danych --------------------------------------------------------------------------------

$plus = $_POST['plus'];
$ile  = $_POST['oczka'];
$razy = $_POST['mnoznik'];
$rzuty = $_POST['rzuty'];

$query = "SELECT max(id_rzutu) FROM wyniki";
$result_set = mysql_query($query);

if ($razy <= 100 && $rzuty <= 100) {
if($result_set)
	{
		$rows = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i=1; $i<=$rows; $i++)
			{
				$record = mysql_fetch_row($result_set ); //bierzemy kolejny rekord
				foreach($record as $value) // i wyświetlamy ten rekord
					{ 
						$klucz = $value + 1; //dodajemy o jeden więcej niż max klucza w tabeli z wynikami
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
}

/*Pokazujemy ID rzutu*/		
echo "<b><font size='+1'>Numer ID rzutu:</b> $klucz </font><br/>";
/*----*/
for ($j=1; $j<=$rzuty; $j++)
{
echo "<b>$j rzut:<br/></b>";
	for ($i=1; $i<=$razy; $i++)
		{
			$kostka = (rand(1,$ile));
			$rzut = $j;
			echo "$i wynik: $kostka<br>";
			$insert = mysql_query ("INSERT INTO wyniki VALUES ('$klucz', '$kostka', '$rzut', '$plus', '$ile', NULL)");
		}		
/*suma częściowa - tylko dla rzutu*/
$query3 = "SELECT sum(liczba) FROM wyniki where id_rzutu = $klucz and rzut = $rzut group by id_rzutu";
$sumarzut = mysql_query($query3);
if($sumarzut)
	{
		$rows3 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($q=1; $q<=$rows3; $q++)
			{
				$record3 = mysql_fetch_row($sumarzut); //bierzemy kolejny rekord
				foreach($record3 as $value3) // i wyświetlamy ten rekord
					{ 
						 $value4 =  $value3 + $plus; //dodajemy modyfikator
						echo "<b>Suma $j rzutu: </b> $value4 (suma kości:$value3 + modyfikator:$plus)<br/><br/>";
					}
			}
	}
}
/*----*/
/*obliczamy sumę dla wszystkich rzutów*/
$query2 = "SELECT sum(liczba) FROM wyniki where id_rzutu = $klucz group by id_rzutu";
$suma = mysql_query($query2);
if($suma)
	{
		$rows2 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($k=1; $k<=$rows2; $k++)
			{
				$record2 = mysql_fetch_row($suma); //bierzemy kolejny rekord
				foreach($record2 as $value2) // i wyświetlamy ten rekord
					{ 
						$value_suma = $value2 + ($rzuty * $plus);
						echo "<br/><b>Suma całkowita: </b> $value_suma";
					}
			}
	}
else 
{
	die('Błąd w Query - '. mysql_error());
	echo "<br/><p><a href="/"><input type='submit' value='Wróć'></a></p>";
}
/*---*/
} 
else 
{
	echo "Przekroczono limit 100 rzutów lub ilość kości!";
	echo "<br/><p><a href="/"><input type='submit' value='Wróć'></a></p>";
}

?>
			</p>	
			<br/>
			<table><tr><td><a href="/"><input type='submit' value='Wróć'></a></td>
			<td><form method='post' action='kostka.php'>
			<input type="hidden" name="rzuty" value="<?php echo $rzuty ?>"/>
			<input type="hidden" name="mnoznik" value="<?php echo $razy ?>"/>
			<input type="hidden" name="oczka" value="<?php echo $ile ?>"/>
			<input type="hidden" name="plus" value="<?php echo $plus ?>"/>
			<input type='submit' onClick="javascript:_gaq.push(['_trackPageview', 'powtorzenie_rzutu']);" value='Powtórz rzut'>
			</form></td></tr></table>
			

		</td>
		<td>
			<div id='fb-root'>Wyślij ID rzutu:</div><script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script><fb:send ref="top_right" href='www.alea.cba.pl' font=''></fb:send>
		</td>
	</tr>
</table>
    </div>
    <br class="clear" />
  </div>

<div id="latest">
</div>
  <br class="clear" />
 
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