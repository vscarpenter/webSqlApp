WebSqlApp 
=====================
WebSQL Application with CRUD (Create, Reach, Update, Delete). It uses also jQuery Mobile for a better user interface because CSS3 is not enough for selectbox. The form contains different fields such as text, number, date (with a calendar), selectbox, checkbox and radio button. It uses webSqlSync.js to automatically synchronize the local WebSql database (SQLite of the browser) with a php-MySQL server. The php code for the sync still in development. Thanks to Samuel for WebSqlSync.js (https://github.com/orbitaloop/WebSqlSync).

Installing
==========

- copy the files in the webSqlApp folder on your server.  
- change the connexion data to your server (dbhost, dbname, dbuname, dbpass) in sqlSyncHandlerTest.php.
- change mywebsite.com to your server name.
- index.html is the main file of the application.
 
I hope it will help you to create your own webSql app. You are welcome to improve the the php sever code to do a 2 ways sync.

## Limitations:

 - DELETE are not handled.
 - There are no example of generic server side sync for now. Contribution of server code are welcome (generic or not)!!
 - There is one dependency to JQuery and jQueryMobile (mainly used to improve the UI. jQuery is not used for the sync. I welcome any pull request to remove this dependency (if you can do a good UI for the select box with CSS3).
