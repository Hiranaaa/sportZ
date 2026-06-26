<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct(protected WeatherService $weatherService) {}

    public function forecast(Request $request): JsonResponse
    {
        $request->validate(['date' => 'required|date', 'city' => 'nullable|string']);
        $city = $request->input('city', 'Jakarta');
        $forecast = $this->weatherService->getForecast($city, $request->date);
        return response()->json(['data' => $forecast]);
    }
}
