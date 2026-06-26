<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SupabaseStorageService
{
    private readonly string $baseUrl;
    private readonly string $serviceKey;
    private readonly string $bucket;

    public function __construct()
    {
        $url = config('supabase.url');

        if (empty($url)) {
            throw new \RuntimeException('SUPABASE_URL belum diatur pada file .env');
        }

        $this->baseUrl = rtrim($url, '/') . '/storage/v1';

        $this->serviceKey = config('supabase.service_key');

        if (empty($this->serviceKey)) {
            throw new \RuntimeException('SUPABASE_SERVICE_KEY belum diatur pada file .env');
        }

        $this->bucket = config('supabase.storage.bucket', 'sportZ');
    
    }

    /**
     * Upload file ke Supabase Storage
     */
public function upload(string $bucket, string $path, UploadedFile $file): string
{
    $url = "{$this->baseUrl}/object/{$bucket}/{$path}";

    $response = Http::withToken($this->serviceKey)
        ->withHeaders([
            'apikey' => $this->serviceKey,
            'x-upsert' => 'true',
            'Content-Type' => $file->getMimeType(),
        ])
        ->withBody(
            file_get_contents($file->getRealPath()),
            $file->getMimeType()
        )
        ->post($url);

    if (! $response->successful()) {
        Log::error('Supabase upload failed', [
            'url' => $url,
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new \RuntimeException(
            "Supabase Upload Error ({$response->status()}): ".$response->body()
        );
    }

    return $this->getPublicUrl($bucket, $path);
}
    /**
     * Upload menggunakan bucket default
     */
    public function uploadFile(UploadedFile $file, string $folder = ''): string
    {
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        $path = $folder
            ? trim($folder, '/') . '/' . $filename
            : $filename;

        return $this->upload(
            $this->bucket,
            $path,
            $file
        );
    }

    /**
     * Hapus file
     */
    public function delete(string $bucket, string $path): bool
    {
        $url = "{$this->baseUrl}/object/{$bucket}/{$path}";

        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->serviceKey}",
            'apikey'        => $this->serviceKey,
        ])->delete($url);

        if ($response->failed()) {

            Log::warning('Supabase delete failed', [
                'url'    => $url,
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return false;
        }

        return true;
    }

    /**
     * URL publik file
     */
    public function getPublicUrl(string $bucket, string $path): string
{
    return rtrim(config('supabase.url'), '/')
        . "/storage/v1/object/public/{$bucket}/{$path}";
}
    /**
     * Bucket default
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }
}