<?php

namespace App\Http\Controllers;

use App\Services\YooKassaService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function create(Request $request, YooKassaService $yookassa)
    {
        $plan = $request->input('plan');

        $plans = [
            'starter' => [
                'amount' => 99,
                'description' => 'Starter доступ к SQL курсу',
            ],
            'pro' => [
                'amount' => 499,
                'description' => 'Pro доступ к SQL курсу',
            ],
        ];

        if (!isset($plans[$plan])) {
            abort(400, 'Invalid plan');
        }
        $userId = auth()->id();

        try {
            $paymentUrl = $yookassa->createPayment(
                $plans[$plan]['amount'],
                $plans[$plan]['description'],
                config('services.yookassa.return_url'),
                auth()->id()
            );

            return redirect()->away($paymentUrl);

        } catch (\Exception $e) {
            return redirect()->route('pricing')
                ->with('error', 'Не удалось создать платёж');
        }
    }


    public function success()
    {
        return view('pricing');
    }
}
