<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MidtransWebhookController extends Controller
{
    public function __construct(protected PaymentService $paymentService) {}

    public function handle(Request $request): JsonResponse
    {
        $payload = $request->all();

        if (!$this->paymentService->verifySignature($payload)) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $this->paymentService->handleWebhook($payload);

        return response()->json(['message' => 'OK']);
    }
}
