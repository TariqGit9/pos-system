<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected array $tables = [
        'products',
        'categories',
        'customers',
        'suppliers',
        'sales',
        'sale_details',
        'sale_payments',
        'sale_returns',
        'sale_return_details',
        'sale_return_payments',
        'purchases',
        'purchase_details',
        'purchase_payments',
        'purchase_returns',
        'purchase_return_details',
        'purchase_return_payments',
        'quotations',
        'quotation_details',
        'expenses',
        'expense_categories',
        'adjustments',
        'adjusted_products',
        'units',
        'currencies',
    ];

    public function up(): void
    {
        // First, create a default company from existing settings (if any)
        $setting = DB::table('settings')->first();
        $defaultCompanyId = null;

        if ($setting) {
            $defaultCompanyId = DB::table('companies')->insertGetId([
                'name' => $setting->company_name ?? 'Default Company',
                'email' => $setting->company_email ?? null,
                'phone' => $setting->company_phone ?? null,
                'address' => $setting->company_address ?? null,
                'default_currency_id' => $setting->default_currency_id ?? null,
                'default_currency_position' => $setting->default_currency_position ?? 'prefix',
                'notification_email' => $setting->notification_email ?? null,
                'site_logo' => $setting->site_logo ?? null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultCompanyId = DB::table('companies')->insertGetId([
                'name' => 'Default Company',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add company_id to all business tables
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->unsignedBigInteger('company_id')->nullable()->after('id');
                    $table->index('company_id');
                });

                // Assign existing records to default company
                DB::table($tableName)->whereNull('company_id')->update(['company_id' => $defaultCompanyId]);
            }
        }

        // Set first user as super admin, assign others to default company
        $firstUser = DB::table('users')->orderBy('id')->first();
        if ($firstUser) {
            DB::table('users')->where('id', $firstUser->id)->update([
                'is_super_admin' => true,
                'company_id' => null,
            ]);

            // Assign all other users to default company
            DB::table('users')->where('id', '!=', $firstUser->id)->update([
                'company_id' => $defaultCompanyId,
            ]);
        }
    }

    public function down(): void
    {
        foreach (array_reverse($this->tables) as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'company_id')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropIndex(['company_id']);
                    $table->dropColumn('company_id');
                });
            }
        }
    }
};
