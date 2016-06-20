<?php

namespace App\Http\Middleware;

use Closure;
use Response;
use Validator;

class ApiToken{
    const STATUS_CODE = "statusCode";
    const STATUS_MSG = "statusMsg";
    const DATA = "data";
    const WARNING = "sorry, we still not handle this situation";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $validator = Validator::make($request->all(), [
            "_token" => "required|token"
        ]);
        if($validator->fails()){
            return Response::json([
                self::STATUS_CODE => 434,
                self::STATUS_MSG => "token api fail",
                self::DATA => $validator->getMessageBag()->toArray(),
            ], 434);
        }
        return $next($request);
    }
}
