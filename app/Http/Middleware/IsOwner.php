<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $model)
    {
        switch($model){
            case 'user':
                $user = \App\User::findOrFail($request->id);
                $auth_key = $user->id;
                break;
            case 'article':
                $article = \App\Model\Article::findOrFail($request->id);
                $auth_key = $article->author_id;
                break;
            default:
                $auth_key = 0;
                break;
        }

        if ($auth_key == Auth::user()->id)
        {
            return $next($request);
        }else{
            throw new \App\Exceptions\AccessDenyException($request);
        }
    }
}
