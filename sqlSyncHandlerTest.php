<?php
// Name: sqlSyncHandlerTest.php 

/*******************************************************************
 * sqlSyncHandlerTest.php is a part of WebSqlApp, a local WebSQL DB (SQLite) CRUD application.
 * sqlSyncHandlerTest is under development. The first objective is to get the data from MySQL to webSqlApp. The next objective is to do a 2 ways sync.
 * WebSqlApp use WebSqlSync.js to sync to a server.
 * Thanks to Samuel Michelot for webSqlSync.js	https://github.com/orbitaloop/WebSqlSync
 ******************************************************************/
/*
Usage: https://github.com/abeauseigle/webSqlApp

 Copyright (c) 2013, Alain Beauseigle of AffairesUP.com (R&D tax credit expert in QC, Canada)
 Permission is hereby granted, free of charge, to any person obtaining a
 copy of this software and associated documentation files (the "Software"),
 to deal in the Software without restriction, including without limitation the
 rights to use, copy, modify, merge, publish, distribute, sublicense,
 and/or sell copies of the Software, and to permit persons to whom the Software
 is furnished to do so, subject to the following conditions:

 The above copyright notice and this permission notice shall be
 included in all copies or substantial portions of the Software.

 THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
		
	include("SqlSyncHandler.php");
	
	// initialize the json handler from 'php://input' 
	$handler = new SqlSyncHandler();
	
	// initialize the json handler from a file
	// $handler = new SqlSyncHandler('flow.json');	// flow.json contents:	{"info":[],"data":{"name": "sg4r3z"}}
	// $handler = new SqlSyncHandler('flow.json');	// flow.json contents:	{"result":"OK","message":"this is a positive reply","sync_date":1371753757,"data":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}
	
	// call a custom function which will make a job with parsed data
	$handler -> call('myJob',$handler);
	
	// myJob function
	function myJob($handler){
		
		// getting a clientData
		 print_r($handler -> get_clientData());	//php: print_r — Affiche des informations lisibles pour une variable

		// getting a row json flow
		echo $handler -> get_jsonData();

		// My job is to get all the table data from the server and send a json to client
		$handler -> reply(true,"this is a positive reply", getAllServerData());	// with a dynamic array coming from a MySQL query //function reply($status,$message,$data)
		// It return $serverAnswer from SqlSyncHandler.php:	{"result":"OK","message":"this is a positive reply","sync_date":1371581851,"data":{"Unites":[{"UniteID":"0","UniteSymbol":"h"},{"UniteID":"1","UniteSymbol":"km"},{"UniteID":"2","UniteSymbol":"$"},{"UniteID":"3","UniteSymbol":"U$"},{"UniteID":"4","UniteSymbol":"\u20ac"},{"UniteID":"5","UniteSymbol":"$P"}]}} 

		// a error reply example
		//$handler -> reply(false,"this is a error reply",array('browser' => 'firefox'));
	}

function getAllServerData(){		//using an associative array
// Define here the tables to sync Server side param1 is the webSql table name and param2 is the MySQL table name
$tablesToSync = array(
//	array( "tableNameWebSql" => 'Categories', "tableName_MySql" => 'RN_Categorie' ),
	array( "tableNameWebSql" => 'Unites', "tableName_MySql" => 'RN_Unite' )
);

$getServerData = array();
connectdb();
foreach($tablesToSync as $value){
	$query = "SELECT * FROM " . $value['tableName_MySql'];
	$sql = mysql_query($query);
	$sql_result = array();
    while($row = mysql_fetch_object($sql)){
		$sql_result[] = $row;
    }
	$getServerData[$value['tableNameWebSql']] = $sql_result;
}

unset($value); // Utile ??? Supposé détruire la référence sur le dernier élément
return $getServerData;
}
/*
function getAllUnits(){		    // ToDo: put it seperately in getUnits.php, getContacts.php, ...

	connectdb();
	$query = "SELECT * FROM RN_Unite";

	$getUnits = array();
	$sql_result = mysql_query($query);
    while($row = mysql_fetch_array($sql_result)){
		$getUnits[] = $row;
    }
	//mysql_close($dbname); //bug
	return $getUnits;
}
*/
function connectdb(){			// ToDo: put it seperately in loginCheck.php and getUnits.php
// Prevent caching.
///header('Cache-Control: no-cache, must-revalidate');
///header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

// The JSON standard MIME header.
///header('Content-type: application/json');
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
