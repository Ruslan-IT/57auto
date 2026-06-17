<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalculatorSetting extends Model
{

    protected $table = 'calculator_settings';


    protected $fillable = [
        'country',
        'currency',
        'currency_rate',

        'country_expense_percent',
        'bank_percent',

        'delivery_price',
        'company_fee',
        'russia_expenses',
        'util_fee',

        'customs_percent',
        'customs_fee',
    ];
}
