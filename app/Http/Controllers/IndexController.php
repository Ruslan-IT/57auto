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

        // Последние автомобили
        $latestCars = Car::with(['brand', 'model', 'images'])
            ->latest() // ORDER BY created_at DESC
            ->limit(6)
            ->get();

        $usedCars = Car::with(['brand', 'model', 'images'])
            ->where('mileage', '>', 0)
            ->latest()
            ->limit(6)
            ->get();

        $chinaCars = Car::with(['brand', 'model', 'images'])
            ->whereHas('category', function ($q) {
                $q->where('name', 'Китайские');
            })
            ->latest()
            ->limit(6)
            ->get();

        // Справочники для фильтров (марки и модели будут подгружаться через JS)
        $brands = Brand::orderBy('name')->get();



        return view('welcome', compact(
            'categories',
            'activeCategory',
            'cars',
            'brands',
            'latestCars',
            'usedCars',
            'chinaCars',
        ));
    }



    public function show($id)
    {
        $car = Car::with(['brand', 'model', 'images'])->findOrFail($id);
        return view('car_detail', compact('car'));
    }
}
