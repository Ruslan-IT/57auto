<?php

namespace App\Services;

use App\Models\CalculatorSetting;

class CalculatorService
{
    /**
     * Create a new class instance.
     */

      /*

       1. Стоимость авто в рублях
        $carPriceRub = $price * $settings->currency_rate;

        2. Расходы по стране
        $countryExpenses = $carPriceRub * ($settings->country_expense_percent / 100);

        3. Комиссия банка
        $bankFee = $carPriceRub * ($settings->bank_percent / 100);

        4. Таможня
        $customs = $carPriceRub * ($settings->customs_percent / 100) + $settings->customs_fee;


        5. Итог

        $total =
            $carPriceRub +
            $countryExpenses +
            $bankFee +
            $settings->delivery_price +
            $settings->company_fee +
            $settings->russia_expenses +
            $settings->util_fee +
            $customs;


      */


    public function __construct()
    {
        //
    }

    public function calculate( array $data): array
    {

        $settings = CalculatorSetting::where(
            'country',
            $data['country']
        )->firstOrFail();


        $carPriceRub =
            $data['price'] * $settings->currency_rate;  // в рублях

        $countryExpenses =
            $carPriceRub *
            ($settings->country_expense_percent / 100);

        $bankFee =
            $carPriceRub *
            ($settings->bank_percent / 100);

        $age = now()->year - $data['year'];

        //возраст
        if ($age <= 3) {

            $customs =
                $data['engine_volume'] * 3.5;

        } elseif ($age <= 5) {

            $customs =
                $data['engine_volume'] * 5.5;

        } else {

            $customs =
                $data['engine_volume'] * 7;
        }


        //Для электромобилей:
        if ($data['fuel_type'] === 'electric') {

            $customs *= 0.5;
        }


        //Для гибридов:
        if ($data['fuel_type'] === 'hybrid') {

            $customs *= 0.8;
        }


        //Реальную таблицу таможни
        //Утильсбор




        $total =
            $carPriceRub +
            $countryExpenses +
            $bankFee +
            $customs +
            $settings->delivery_price +
            $settings->company_fee +
            $settings->russia_expenses +
            $settings->util_fee;

        return [
            'car_price_rub' => round($carPriceRub),  //Цена авто в РФ:
            'country_expenses' => round($countryExpenses), //Расходы в стране:
            'bank_fee' => round($bankFee), //Комиссия банка:
            'customs' => round($customs), //Таможня
            'total' => round($total),
            'currency_rate' => $settings->currency_rate,
        ];
    }
}
