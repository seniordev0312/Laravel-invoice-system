<?php

namespace App\Plugins\Other\CheckIP\Middleware;

use Closure;

class CheckIP
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
        $ip = request()->ip();
        $ipsAllow = \App\Plugins\Other\CheckIP\Models\CheckIPAccess::getIpsAllow();
        $ipsDeny = \App\Plugins\Other\CheckIP\Models\CheckIPAccess::getIpsDeny();
        if ($ip === '127.0.0.1' || $ip === '::1' || ($ipsAllow && (in_array($ip, $ipsAllow) || in_array('*', $ipsAllow)))
        ) {
            return $next($request);
        } else {
            if ($ipsDeny && (in_array($ip, $ipsDeny) || in_array('*', $ipsDeny))) {
                abort(403, 'Your IP '.$ip.' blocked');
            }
        }
        return $next($request);
    }
}
