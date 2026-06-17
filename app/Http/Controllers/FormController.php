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

        switch ($type) {

            case 'homepage_contact':
                $subject = 'Заявка с главной страницы';
                break;

            case 'callback':
                $subject = 'Обратный звонок';
                break;

            case 'footer_consultation':
                $subject = 'Получить консультацию c главной страницы';
                break;

            default:
                $subject = 'Новая заявка';
        }


        $submission = FormSubmission::create([
            'type' => $type,
            'data' => collect($data)->except('type')->toArray(),
        ]);

        $settings = Setting::first();


        Mail::send(
            'emails.form',
            ['data' => $data, 'type' => $type],
            function ($message) use ($settings, $subject) {

                $message->to($settings->email)
                    ->subject($subject);

            }
        );

        return back()->with('success', 'Заявка отправлена');



    }
}
