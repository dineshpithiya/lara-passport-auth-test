<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class IsLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
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
    }
}
