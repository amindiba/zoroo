<x-app-layout>


    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            داشبورد

        </h2>

    </x-slot>





    <div class="py-12">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900">





                    <div class="mb-6">


                        <h3 class="text-lg font-semibold">


                            خوش آمدید


                            {{ $user->name ?? 'کاربر' }}


                        </h3>






                        <p class="text-gray-600 mt-2">


                            نقش شما:



                            @switch($role)


                                @case('producer')

                                    تولیدکننده

                                    @break




                                @case('buyer')

                                    خریدار

                                    @break




                                @case('admin')

                                    مدیر سیستم

                                    @break




                                @default

                                    نامشخص


                            @endswitch



                        </p>



                    </div>








                    @switch($role)



                        @case('producer')


                            @include('dashboard.partials.producer')


                            @break






                        @case('buyer')


                            @include('dashboard.partials.buyer')


                            @break






                        @case('admin')


                            @include('dashboard.partials.admin')


                            @break






                        @default



                            <div class="border rounded-lg p-5">


                                نقش کاربری معتبر نیست.



                            </div>



                    @endswitch






                </div>


            </div>



        </div>


    </div>


</x-app-layout>
