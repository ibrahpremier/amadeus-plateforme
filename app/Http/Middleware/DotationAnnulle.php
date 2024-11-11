<?php

namespace App\Http\Middleware;

use App\Models\Budget;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class DotationAnnulle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();

        // dd($user);

        if ($user->isMinistereAgent() && !Route::currentRouteNamed('budget.store')) {

            $lastYear = (int) $user->getMinistereCurrentBudget()?->annee_budgetaire;
            $currentYear = (int) date('Y');
            // dd($lastYear, $currentYear);
            if ($currentYear > $lastYear) {
                Session::flash('BudjetAnuelle', true);
            }

            // if (!Route::currentRouteNamed('dashboard.index')) {
            //     return  to_route('dashboard.index');
            // }
        }

        return $next($request);
    }
}
