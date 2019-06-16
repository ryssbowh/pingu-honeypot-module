<?php

namespace Pingu\HoneyPot\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Pingu\HoneyPot\Events\SpamDetected;

class PreventsSpam
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
        if(\Auth::user()){
            return $next($request);
        }
        if (! config('honeypot.enabled')) {
            return $next($request);
        }
        if (! $request->isMethod('POST')) {
            return $next($request);
        }
        $name = config('honeypot.fieldName');
        $value = $request->post($name);

        if (! empty($value)) {
            return $this->respondToSpam($request, $next);
        }

        return $next($request);
    }

    public function respondToSpam(Request $request)
    {
        event(new SpamDetected($request));
        return response('');
    }
}
