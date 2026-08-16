<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\FormSubmission;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function submit(Request $request)
    {






        $data = $request->except('_token');
        $type = $request->input('type');

        switch ($type) {

            case 'homepage_contact':
                $subject = 'Заявка с главной страницы';
                break;

            case 'callback':
                $subject = 'Обратный звонок';
                break;

            case 'footer_consultation':
                $subject = 'Получить консультацию с главной страницы';
                break;

            case 'car_request':
                $subject = 'Заявка по автомобилю';
                break;

            default:
                $subject = 'Новая заявка';
        }

        /*
        |--------------------------------------------------------------------------
        | Если заявка по автомобилю
        |--------------------------------------------------------------------------
        */

        if ($type === 'car_request') {

            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:50'],
                'message' => ['nullable', 'string', 'max:5000'],
                'car_id' => ['required', 'integer', 'exists:cars,id'],
            ]);

            // Получаем автомобиль из БД
            $car = \App\Models\Car::with(['brand', 'model'])
                ->findOrFail($request->car_id);

            // Перезаписываем данные автомобиля данными из БД
            $data['car_id'] = $car->id;
            $data['car'] = $car->brand->name . ' ' . $car->model->name;
            $data['year'] = $car->year;
            $data['lot'] = $car->lot;
            $data['car_url'] = route('car.show', [
                'slug' => $car->slug,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Сохраняем заявку
        |--------------------------------------------------------------------------
        */

        $submission = FormSubmission::create([
            'type' => $type,

            'data' => collect($data)
                ->except('type')
                ->toArray(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Email администратора
        |--------------------------------------------------------------------------
        */

        $settings = Setting::first();

        Mail::send(
            'emails.form',
            [
                'data' => $data,
                'type' => $type,
            ],
            function ($message) use ($settings, $subject) {

                $message
                    ->to($settings->email)
                    ->subject($subject);

            }
        );

        return back()->with(
            'success',
            'Заявка отправлена'
        );


    }


    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'message' => ['nullable', 'string', 'max:5000'],

            'car_id' => ['required', 'integer', 'exists:cars,id'],
            'car' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:10'],
            'lot' => ['nullable', 'string', 'max:100'],
        ]);

        // Сохраняем заявку
        $submission = FormSubmission::create([
            'type' => 'car_request',

            'data' => [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'message' => $validated['message'] ?? null,

                'car_id' => $validated['car_id'],
                'car' => $validated['car'] ?? null,
                'year' => $validated['year'] ?? null,
                'lot' => $validated['lot'] ?? null,
            ],
        ]);

        $settings = Setting::first();

        // Письмо админу
        Mail::send(
            'emails.car-request',
            [
                'submission' => $submission,
                'data' => $submission->data,
            ],
            function ($mail) {
                $mail
                    ->to($settings->email)
                    ->subject('Новая заявка по автомобилю');
            }
        );

        return back()->with(
            'success',
            'Спасибо! Ваша заявка отправлена. Мы свяжемся с вами.'
        );
    }
}
