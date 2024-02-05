<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;

class Weather extends Component
{

    public $currentTemp = [
        'actualTemp' => 2,
        'feelsLike' => -1,
        'summary' => '',
        'icon' => '',
        'summary' => '',
    ];

    public $daily = [];

    public $latitude = 43.85;

    public $longitude = 18.41;

    public $timezone = 'Europe/Berlin';

    public $city = 'Sarajevo';

    public $searchResults = [];

    #[On('updateLocation')]
    public function mount()
    {
        $this->getWeather();
    }

    public function getWeather()
    {

        $lat = $this->latitude;
        $lon = $this->longitude;
        $timezone = $this->timezone;

        // Get icons
        $iconsJson = Storage::json('public/data/weather_descriptions.json');

        $response = Http::get("api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current=temperature_2m,apparent_temperature,weather_code&daily=weather_code,temperature_2m_max,temperature_2m_min&timezone=$timezone");

        $collection = $response->json();

        $tempDaily = collect($collection["daily"])->all();
        $ar2 = [];
        foreach ($tempDaily['time'] as $key => $value) {
            $ar2[] = [
                'time' => $value,
                'temperature_2m_max' => $tempDaily['temperature_2m_max'][$key],
                'temperature_2m_min' => $tempDaily['temperature_2m_min'][$key],
                'icon' => $iconsJson[$tempDaily['weather_code'][$key]]["day"]["image"],
                'summary' => $iconsJson[$tempDaily['weather_code'][$key]]["day"]["description"],
            ];
        }
        $this->daily = $ar2;

        $current = collect($collection["current"])->all();
        $this->currentTemp = [
            'actualTemp' => $current["temperature_2m"],
            'feelsLike' => $current["apparent_temperature"],
            'summary' => $iconsJson[$current["weather_code"]]["day"]["description"],
            'icon' => $iconsJson[$current["weather_code"]]["day"]["image"],
        ];
    }

    // Magic method that is fired when `city` is updating
    public function updatingCity()
    {
        if ($this->city != '') {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-placekit-api-key' => config('services.placekit.apiKey'),
            ])->post('https://api.placekit.co/search', [
                'query' => $this->city,
                'types' => ['city'],
                'maxResults' => 5,
            ]);

            if ($response->ok()) {

                $results = collect($response->json())->all();

                $results = $results["results"];

                // An array of SearchResults
                $this->searchResults = $results;
            }
        } else {
            $this->searchResults = [];
        }
    }

    public function setCurrentCity($result)
    {

        $result = json_decode($result, true);

        if (!empty($result)) {
            $this->latitude = $result["lat"];
            $this->longitude = $result["lng"];
            $this->city = $result["city"];

            $this->dispatch('updateLocation');
        }
    }

    #[Title('Weather app demo')]
    public function render()
    {
        return view('livewire.weather');
    }
}
