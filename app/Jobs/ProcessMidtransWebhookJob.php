<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Services\PaymentService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessMidtransWebhookJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(
        public readonly array $payload,
    ) {}

    public function handle(PaymentService $paymentService): void
    {
        try {
            $paymentService->handleWebhook($this->payload);

            Log::info('Midtrans webhook processed successfully.', [
                'order_id' => $this->payload['order_id'] ?? 'unknown',
                'transaction_status' => $this->payload['transaction_status'] ?? 'unknown',
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to process Midtrans webhook.', [
                'order_id' => $this->payload['order_id'] ?? 'unknown',
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
