<?php

namespace Modules\Expense\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Traits\BelongsToCompany;

class ExpenseCategory extends Model
{
    use HasFactory, BelongsToCompany;

    protected $guarded = [];

    public function expenses() {
        return $this->hasMany(Expense::class, 'category_id', 'id');
    }
}
