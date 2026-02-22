<?php

if (!function_exists('settings')) {
    function settings() {
        if (!auth()->check()) {
            // Fallback for unauthenticated context (e.g., login page)
            return cache()->remember('settings_default', 24*60, function () {
                return \Modules\Setting\Entities\Setting::first();
            });
        }

        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $companyId = session('impersonating_company_id');
            if ($companyId) {
                return cache()->remember('settings_company_' . $companyId, 24*60, function () use ($companyId) {
                    $company = \App\Models\Company::with('currency')->find($companyId);
                    return $company;
                });
            }
            // Super admin not in any company — return first company or setting fallback
            return cache()->remember('settings_default', 24*60, function () {
                $company = \App\Models\Company::with('currency')->first();
                if ($company) return $company;
                return \Modules\Setting\Entities\Setting::first();
            });
        }

        // Regular user — return their company
        $companyId = $user->company_id;
        return cache()->remember('settings_company_' . $companyId, 24*60, function () use ($companyId) {
            return \App\Models\Company::with('currency')->find($companyId);
        });
    }
}

if (!function_exists('format_currency')) {
    function format_currency($value, $format = true) {
        if (!$format) {
            return $value;
        }

        $settings = settings();

        if (!$settings || !$settings->currency) {
            return number_format((float) $value, 2, '.', ',');
        }

        $position = $settings->default_currency_position;
        $symbol = $settings->currency->symbol;
        $decimal_separator = $settings->currency->decimal_separator;
        $thousand_separator = $settings->currency->thousand_separator;
        $decimals = $settings->use_decimal ? 2 : 0;

        if ($position == 'prefix') {
            $formatted_value = $symbol . ' ' . number_format((float) $value, $decimals, $decimal_separator, $thousand_separator);
        } else {
            $formatted_value = number_format((float) $value, $decimals, $decimal_separator, $thousand_separator) . ' ' . $symbol;
        }

        return $formatted_value;
    }
}

if (!function_exists('make_reference_id')) {
    function make_reference_id($prefix, $number) {
        $padded_text = $prefix . '-' . str_pad($number, 5, 0, STR_PAD_LEFT);

        return $padded_text;
    }
}

if (!function_exists('array_merge_numeric_values')) {
    function array_merge_numeric_values() {
        $arrays = func_get_args();
        $merged = array();
        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                if (!is_numeric($value)) {
                    continue;
                }
                if (!isset($merged[$key])) {
                    $merged[$key] = $value;
                } else {
                    $merged[$key] += $value;
                }
            }
        }

        return $merged;
    }
}
