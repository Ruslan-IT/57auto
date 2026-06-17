<?php

namespace App\Http\Controllers;

use App\Models\CalculatorSetting;
use App\Services\CalculatorService;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{

    public function index($country) {


        $settings = CalculatorSetting::where('country', $country) ->firstOrFail();


        return view('calculator.index', compact('settings'));
    }



    public function calculate(Request $request, CalculatorService $calculatorService)
    {


        $validated = $request->validate([

            'country' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1'],

            'year' => ['required', 'integer'],
            'engine_volume' => ['required', 'numeric'],
            'power' => ['nullable', 'numeric'],
            'fuel_type' => ['required', 'string'],

        ]);

        $result = $calculatorService->calculate($validated);


        return response()->json([
            'success' => true,
            'data' => $result,
        ]);
    }
}
