<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController
{

    public function getModels($brand_id){

        $result = CarModel::where('brand_id', $brand_id)->get(['id', 'name']);
        return $result;
    }


    /**
     * AJAX-фильтр автомобилей по категории, марке, модели, цене.
     */

    public function filter(Request $request){

        $categoryId = $request->input('category_id');
        $brandId    = $request->input('brand_id');
        $modelId    = $request->input('model_id');
        $priceMin   = $request->input('price_min');
        $priceMax   = $request->input('price_max');

        $query = Car::with(['brand', 'model', 'images']);

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($brandId) {
            $query->where('brand_id', $brandId);
        }

        if ($modelId) {
            $query->where('model_id', $modelId);
        }

        if ($priceMin) {
            $query->where('price_russia', '>=', (int) $priceMin);
        }

        if ($priceMax) {
            $query->where('price_russia', '<=', (int) $priceMax);
        }

        $cars = $query->orderBy('created_at', 'desc')->limit(12)->get();

        // Возвращаем только HTML-код карточек
        return response()->json([
            'html' => view('partials.car_cards', compact('cars'))->render(),
        ]);
    }

}
