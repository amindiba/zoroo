<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        {{ config('app.name', 'Zoroo') }}
    </title>



    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


</head>



<body class="font-sans text-gray-900 antialiased bg-gray-100">


<div class="min-h-screen flex flex-col justify-center items-center py-6">



    <div class="mb-6">


        <a href="/">

            <x-application-logo
                class="w-20 h-20 fill-current text-gray-500"
            />

        </a>


    </div>





    <div
        class="w-full sm:max-w-md bg-white shadow-md rounded-lg overflow-hidden px-6 py-4"
    >


        {{ $slot }}


    </div>



</div>



</body>


</html>
