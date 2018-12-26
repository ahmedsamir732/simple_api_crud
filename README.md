# simple_api_crud

#Install

clone the repo, then `cd simple_api_crud`, then run:
`docker-compose up --build`

this should install the script environment for you, the php will run on port `8080`, and the phpmyadmin will run on port `8082`.

After the docker build ended you have to take the DB file attached and open phpmyadmin on `http://127.0.0.1:8082` and import the db on in it, the default DB name is `api_crud` if you want yo change it you have to change it also on `./code/src/config/DB.php` file.

Now your environment is ready, all you have to do now is open your `postman` and import the colllection attached in the repo and start. 
