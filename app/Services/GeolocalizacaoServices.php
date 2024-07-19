<?php

namespace App\Services;

class GeolocalizacaoServices
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('GOOGLE_MAPS_API_KEY');
    }

    public function obterEndereco($latitude, $longitude)
    {
        $latLng = urlencode("$latitude,$longitude");
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latLng}&key={$this->apiKey}";
        $resposta = file_get_contents($url);
        $dados = json_decode($resposta, true);
        if ($dados && $dados['status'] === 'OK') {
            return $dados;
        } else {
            return null;
        }
    }
}
