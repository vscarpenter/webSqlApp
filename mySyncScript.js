/**
 * mySyncScript.js
 * It uses mySyncData to feed the parameters, but not le database object parameter, 
 * because, it doesn't work via SYNCDATA.database that seems require a string. 
 */

function syncFirst(){	// Fonctionnal: The 2 tables for the sync are created. 
	DBSYNC.initSync(SYNCDATA.tableToSync, mywebdb, SYNCDATA.sync_info, SYNCDATA.url, function(firstSync){	//Parameters are defined in mySyncData.js
/*     if (result.syncOK === true) {
         //Synchronized successfully
		alert("Sync success");
     }
*/
			DBSYNC.syncNow(_syncProgress, function(){ _test1CheckContent(); 
		});
	});
}
