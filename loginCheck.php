<?php
/*
$dbhost = "localhost";
$dbuname = "root";
$dbpass = "";
$dbname = "test";
*/
$dbhost = "localhost";
$dbname = "_________";
$dbuname = "_________";
$dbpass = "_________";

$connect=mysql_pconnect($dbhost, $dbuname, $dbpass) or die("Impossible de se connecter au serveur $server"); 
$db= mysql_select_db($dbname);

mysql_set_charset('utf8', $connect);		
/* De Tuanan Android: expertup/mobile/checkLogin.php
$strUname = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['UsagerNom'] : addslashes($_REQUEST['UsagerNom']))   , ENT_QUOTES);
$strPword = htmlentities(   (  (get_magic_quotes_gpc()  ) ? $_REQUEST['UsagerPassword'] : addslashes($_REQUEST['UsagerPassword']))   , ENT_QUOTES);
*/

// À faire: Prendre le userId et le password de la table userParam de la BD webSQL (comment en js ? via un login.html bidon?)
//En attendant, le ID et PW est hardcodé pour vérifier la fonctionnalité de webSqlSync.js 
$loginPost = stripslashes('__my_user_name__'); //ToDo: To use the user name and password of the WebSqlApp stored in the webSql DB
$passwordPost = stripslashes('__my_password__'); 

$strUname = mysql_real_escape_string($loginPost); 
$strPword = mysql_real_escape_string($passwordPost); 
	 
// CL est pour Check Login
$CLquery = "SELECT Count(UsagerID) FROM RN_Usager"
				 	 ." WHERE UsagerActif = 1 AND UsagerNom = '".$strUname."'"
					 ." AND UsagerPassword = PASSWORD('".$strPword."') "
					 ." ORDER BY UsagerID DESC";

$CLresult = mysql_query($CLquery) or die(mysql_error());
$CLnum_rows = mysql_num_rows($CLresult);

session_start();	//pas présent dans le code de Android ??? peut-être à cause qu'il ne faut pas de variable de session ?  // possiblement à mettre plus haut 
$_SESSION['ClientID']=$CLresult['ClientID'];

?>


