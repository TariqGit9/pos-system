<?php

namespace Modules\People\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\BelongsToCompany;

class Supplier extends Model
{
    use HasFactory, BelongsToCompany;

    protected $guarded = [];

    protected static function newFactory() {
        return \Modules\People\Database\factories\SupplierFactory::new();
    }
}
