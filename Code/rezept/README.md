# Rezepte

## Start
To start the application just go into the project folder and run the `docker-compose up`. 
Then just go to your localhost to see the application. If you should see an error 
respectively a costume error page, go into the docker-compose.yml and add `ports: - 5984:5984` 
under couchdb. After just run the two .http file in the folder "Datenbank" in the following 
order. Fist run the `db setup.http` after run the `insert rezepte.http`. Http files are 
especially for IntelliJ, for VSCode use the "httpYAC" plugin (not tested). Another 
possibility would be the [Rest-Cli](https://github.com/restcli/restcli)  which is compatible 
with IntelliJ (not tested). If nothing works it would be possible to run the commands from the 
http files manual with curl.
