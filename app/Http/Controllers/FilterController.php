<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Получение моделей выбранной марки.
     */
    public function getModels($brand_id)
    {
        return CarModel::where('brand_id', $brand_id)
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    }

    /**
     * AJAX-фильтр автомобилей.
     */
    public function filter(Request $request)
    {
        try {

            $categoryId = $request->input('category_id');
            $brandId    = $request->input('brand_id');
            $modelId    = $request->input('model_id');
            $priceMin   = $request->input('price_min');
            $priceMax   = $request->input('price_max');

            $query = Car::query()
                ->with([
                    'brand',
                    'model',
                    'images',
                ]);

            /*
             * Категория
             */
            if ($request->filled('category_id')) {

                $query->where(
                    'category_id',
                    $categoryId
                );

            }

            /*
             * Марка
             */
            if ($request->filled('brand_id')) {

                $query->where(
                    'brand_id',
                    $brandId
                );

            }

            /*
             * Модель
             */
            if ($request->filled('model_id')) {

                $query->where(
                    'model_id',
                    $modelId
                );

            }

            /*
             * Минимальная цена
             */
            if ($request->filled('price_min')) {

                $query->where(
                    'price_russia',
                    '>=',
                    (int) $priceMin
                );

            }

            /*
             * Максимальная цена
             */
            if ($request->filled('price_max')) {

                $query->where(
                    'price_russia',
                    '<=',
                    (int) $priceMax
                );

            }

            /*
             * Получаем автомобили.
             */
            $page = (int) $request->input('page', 1);

            $perPage = 12;

            $cars = $query
                ->orderBy('created_at', 'desc')
                ->paginate(
                    $perPage,
                    ['*'],
                    'page',
                    $page
                );

            return response()->json([
                'html' => view('partials.car_cards', compact('cars'))->render(),

                'current_page' => $cars->currentPage(),

                'last_page' => $cars->lastPage(),

                'total' => $cars->total(),

                'has_more' => $cars->hasMorePages(),
            ]);

        } catch (\Throwable $e) {

            \Log::error(
                'Ошибка фильтра автомобилей',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'request' => $request->all(),
                ]
            );

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
