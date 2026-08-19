<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Zoroo Dashboard
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>


<body class="bg-gray-100">


<div class="min-h-screen flex">


    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow">

        <div class="p-4 font-bold text-xl">
            Zoroo
        </div>


        <nav class="p-4">

            <a href="/dashboard"
               class="block py-2">
                داشبورد
            </a>


            <a href="#"
               class="block py-2">
                پروفایل
            </a>


        </nav>


    </aside>



    {{-- Main --}}
    <main class="flex-1 p-6">


        <header class="mb-6">

            <h1 class="text-xl font-bold">

                {{ auth()->user()->name }}

            </h1>

            <span>

                {{ auth()->user()->role->name }}

            </span>

        </header>



        {{ $slot }}


    </main>


</div>


</body>

</html>
