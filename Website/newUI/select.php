<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generator rzutu kośćmi - OnLine</title>
		<meta name="description" content="Generator rzutu kośćmi - Znajdź zapisane wyniki." />
		<meta name="keywords" content="Generator rzutu kośćmi, Symulator rzutu kośćmi, Rzut kostką, Rzut kością online, Kości do gry, Kostka do gry, Gry RPG"/>
		<link rel="canonical" href="http://www.alea.cba.pl/">
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
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
        /*
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-9373110-2']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        */
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

		<script src="diceApp.js"></script>
        <script src="settings.js"></script>
        <script src="script.js"></script>

        <header>            
            <a href="http://www.alea.cba.pl"><h1>Generator rzutu kośćmi</h1></a>
            <p><a href="http://www.alea.cba.pl">Alea.cba.pl</a></p>
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
//query 5 - komentarz
$query5 = "SELECT Komentarz FROM wyniki WHERE id_rzutu = $idrzutu GROUP BY Komentarz";
$result_set5 = mysql_query($query5);

if($result_set5)
	{
		$rows5 = mysql_affected_rows(); //obliczamy ile jest rekordów w zapytaniu
		for ($i5=1; $i5<=$rows5; $i5++)
			{
				$record5 = mysql_fetch_row($result_set5); //bierzemy kolejny rekord
				foreach($record5 as $koment) // i wyświetlamy ten rekord
					{ 
						$koment; //pokazujemy na stronie
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
echo "<b>Komentarz:</b> $koment<br/>"
?>
</p>	
<br/>
<p><a href="/"><input type='submit' value='Wróć'></a></p>

</td></tr></table>
			
        </section>
        

<section>
<div id="sramka">

        <noscript>

            <div style="border: 1px solid red; padding: 10px;background-color:white;text-align:center;">
                <span style="color:red;background-color:white;"><h1>NO JAVASCRIPT</h1>
You need it to see our new nice interface:
<img src="http://imageshack.com/a/img923/2711/JQsUC6.jpg" width=70%>
<h6>Unfortunately and unbelievably (in or after 2017) your browser still does not support Javascript or it is not enabled. <br>
                <br>Go then and walk a dog and dont forget to come back with newer device. <br><br>Alternatively, you can use our oldschool version </h6>
                <a href="/" style="background-color:lightgray;color:blue;">here</a>

        </noscript>






</div>

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
