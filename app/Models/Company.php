<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Currency\Entities\Currency;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'use_decimal' => 'boolean',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id', 'id');
    }

    // Accessors for backwards compatibility with settings()->company_name etc.
    public function getCompanyNameAttribute()
    {
        return $this->name;
    }

    public function getCompanyEmailAttribute()
    {
        return $this->email;
    }

    public function getCompanyPhoneAttribute()
    {
        return $this->phone;
    }

    public function getCompanyAddressAttribute()
    {
        return $this->address;
    }

    public function getSiteLogoAttribute($value)
    {
        return $value;
    }
}
