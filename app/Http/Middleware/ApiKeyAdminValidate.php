<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyAdminValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has("api_key_admin")) {
            return response()->json([
                'status' => 401,
                'message' => 'Acceso no autorizado',
            ], 401);
        }
        if ($request->has("api_key_admin")) {
            if ($request->input("api_key_admin") != env('API_KEY_ADMIN')) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Acceso no autorizado',
                ], 401);
            }
        }
        /* $response = $next($request);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Methods", "*");
        $response->headers->set("Access-Control-Allow-Headers", "*");
        return $response; */
        return $next($request)
        //Url a la que se le dará acceso en las peticiones *pueblamotors.com.mx/*
        ->header("Access-Control-Allow-Origin", "*")
        ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');
    }
}
