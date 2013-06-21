<?php
// sqlSyncHandlerTest.php 
// Goal: To test if SqlSyncHandler.php works with data comming from a MySQL query using myJob. R: It works
		
	include("SqlSyncHandler.php");
	
	// initialize the json handler from 'php://input' 
	$handler = new SqlSyncHandler();
	
	// initialize the json handler from a file
	// $handler = new SqlSyncHandler('flow.json');	// flow.json contents:	{"info":[],"data":{"name": "sg4r3z"}}
	
	// call a custom function which will make a job with parsed data
	$handler -> call('myJob',$handler);
	
	// myJob function
	function myJob($handler){
		
		// getting a clientData
		// print_r($handler -> get_clientData());	//php: print_r — Affiche des informations lisibles pour une variable

		// getting a row json flow
		echo $handler -> get_jsonData();
		// this is an example of job

		// a positive reply for client
		$handler -> reply(true,"this is a positive reply", getAllUnits());	// with a dynamic array coming from a MySQL query
		// It return $serverAnswer du Handler:	myJob{"result":"OK","message":"this is a positive reply","sync_date":1371581851,"data":{"browser":"firefox"}}

		// a error reply example
		//$handler -> reply(false,"this is a error reply",array('browser' => 'firefox'));
	}

function getAllUnits(){		    // ToDo: put it seperately in getUnits.php, getContacts.php, ...

	connectdb();
	$query = "SELECT * FROM UnitsTable";

	$getUnits = array();
	$sql_result = mysql_query($query);
    while($row = mysql_fetch_object($sql_result)){
		$getUnits[] = $row;
    }
	//mysql_close($dbname); //bug
	return $getUnits;
}

function connectdb(){			// ToDo: put it seperate in loginCheck.php and getUnits.php
// Prevent caching.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

// The JSON standard MIME header.
header('Content-type: application/json');
//$id = $_GET['id'];	// usefull if we need a specific record

    //Connexion to the database WITHOUT access control. 
	$dbhost  = "localhost";
	$dbname  = "__________";
	$dbuname = "__________";
	$dbpass  = "__________";
	
	$connect=mysql_pconnect($dbhost, $dbuname, $dbpass) or die("Impossible de se connecter au serveur $server" + mysql_error()); 
	$db= mysql_select_db($dbname) or die("Could not select database"+ mysql_error());
	
	mysql_set_charset('utf8', $connect);		
}
?>
