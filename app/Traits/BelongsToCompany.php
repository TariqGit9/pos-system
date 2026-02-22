<?php

namespace App\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToCompany
{
    public static function bootBelongsToCompany(): void
    {
        // Auto-scope queries by company_id
        static::addGlobalScope('company', function (Builder $builder) {
            if (auth()->check()) {
                $user = auth()->user();

                if ($user->is_super_admin) {
                    // Super admin: scope to impersonated company if set
                    $companyId = session('impersonating_company_id');
                    if ($companyId) {
                        $builder->where($builder->getModel()->getTable() . '.company_id', $companyId);
                    }
                    // If no impersonated company, no scope = see all
                } else {
                    // Regular user: always scope to their company
                    $builder->where($builder->getModel()->getTable() . '.company_id', $user->company_id);
                }
            }
        });

        // Auto-set company_id on creating
        static::creating(function ($model) {
            if (auth()->check() && empty($model->company_id)) {
                $user = auth()->user();

                if ($user->is_super_admin) {
                    $model->company_id = session('impersonating_company_id');
                } else {
                    $model->company_id = $user->company_id;
                }
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
