<?php

namespace App\Http\Controllers;

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




        $submission = FormSubmission::create([
            'type' => $type,
            'data' => collect($data)->except('type')->toArray(),
        ]);

        $settings = Setting::first();


        Mail::send('emails.form', ['data' => $data, 'type' => $type], function ($message) use ($type, $settings) {
            $message->to($settings->email)
                ->subject('Новая заявка: ' . $type);
        });

        return back()->with('success', 'Заявка отправлена');



    }
}
