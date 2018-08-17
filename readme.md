1) 	install 
	> Example-1 composer create-project laravel/laravel="5.5.*" laravel-example
	> Example-2 laravel new blog --5.5

2) 	remove public from url
> 	
	<IfModule mod_rewrite.c>
		<IfModule mod_negotiation.c>
			Options -MultiViews
		</IfModule>
		
		RewriteEngine On
		
		RewriteCond %{REQUEST_FILENAME} -d [OR]
		RewriteCond %{REQUEST_FILENAME} -f
		RewriteRule ^ ^$1 [N]

		RewriteCond %{REQUEST_URI} (\.\w+$) [NC]
		RewriteRule ^(.*)$ public/$1 

		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteRule ^ server.php
	</IfModule>

3) 	create authentication
> 	php artisan make:auth
4) 	migrate tables
>	php artisan migrate
	
5)	create user
> 	php artisan make:seeder UsersTableSeeder
6)  uncomment in default DatabaseSeeder file
>   database\seeds\DatabaseSeeder.php
7)  Add below conde in to created UsersTableSeeder [step-5]
>   Add below code in run method
    DB::table('users')->insert([
		'name' => 'dinesh',
		'email' => 'dinesh@gmail.com',
		'password' => bcrypt('123123'),
	]);
7)  Run seeder
>	php artisan db:seed --class=UsersTableSeeder
8) 	Create controller
>   php artisan make:controller web\UserController  --resource
    
	Add dependancy modules in UserController
	use Illuminate\Support\Facades\Auth;
	
	Create new dashboard controller
	php artisan make:controller web\dashboardController --resource

9)  Create middleware to protect users	
>	php artisan make:middleware IsLogin
    add below code in this file
	if(Auth::check())
	{
		$response = $next($request);

		return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
		->header('Pragma','no-cache')
		->header('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
	}
	else
	{
		if($request->ajax())
		{
			return response(
			array(
				'status'=>406,
				'msg'=>'Seesion expire',
				'data'=>"You need to login"
			),406)->header('Content-Type','json');
		}
		else
		{
			return redirect('/'); 
		}
	}
	
	Open kernal.php and add middleware inside $routeMiddleware
	'Islogin' => \App\Http\Middleware\Islogin::class,

10) Add middle ware in your route file 
>	Route::middleware(['Islogin'])->group(function () 
	{
		Route::get('/dashboard', 'web\DashboardController@index');
	});		
11) Create one model
>	php artisan make:model models\Users

12) API 
>	Go to App\Exceptions\Handler.php

	public function render($request, Exception $exception)
    {
        return response()->json(
            [
                'errors' => [
                    'status' => 401,
                    'message' => 'Unauthenticated',
                ]
            ], 401
        );
    }