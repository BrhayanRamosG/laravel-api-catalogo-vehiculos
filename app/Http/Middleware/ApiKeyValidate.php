<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKeyValidate
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
        if (!$request->has("api_key")) {
            return response()->json([
                'status' => 401,
                'message' => 'Acceso no autorizado',
            ], 401);
        }
        if ($request->has("api_key")) {
            if ($request->input("api_key") != env('API_KEY_PUBLIC')) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Acceso no autorizado',
                ], 401);
            }
        }

        $response = $next($request);
        $response->headers->set("Access-Control-Allow-Origin", "*");
        $response->headers->set("Access-Control-Allow-Methods", "POST, GET, OPTIONS");
        $response->headers->set("Access-Control-Allow-Headers", "Content-Type, Accept, Authorization, X-Requested-With, Application");
        return $response;

        //return $next($request)
        //Url a la que se le dará acceso en las peticiones *pueblamotors.com.mx/*
        //->header("Access-Control-Allow-Origin", "*")
        //->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        //->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
    }
}
