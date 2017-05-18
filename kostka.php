<?php
session_start();
//------------------------------------------------
//session_start(); przemieszczony na poczatek pliku ZA:http://stackoverflow.com/questions/8812754/cannot-send-session-cache-limiter-headers-already-sent
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generator rzutu kośćmi - OnLine</title>
		<meta name="description" content="Generator rzutu kośćmi - Skopiuj swoje wyniki rzutów."/>
		<meta name="keywords" content="Generator rzutu kośćmi, Symulator rzutu kośćmi, Rzut kostką, Rzut kością online, Kości do gry, Kostka do gry, Gry RPG"/>
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
		<link rel="Shortcut icon" href="icon.gif" />
		<link rel="canonical" href="http://www.alea.cba.pl/">
        
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
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
		
        
        <!--[if lt IE 9]>
            <style>
                header
                {
                    margin: 0 auto 20px auto;
                }
                #four_columns .img-item figure span.thumb-screen
                {
                    display:none;
                }  
            </style>
        <![endif]-->
        
        
        <script>
			function clearField(input) {
			input.value = "";
			};
        </script>
	</head>

	<body>
        <header>            
            <a href="http://www.alea.cba.pl"><h1>Generator rzutu kośćmi</h1></a>
            <nav>
                <ul>
                    <?php include('menu.php'); ?>
                </ul>
            </nav>
        </header>
        <section id="spacer">   
            <div class="search">
                <form method='post' action='select.php'>
                    <input type="text" name="idrzutu" value="Podaj numer rzutu" onclick="clearField(this)"/>
                    <input type="submit" name="start_search" value="Sprawdź wynik"/>
                </form>
            </div>            
        </section>
        <section id="boxcontent">

<table>
	<tr>
		<td>
			<h2>Wyniki</h2>
			<p>
<?php 

include('baza.php'); /*połączenie się z bazą*/
// sesja - pobranie danych ------------------------------------------------
//session_start(); przemieszczony na poczatek pliku ZA:http://stackoverflow.com/questions/8812754/cannot-send-session-cache-limiter-headers-already-sent
        if (!isset($_SESSION['inicjuj']))
        {
                //session_regenerate_id(); usuwam BO: PHP Warning:  session_regenerate_id(): Cannot regenerate session id - headers already sent in /private//diceroller  sqliteowo new/kostka.php on line 93 ZWIAZANE Z: linia 90? (session_start();)
                $_SESSION['inicjuj'] = true;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        }

$query1 = "SELECT NOW()";
/*tu juz zmienilem z "mysql_query"*/
$result_set = $start->query($query1); 
if($result_set)
	{
		$rows = $start->changes();//mysql_affected_rows();zmienione //obliczamy ile jest rekordów w zapytaniu
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

$insert = $start->query ("INSERT INTO ip (ip, data, strona) VALUES ('$ip', '$data', 'kostka.php')");// zmieniono z = mysql_query(
// koniec pobierania danych --------------------------------------------------------------------------------

$plus = $_POST['plus'];
$ile  = $_POST['oczka'];
$razy = $_POST['mnoznik'];
$rzuty = $_POST['rzuty'];
$komentarz = $_POST['komentarz'];

$query = "SELECT max(id_rzutu) FROM wyniki";
$result_set = $start->query($query);;// zmieniono z = mysql_query(
// koniec pobierania danych 

if ($razy <= 100 && $rzuty <= 100) {
if($result_set)
	{
		$rows = $start->changes();//zmieniono Z: mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu 
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
			$insert = mysql_query ("INSERT INTO wyniki VALUES ('$klucz', '$kostka', '$rzut', '$plus', '$ile', '$data', '$komentarz', NULL)");
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
						echo "<b>Suma całkowita: </b> $value_suma";
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
			<br/><br/>
			<div id='fb-root'>Wyślij ID rzutu:</div><script src='http://connect.facebook.net/en_US/all.js#xfbml=1'></script><fb:send ref="top_right" href='http://www.alea.cba.pl' font=''></fb:send>
			

		</td>
	</tr>
</table>
<table><tr>
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
        <tr>
        <td valign='bottom'><div class="g-plusone" data-annotation="inline" data-width="120" data-href="http://www.alea.cba.pl"></div></td>
        </tr>
    </table>
			
        </section>
        
        <footer>
            <section id="copyright">
            	<h3 class="hidden">Copyright notice</h3>
                <div class="wrapper">
                    &copy; Copyright 2015 by <a href="http://www.alea.cba.pl">Alea.cba.pl</a>
                </div>
            </section>
            <section class="wrapper">
                <article class="column leftlist">
                    <h4>Polecane strony</h4>
                    <ul>
						<li><a target="_blank" href="http://www.ceneo.pl/Gry_towarzyskie;017Planszowe_P11-46116.htm">Gry planszowe i RPG</a></li>
						<li><a target="_blank" href="http://www.ceneo.pl/Gry;szukaj-kości">Kości do gry</a></li>
						<li><a target="_blank" href="http://www.ceneo.pl/Fantastyka_i_fantasy">Fantastyka i fantasy</a></li>
                    </ul>
                </article>
                <article class="column middletlist">
                    <h4>Fora RPG</h4>
                    <ul>
						<li><a target="_blank" href="http://www.lastinn.info">Lastinn.pl</a></li>
						<li><a target="_blank" href="http://www.erpg.pl">Erpg.pl</a></li>
						<li><a target="_blank" href="http://www.strefarpg.net">Strefarpg.net</a>
                    </ul>
                    <br class="clear"/>
                </article>
            </section>
        </footer>
	</body>
</html>
