<?php
include "loginCheck.php";

if ($CLnum_rows){
//	switch ($_REQUEST['Version']){
//    case $KEY_RDNET:
      $query = "SELECT UniteID, UniteSymbol"
            	." FROM RN_Unite"
            	." ORDER BY UniteID ASC ";
/*     break;
	  case $KEY_EXPERTUP:
      $query = "SELECT UniteID, UniteSymbol"
            	." FROM EX_Unite"
            	." ORDER BY UniteID ASC ";
     break;
  	 default: echo $_REQUEST['Version'];
	}		
*/
  $result = mysql_query($query);
  $num_rows = mysql_num_rows($result);
  
  if ($num_rows){
    while($e = mysql_fetch_assoc($result)) {
       $info[] = $e;
    }
  }else{
  	$info[] = $query;
  }
	print(json_encode($info));
}

?>