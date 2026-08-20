<!DOCTYPE html>
<html lang="fa" dir="rtl">


<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        Zoroo Dashboard
    </title>



    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


</head>




<body class="bg-gray-100 antialiased">



<div class="min-h-screen flex">





    {{-- Sidebar --}}

    <aside class="w-64 bg-white shadow-sm">


        <div class="p-4 font-bold text-xl border-b">

            Zoroo

        </div>





        <nav class="p-4">


            <x-dashboard-sidebar />


        </nav>



    </aside>







    {{-- Main Content --}}

    <main class="flex-1 p-6">





        <header class="mb-6 bg-white rounded-lg shadow-sm p-4">


            <h1 class="text-xl font-bold">

                {{ auth()->user()->name }}

            </h1>





            <span class="text-gray-600">

                {{ auth()->user()->role?->name ?? 'کاربر' }}

            </span>



        </header>







        {{ $slot }}




    </main>





</div>




</body>


</html>
