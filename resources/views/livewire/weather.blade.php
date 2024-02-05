<div class="text-white mb-8">
    <div x-data='{ showResults: false }' class="places-input text-gray-800 relative">

        <input type="search" wire:model.live="city" x-on:input="showResults = true" x-on:click.away="showResults = false"
            id="address"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Choose a city..." />

        <ul x-show="showResults" class="absolute w-full z-10 mt-2 bg-white border rounded-md shadow-lg">
            @foreach ($searchResults as $key => $result)
                <li wire:key="{{ $key }}" wire:click="setCurrentCity('{{ json_encode($result) }}')"
                    class="px-4 py-2 cursor-pointer hover:bg-blue-100">
                    {{ $result['name'] }}</li>
            @endforeach
        </ul>

        <p>
            Selected:
            <strong id="address-value">{{ $city }}</strong>
        </p>
    </div>
    <div class="weather-container font-sans md:w-128 max-w-lg rounded-lg overflow-hidden bg-gray-900 shadow-lg mt-8">
        <div class="current-weather flex items-center justify-between px-6 py-8">
            <div class="flex flex-col md:flex-row items-center">
                <div>
                    <div class="text-5xl font-semibold">{{ round($currentTemp['actualTemp'], 2) }}°C</div>
                    <div>Feels like {{ round($currentTemp['feelsLike'], 2) }}°C</div>
                </div>
                <div class="md:mx-5">
                    <div class="font-semibold"> {{ $currentTemp['summary'] }} </div>
                    <div> {{ $city }} </div>
                </div>
            </div>
            <div>
                <img src="{{ $currentTemp['icon'] }}" width="90px" height="90px"
                    alt="{{ $currentTemp['summary'] . ' icon' }}">
            </div>
        </div>
        <!-- end current-weather -->

        <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden">
            @forelse ($daily as $day)
                <div class="flex items-center">
                    <div class="w-1/6 text-lg text-gray-200">{{ date('d-m', strtotime($day['time'])) }}</div>
                    <div class="w-4/6 px-4 flex items-center">
                        <div>
                            <img src="{{ $day['icon'] }}" width="70px" height="70px"
                                alt="{{ $day['summary'] . ' icon' }}">
                        </div>
                        <div class="ml-3">{{ $day['summary'] }}</div>
                    </div>
                    <div class="w-1/6 text-right">
                        <div>{{ round($day['temperature_2m_max'], 2) }}°C</div>
                        <div>{{ round($day['temperature_2m_min'], 2) }}°C</div>
                    </div>
                </div>
            @empty
                There are no weather forecasts
            @endforelse
        </div>
        <!-- end future-weather -->
    </div>
    <!-- end weather-container -->
</div>
