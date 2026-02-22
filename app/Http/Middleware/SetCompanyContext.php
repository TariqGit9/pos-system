<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;

class SetCompanyContext
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();

            if ($user->isSuperAdmin()) {
                // Super admin: use impersonated company if set
                $companyId = session('impersonating_company_id');
                if ($companyId) {
                    $company = Company::find($companyId);
                    view()->share('currentCompany', $company);
                    view()->share('isSuperAdminImpersonating', true);
                } else {
                    view()->share('currentCompany', null);
                    view()->share('isSuperAdminImpersonating', false);
                }
                view()->share('isSuperAdmin', true);
            } else {
                // Regular user: use their company
                $company = $user->company;
                view()->share('currentCompany', $company);
                view()->share('isSuperAdmin', false);
                view()->share('isSuperAdminImpersonating', false);
            }
        }

        return $next($request);
    }
}
