<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Главная страница с табами и формой фильтра.
     */
    public function index()
    {
        // Получаем все категории (Китай, Корея, ОАЭ) для табов
        $categories = Category::all();

        // По умолчанию показываем первую категорию (например, Китай)
        $activeCategory = $categories->first();
        if ($activeCategory) {
            $cars = Car::with(['brand', 'model', 'images'])
                ->where('category_id', $activeCategory->id)
                ->limit(12)
                ->get();
        } else {
            $cars = collect();
        }

        // Справочники для фильтров (марки и модели будут подгружаться через JS)
        $brands = Brand::orderBy('name')->get();

        return view('welcome', compact('categories', 'activeCategory', 'cars', 'brands'));
    }

    /**
     * AJAX-фильтр автомобилей по категории, марке, модели, цене.
     */
    public function filter(Request $request)
    {
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




    public function show($id)
    {
        $car = Car::with(['brand', 'model', 'images'])->findOrFail($id);
        return view('car_detail', compact('car'));
    }
}
