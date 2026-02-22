<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\BelongsToCompany;

class Unit extends Model
{
    use HasFactory, BelongsToCompany;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Setting\Database\factories\UnitFactory::new();
    }
}
