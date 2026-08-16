<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Главная страница.
     */
    public function index()
    {
        // Категории для табов
        $categories = Category::orderBy('id')->get();

        // Активная категория
        $activeCategory = $categories->first();

        // Автомобили активной категории
        if ($activeCategory) {

            $cars = Car::with([
                'brand',
                'model',
                'images'
            ])
                ->where('category_id', $activeCategory->id)
                ->orderBy('id', 'asc')
                ->paginate(12);

        } else {

            $cars = collect();

        }


        /*
         * Марки.
         *
         * Берём только те марки,
         * у которых есть автомобили.
         */
        $brands = Brand::query()
            ->whereHas('cars')
            ->orderBy('name')
            ->get();


        /*
         * Последние автомобили.
         */
        $latestCars = Car::with([
            'brand',
            'model',
            'images'
        ])
            ->latest()
            ->limit(6)
            ->get();


        /*
         * Автомобили с пробегом.
         */
        $usedCars = Car::with([
            'brand',
            'model',
            'images'
        ])
            ->where('mileage', '>', 0)
            ->latest()
            ->limit(6)
            ->get();


        /*
         * Китайские автомобили.
         */
        $chinaCars = Car::with([
            'brand',
            'model',
            'images'
        ])
            ->whereHas('category', function ($query) {

                $query->where(
                    'name',
                    'Китайские'
                );

            })
            ->latest()
            ->limit(6)
            ->get();


        return view(
            'welcome',
            compact(
                'categories',
                'activeCategory',
                'cars',
                'brands',
                'latestCars',
                'usedCars',
                'chinaCars'
            )
        );
    }


    public function show($slug)
    {
        $car = Car::with([
            'brand',
            'model',
            'images',
            'carAttributes',
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        return view(
            'car_detail',
            compact('car')
        );
    }
}
