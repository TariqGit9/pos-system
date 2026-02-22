<?php

namespace Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Currency\Entities\Currency;

class CurrencyDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Currency::create([
            'currency_name'      => 'Pakistani Rupee',
            'code'               => 'PKR',
            'symbol'             => 'Rs',
            'thousand_separator' => ',',
            'decimal_separator'  => '.',
            'exchange_rate'      => null
        ]);

        Currency::create([
            'currency_name'      => 'US Dollar',
            'code'               => 'USD',
            'symbol'             => '$',
            'thousand_separator' => ',',
            'decimal_separator'  => '.',
            'exchange_rate'      => null
        ]);
    }
}
