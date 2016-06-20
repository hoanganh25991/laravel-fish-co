#fish & co
fish & co, framework [laravel](https://laravel.com/)

read API at __app\routes.php__ file

you can use __Postman__ to check

	#if you have `Postman`, you can run test api
	#after complete below steps

	#at root folder
	api-test-postman.html
	#click to run & enjoy ^^
##composer
to load dependencies of project, after clone, run command

	composer install
##.env
at root project, base on .env.example, create .env file

	#some important infomation need provided
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=fish_go
	DB_USERNAME=root
	DB_PASSWORD=ifrc

	UPLOAD_FOLDER=D:\work-station\laravel-fish-go\public\upload
	FISH_CO_KEY=whalefishcomeco
##run migration to create database
at root project, run command

	php artisan migrate
##dump data
at root project, import data from `dump-data.sql`

##run
at root project, run command

	php artisan serve
	#project in running up on localhost:8000

