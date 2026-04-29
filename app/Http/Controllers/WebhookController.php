<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function __invoke(Request $request)
    {


        $payload = $request->getContent();
        $data = json_decode($payload, true);

        Log::info('Webhook received', ['payload' => $payload]);

        if (!isset($data['event'])) {
            return response('', 400);
        }

        if ($data['event'] === 'payment.succeeded') {
            $paymentData = $data['object'];
            $paymentId = $paymentData['id'];
            $userId = $paymentData['metadata']['user_id'] ?? null;

            Log::info('User ID from metadata: ' . ($userId ?? 'null'));

            if (!$userId) {
                Log::warning('Webhook: user_id не найден в метаданных платежа', ['payment_id' => $paymentId]);
                return response('', 400);
            }

            // Проверяем, не обработан ли уже этот платёж
            $existingPayment = Payment::where('payment_id', $paymentId)->first();

            if (!$existingPayment) {
                // Создаём запись о платеже
                Payment::create([
                    'user_id' => $userId,
                    'payment_id' => $paymentId,
                    'amount' => $paymentData['amount']['value'],
                    'currency' => $paymentData['amount']['currency'],
                    'status' => $paymentData['status'],
                    'paid_at' => isset($paymentData['captured_at']) ? Carbon::parse($paymentData['captured_at']) : now(),
                    'metadata' => $paymentData['metadata'] ?? [],
                ]);

                // Активируем премиум-доступ
                $user = User::find($userId);

                if ($user) {
                    $user->is_premium = true;
                    //$user->premium_expires_at = Carbon::now()->addMonth();

                    $user->premium_expires_at = Carbon::now()->addMonth();
                    $user->save();
                    Log::info("Премиум-доступ активирован для пользователя {$user->id} (платёж {$paymentId})");
                }
            } else {
                Log::info("Повторный вебхук для платежа {$paymentId}, пропускаем");
            }
        }


        Log::info('Webhook event: ' . $data['event']);

        return response('', 200);
    }
}
