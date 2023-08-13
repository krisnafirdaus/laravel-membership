<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function handle($request, Closure $next, ...$roles)
    {
        if (!in_array(auth()->user()->role, $roles)) {
            // Redirect ke halaman lain atau tampilkan pesan error
            return redirect('/home')->with('error', 'Anda tidak memiliki hak akses untuk halaman ini.');
        }
        return $next($request);
    }

}
