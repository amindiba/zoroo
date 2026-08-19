<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            داشبورد Zoroo
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">


                <aside class="md:col-span-1">

                    <x-dashboard-sidebar />

                </aside>



                <main class="md:col-span-3">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                        <div class="p-6 text-gray-900">


                            <h3 class="text-lg font-bold mb-4">

                                خوش آمدید {{ $user->name }}

                            </h3>



                            <div class="mb-6">

                                <strong>
                                    نقش:
                                </strong>

                                {{ $role ?? 'بدون نقش' }}

                            </div>



                            @if($role === 'producer')

                                @include('dashboard.producer')


                            @elseif($role === 'buyer')

                                @include('dashboard.buyer')


                            @elseif($role === 'admin')

                                @include('dashboard.admin')


                            @else

                                <div class="text-red-600">

                                    نقش کاربر مشخص نیست.

                                </div>


                            @endif



                        </div>


                    </div>


                </main>


            </div>


        </div>

    </div>


</x-app-layout>
