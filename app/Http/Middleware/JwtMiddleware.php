<?php

namespace App\Http\Middleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Closure;
use App\Helpers\APIHelper;


class JwtMiddleware
{
    private $jwt;
    private $user;

    public function __construct(\Tymon\JWTAuth\JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            $this->jwt->setToken($request->bearerToken());
            $payload = $this->jwt->getPayload();
            $request->current_user_id = $payload->get('sub');
            $request->current_user_email = $payload->get('data')->email;
            $request->current_user_type = $payload->get('data')->user_type;

        }
        catch (TokenExpiredException $e) {
            return APIHelper::makeAPIResponse(false, "Token Expired", null, 401);
        } catch (TokenInvalidException $e) {
            return APIHelper::makeAPIResponse(false, "Invalid Token", null, 401);
        } catch (JWTException $e) {
            return APIHelper::makeAPIResponse(false, "Token Exception", null, 400);
        } catch (\Exception $e) {
            report($e);
            return APIHelper::makeAPIResponse(false, "Token Exception", null, 400);
        }
        return $next($request);
    }

}
