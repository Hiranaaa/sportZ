<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    private readonly string $apiKey;
    private readonly string $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.weather.key', env('WEATHER_API_KEY', ''));
        $this->apiUrl = config('services.weather.url', env('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5'));
    }

    public function getForecast(string $city, string $date): array
    {
        try {
            $response = Http::get("{$this->apiUrl}/forecast", [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'id',
            ]);

            if ($response->failed()) {
                Log::warning('Weather API request failed', [
                    'city' => $city,
                    'status' => $response->status(),
                ]);

                return $this->getDefaultForecast();
            }

            $data = $response->json();
            $forecasts = collect($data['list'] ?? []);

            $dateForecasts = $forecasts->filter(function ($item) use ($date) {
                return str_starts_with($item['dt_txt'] ?? '', $date);
            });

            if ($dateForecasts->isEmpty()) {
                return $this->getDefaultForecast();
            }

            $forecast = $dateForecasts->first();

            return [
                'available' => true,
                'temperature' => round($forecast['main']['temp'] ?? 0, 1),
                'feels_like' => round($forecast['main']['feels_like'] ?? 0, 1),
                'humidity' => $forecast['main']['humidity'] ?? 0,
                'description' => $forecast['weather'][0]['description'] ?? '-',
                'icon' => $forecast['weather'][0]['icon'] ?? '01d',
                'wind_speed' => round($forecast['wind']['speed'] ?? 0, 1),
                'rain_probability' => round(($forecast['pop'] ?? 0) * 100),
                'date' => $date,
                'city' => $city,
            ];
        } catch (\Exception $e) {
            Log::error('Weather service error', [
                'message' => $e->getMessage(),
                'city' => $city,
                'date' => $date,
            ]);

            return $this->getDefaultForecast();
        }
    }

    private function getDefaultForecast(): array
    {
        return [
            'available' => false,
            'temperature' => null,
            'feels_like' => null,
            'humidity' => null,
            'description' => 'Data cuaca tidak tersedia',
            'icon' => null,
            'wind_speed' => null,
            'rain_probability' => null,
        ];
    }
}
