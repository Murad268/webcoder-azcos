<?php

namespace App\Http\Middleware;

use App\Services\Parameters\ParameterService;
use Closure;
use Illuminate\Support\Facades\Auth;

class CustomAuth
{
    public $lang;
    public function __construct(public ParameterService $parameterService)
    {
        $this->lang = $parameterService->getLang();
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
        $lang = $this->lang;
        if (Auth::check()) {
            // İstifadəçi authentication olmayıbsa, giriş səhifəsinə yönləndir.
            return redirect()->route('admin.index', ['lang' => $lang]);
        }

        return $next($request);
    }
}
