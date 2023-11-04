<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class authJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            if(! $user = JWTAuth::parseToken()->authenticate()){
                return response()->json([
                    "success" => false,
                    "message" => "Error"
                ]);
            }
        } catch (TokenExpiredException $e) {
            return response()->json([
                "success" => false,
                "message" => "Expired"
            ],401);        
        } catch (TokenInvalidException $e) {
            return response()->json([
                "success" => false,
                "message" => "Invalid"
            ],401);
        } catch (JWTException $e) {
            return response()->json([
                "success" => false,
                "message" => "Error"
            ],401);
        }

        return $response;
    }
}