<?php

namespace App\Http\Middleware;
use App\Admin;
use Closure;
use Auth;

use Illuminate\Support\Facades\Route;
class AccessAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $admin;
    public function __construct(Admin $admin){
        $this->admin = $admin;
    }
  
    public function handle($request, Closure $next)
    {
        if (Auth::user()->hasAnyRoles(['user'])) {
            return $next($request);
        }
        return redirect('/dashboard');

        $actions =  Route::getCurrentRoute()->getAction();

        $roles = isset($actions['roles']) ? $actions['roles'] : null;
            
        if($this->admin->hasAnyRole($roles) || !$roles){
                return $next($request);
            }else{
              return abort(401);   
            }
    }
        
       
    
}
