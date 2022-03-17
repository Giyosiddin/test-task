<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Company
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()){
            if(Auth::user()->isAdmin()){
                return $next($request);
            }else{
                if(Auth::user()->checkCompany($request->company_id)){
                    return $next($request);
                }elseif(Auth::user()->checkEmployee($request->route('employee_id'))){
                    return $next($request);
                }else{
                    return response()->json([
                        'success' => false,
                        'message' => "You do have no access to this request or no data with this ID!",
                    ]);
                }
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => "You should sign in your account!",
            ]);
        }
    }
}
