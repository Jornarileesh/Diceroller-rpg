<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Diceroller - OnLine</title>
		<meta name="description" content="Diceroller RPG OnLine - set your dices"/>
		<meta name="keywords" content="diceroller, dice simulator, rpg dice, diceroller online, dice throw, rpg games"/>
        <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen" />
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
            <a href="http://www.diceroller-rpg.com/eng/"><h1>Diceroller</h1></a>
            <p><a href="http://www.diceroller-rpg.com/eng/">Diceroller-rpg.com</a></p>
            <nav>
                <ul>
                    <?php include('menu.php'); ?>
                </ul>
            </nav>
        </header>
        <section id="spacer">   
            <div class="search">
                <form method='post' action='select.php'>
                    <input type="text" name="idrzutu" value="Dice throw number" onclick="clearField(this)"/>
                    <input type="submit" name="start_search" value="Check result"/>
                </form>
            </div>            
        </section>
        <section id="boxcontent">

	<table><tr><td>
  
	<table>
		<form method='post' action='kostka.php'>
			<tr>
				<td>How many throws</td>
				<td><input type="text" name="rzuty" size="2" value="1"/></td>
			</tr>
			<tr>
				<td>How many dices</td>
				<td><input type="text" name="mnoznik" size="2" value="1"/></td>
			</tr>
			<tr>
				<td>Dice type (d)</td>
				<td><input type="text" name="oczka" size="2" value="6"/></td>
			</tr>
			<tr>
				<td>Throw modificator</td>
				<td><input type="text" name="plus" size="2" value="0"/></td>
			</tr>
            <tr>
                <td>Comment</td>
                <td><textarea name="komentarz" rows="4" cols="35" maxlength="150"></textarea></td>
            </tr>
			<tr>
				<td><input type='submit' value='Go'></td>
				<td></td>
			</tr>
		</form>
	</table>
	
	</td><td>
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
	</table></td></tr>
	</table>
			
        </section>
        
        <footer>
            <section id="copyright">
            	<h3 class="hidden">Copyright notice</h3>
                <div class="wrapper">
                    &copy; Copyright 2015 by <a href="http://www.diceroller-rpg.com">diceroller-rpg.com</a>
                </div>
            </section>
            <section class="wrapper">
                <article class="column leftlist">
                    <h4>Recommended sites</h4>
                    <ul>
						<li><a target="_blank" href="http://www.ceneo.pl/Gry_towarzyskie;017Planszowe_P11-46116.htm">Gry planszowe i RPG</a></li>
						<li><a target="_blank" href="http://www.ceneo.pl/Gry;szukaj-kości">Kości do gry</a></li>
						<li><a target="_blank" href="http://www.ceneo.pl/Fantastyka_i_fantasy">Fantastyka i fantasy</a></li>
                    </ul>
                </article>
                <article class="column middletlist">
                    <h4>RPG forums</h4>
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
