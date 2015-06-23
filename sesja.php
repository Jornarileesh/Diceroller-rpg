<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
<head>
<title>Generator rzutu kośćmi</title>
<meta content="Generator rzutu kośćmi" name="description"/>
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="Shortcut icon" href="icon.gif" />

</head>
<body id="top">

<?php 
include('baza.php'); /*połączenie się z bazą*/
session_start();
        if (!isset($_SESSION['inicjuj']))
        {
                session_regenerate_id();
                $_SESSION['inicjuj'] = true;
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
        }
/*echo 'Twoje IP to '.$_SESSION['ip'].;*/

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

$insert = mysql_query ("INSERT INTO ip (ip, data) VALUES ('$ip', '$data')");

/*
echo $ip;
echo '<br />';
echo $data;
echo '<br />';
echo 'Dokonano wpisu do bazy';
*/

/*
$to = "t.ciarachowicz@gmail.com";
$subject = "Witaj w alea.cba.pl!";
$message = "Witaj, ten mail został do Ciebie wysłany ponieważ podano ten adres e-mail na stronie alea.cba.pl. Pozdrawiamy, zespół alea.cba.pl!";
$from = "alea.cba.pl";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
echo "Mail Sent.";
*/

?>
</body>
</html>