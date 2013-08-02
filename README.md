WebSqlApp 
=====================
**WebSQLApp** is an HTML5 WebSql Application with CRUD (Create, Reach, Update, Delete). It uses the local SQLite database included in the browser (Safari, Chrome and many mobile browsers). It uses jQuery Mobile for a better user interface because CSS3 seems not enough for selectbox. The form contains different fields such as text, number, date (with a calendar), selectbox, checkbox and radio button. It uses webSqlSync.js to automatically synchronize the local WebSql database (SQLite of the browser) with a php-MySQL server. The php code for the sync still in development (see sqlSyncHandlerTast.php called by the syncDownloadUnits() function in index.html). Thanks to Samuel for WebSqlSync.js (https://github.com/orbitaloop/WebSqlSync).

Installing
==========

- copy the files in the webSqlApp folder on your server.  
- change the connexion data to your server (dbhost, dbname, dbuname, dbpass) in sqlSyncHandlerTest.php.
- change mywebsite.com to your server name.
- index.html is the main file of the application.
 
I hope it will help you to create your own webSql app. You are welcome to improve the the php sever code to do a 2 ways sync.

## Limitations:

 - DELETE are not handled for now.
 - The sync is in development. In the first time, I try to get (download) the data from the server MySQL database using webSqlSync.js. The next step will be to do a 2 way sync with the server database. Contribution of server code are welcome (generic or not)!!
 - There is one dependency to JQuery and jQueryMobile (mainly used to improve the UI. jQuery is not used for the sync. I welcome any pull request to remove this dependency (if you can do a good UI for the select box and its options with CSS3).