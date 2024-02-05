# Livewire Weather app


A simple weather app built with Laravel Livewire, styled with Tailwind css. The main objective of this project is to provide an example application for those who are starting with Laravel Livewire and API calls.

  - Search for the city you want to see the weather forecast.
  - Get weather forecast from API call.

### Tech

Technologies used in this project:

* [Laravel](https://github.com/laravel/laravel) - The Laravel PHP framework.
* [Livewire](https://github.com/livewire/livewire) - Laravel Livewire.
* [Tailwind CSS](https://tailwindcss.com/) - Tailwind CSS.
* [Apline.js](https://github.com/alpinejs/alpine) - Alpine.js.
* [Free Weather API](https://open-meteo.com/) - Free Weather API.
* [Placekit](https://app.placekit.io/) - Placekit API.


### Requirements

* [PHP 8.1+](https://www.php.net/) - PHP version 8.1 or greater.
* [Composer](https://getcomposer.org/download/) - Latest version of composer v2 or greater.
* [npm](https://www.npmjs.com/) - Latest version of npm v10 or greater.
* [placekit](https://app.placekit.io/) - Register for API key and search of cities.


### Before Installation

1. Register your app on [Placekit](https://app.placekit.io/) and get the API key

### Installation

1. Clone the `main` branch of this repo


2. Install the dependencies and devDependencies:

```sh
$ cd weather-demo
$ composer install
$ npm install
$ npm run dev
```

3. Create your .env file and generate the application key:

```sh
$ cp .env.example .env
$ php artisan key:generate
```

4. Copy your API key from PLACEKIT and place it in your .env file:

```sh
PLACEKIT_API_KEY=set_key_here
```

5. Start the server

```sh
$ php artisan serve
```

License
----

MIT
