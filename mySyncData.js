var SYNCDATA = {
    url: 'http://www.myWebSite.com/webSqlAppGit',// Set your server URL here
    database: 'mywebdb',	// webSQL database object name = db (line 237 of indext.html)
    tableToSync: [{
        tableName: 'Unites',
        idName: 'uniteId'
    }, {
        tableName: 'FiltreParam'
    }, {
        tableName: 'UserParam'
    }, {
        tableName: 'Contacts'
    }],
    sync_info: {//Example of user info
        userEmail: 'name@abc.com',//the user mail is not always here
        device_uuid: 'UNIQUE_DEVICE_ID_287CHBE873JB',//if no user mail, rely on the UUID
        lastSyncDate: 0,
		device_version: '5.1',
        device_name: 'test navigator',
		userAgent: navigator.userAgent,
        //app data
        appName: 'fr-en',
        mosa_version: '3.2',
        lng: 'fr'
    },

	insertTestData2: function(callBack){//TODO use this insert
		var self = this;
        this.database.transaction(function(transaction){
            //Add new local data :
            transaction.executeSql('INSERT INTO card_stat ' +
	            '(card_id,firstViewTime,previousInterval,interval,previousDue,due,isDue,previousEFactor,eFactor,reponseNb,successiveRep,' +
	            'thinkingDuration,totalDuration,averageDuration,nbOK,nbKo,tState) ' +
	            'VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [4, 1426476477.829, 4, 4, 4, 4, true, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4], SYNCDATA._nullDataHandler, SYNCDATA._errorHandler);

			transaction.executeSql('INSERT INTO variable (name,type,value) VALUES (?,?,?)', ['MyVar55', 'test', '5555'], function(){
                callBack();
            }, self._errorHandler);
        });//end tx
    },
	_updateData : function(callback) {
		var self = this;
		SYNCDATA.database.transaction(function(transaction){
        	transaction.executeSql('UPDATE card_stat SET "due" = "1326592755.572902", "eFactor" = "66", '+
				 '"nbKO" = "6", "nbOK" = "66", "thinkingDuration" = "66666", "totalDuration" = "6666666666666", '+
				 ' WHERE card_id = "1"', []);
            transaction.executeSql('UPDATE stat SET "date" = "55555", "name" = "FakeNumber5", "value" = "555" WHERE id = "1"', [], SYNCDATA._nullDataHandler, SYNCDATA._errorHandler);
			transaction.executeSql('UPDATE user_card SET "fr" = "test cartes utilisateurs55", "en" = "test user cards55" WHERE id = "1"', [], SYNCDATA._nullDataHandler, SYNCDATA._errorHandler);
            transaction.executeSql('UPDATE variable SET "name" = "MyVar", "type" = "5", "value" = "55" WHERE name = "MyVar"', [],
				function() {
			                callback();
            	}, SYNCDATA._errorHandler);
		});
	},
    _nullDataHandler: function(){

    },
    _errorHandler: function(transaction, error){
        console.error('Error : ' + error.message + ' (Code ' + error.code + ') Transaction.name = ' + transaction.name);
    }
};
