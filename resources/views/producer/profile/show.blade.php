<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            پروفایل تولیدکننده
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <div class="mb-6">

                    <h3 class="text-xl font-bold">

                        {{ $profile->company_name }}

                    </h3>


                    <div class="text-gray-600 mt-2">

                        {{ $profile->description }}

                    </div>

                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                    <div class="bg-gray-100 p-4 rounded-lg">

                        <strong>
                            مدیر:
                        </strong>

                        {{ $profile->manager_name }}

                    </div>



                    <div class="bg-gray-100 p-4 rounded-lg">

                        <strong>
                            تلفن:
                        </strong>

                        {{ $profile->phone }}

                    </div>



                    <div class="bg-gray-100 p-4 rounded-lg">

                        <strong>
                            استان:
                        </strong>

                        {{ $profile->province }}

                    </div>



                    <div class="bg-gray-100 p-4 rounded-lg">

                        <strong>
                            شهر:
                        </strong>

                        {{ $profile->city }}

                    </div>



                    <div class="bg-gray-100 p-4 rounded-lg">

                        <strong>
                            وضعیت:
                        </strong>

                        {{ $profile->status }}

                    </div>


                </div>




                <div class="mt-6">

                    <a
                        href="{{ route('producer.profile.edit') }}"
                        class="bg-blue-600 text-white px-5 py-2 rounded"
                    >
                        ویرایش پروفایل
                    </a>

                </div>


            </div>


        </div>

    </div>


</x-app-layout>
