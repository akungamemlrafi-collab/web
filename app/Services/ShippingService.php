<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class ShippingService
{
    private string $rajaOngkirApiKey;
    private string $rajaOngkirBaseUrl;

    public function __construct()
    {
        $this->rajaOngkirApiKey = config('shipping.rajaongkir.api_key');
        $this->rajaOngkirBaseUrl = config('shipping.rajaongkir.base_url');
    }

    /**
     * Get shipping cost from RajaOngkir
     */
    public function getShippingCost(
        int $originCityId,
        int $destinationCityId,
        int $weight,
        string $courier = 'jne'
    ): array {
        try {
            $response = Http::withHeaders([
                'key' => $this->rajaOngkirApiKey,
            ])->post("{$this->rajaOngkirBaseUrl}/cost", [
                'origin' => $originCityId,
                'destination' => $destinationCityId,
                'weight' => $weight,
                'courier' => $courier,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to get shipping cost',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get list of cities
     */
    public function getCities(int $provinceId = null): array
    {
        try {
            $url = $this->rajaOngkirBaseUrl . '/city';
            $params = ['key' => $this->rajaOngkirApiKey];

            if ($provinceId) {
                $params['province'] = $provinceId;
            }

            $response = Http::get($url, $params);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['rajaongkir']['results'] ?? [],
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to get cities',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get list of provinces
     */
    public function getProvinces(): array
    {
        try {
            $response = Http::get("{$this->rajaOngkirBaseUrl}/province", [
                'key' => $this->rajaOngkirApiKey,
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json()['rajaongkir']['results'] ?? [],
                ];
            }

            return [
                'success' => false,
                'error' => 'Failed to get provinces',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Get international shipping (DHL/FedEx)
     */
    public function getInternationalShippingCost(
        string $origin = 'IDN',
        string $destination,
        int $weight
    ): array {
        // This would integrate with DHL/FedEx APIs
        return [
            'success' => false,
            'error' => 'International shipping integration in progress',
        ];
    }
}
