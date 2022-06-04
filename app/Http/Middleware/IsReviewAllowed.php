<?php

namespace App\Http\Middleware;

use App\Models\Review;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsReviewAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        User::getActiveMechanicById($request->route('id'));
        if ($request->route('id') == Auth::id()) {
            return back();
        }
        if (Review::where('user_id', Auth::id())->where('mechanic_id', $request->route('id'))->where('created_at', '>=', now()->subDay())->exists()) {
            return back();
        }
        return $next($request);
    }
}
