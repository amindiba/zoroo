<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ثبت اطلاعات کارخانه
        </h2>

    </x-slot>





    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">



            <div class="bg-white shadow-sm rounded-lg p-6">





                @if(session('success'))

                    <div class="mb-4 text-green-600">

                        {{ session('success') }}

                    </div>

                @endif






                <form method="POST"
                      action="{{ route('producer.profile.store') }}">

                    @csrf







                    <div class="mb-4">

                        <label class="block mb-2">
                            نام کارخانه
                        </label>


                        <input
                            type="text"
                            name="company_name"
                            value="{{ old('company_name') }}"
                            class="border rounded p-2 w-full"
                            required
                        >


                        @error('company_name')

                            <div class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                    </div>








                    <div class="mb-4">

                        <label class="block mb-2">
                            نام مدیر
                        </label>


                        <input
                            type="text"
                            name="manager_name"
                            value="{{ old('manager_name') }}"
                            class="border rounded p-2 w-full"
                            required
                        >


                        @error('manager_name')

                            <div class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                    </div>








                    <div class="mb-4">

                        <label class="block mb-2">
                            تلفن
                        </label>


                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="border rounded p-2 w-full"
                        >


                        @error('phone')

                            <div class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                    </div>









                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">





                        <div class="mb-4">

                            <label class="block mb-2">
                                استان
                            </label>


                            <input
                                type="text"
                                name="province"
                                value="{{ old('province') }}"
                                class="border rounded p-2 w-full"
                                required
                            >


                            @error('province')

                                <div class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </div>

                            @enderror


                        </div>








                        <div class="mb-4">

                            <label class="block mb-2">
                                شهر
                            </label>


                            <input
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                class="border rounded p-2 w-full"
                                required
                            >


                            @error('city')

                                <div class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </div>

                            @enderror


                        </div>





                    </div>









                    <div class="mb-4">

                        <label class="block mb-2">
                            معرفی کوتاه
                        </label>


                        <textarea
                            name="description"
                            class="border rounded p-2 w-full"
                            rows="5"
                        >{{ old('description') }}</textarea>



                        @error('description')

                            <div class="text-red-600 text-sm mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                    </div>









                    <div class="flex gap-3">


                        <button
                            type="submit"
                            class="px-5 py-2 bg-black text-white rounded"
                        >

                            ذخیره اطلاعات

                        </button>





                        <a
                            href="{{ route('dashboard') }}"
                            class="border px-5 py-2 rounded"
                        >

                            بازگشت

                        </a>



                    </div>





                </form>





            </div>



        </div>



    </div>



</x-app-layout>
