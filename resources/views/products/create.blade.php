<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ثبت محصول جدید
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <form method="POST" action="{{ route('products.store') }}">

                    @csrf



                    <div class="mb-4">

                        <label class="block mb-2">
                            نام محصول
                        </label>


                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="border rounded w-full p-2"
                            required
                        >


                        @error('name')

                            <div class="text-red-600 text-sm mt-1">

                                {{ $message }}

                            </div>

                        @enderror


                    </div>




                    <div class="mb-4">

                        <label class="block mb-2">
                            دسته‌بندی محصول
                        </label>


                        <input
                            type="text"
                            name="category"
                            value="{{ old('category') }}"
                            class="border rounded w-full p-2"
                        >

                    </div>




                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                        <div class="mb-4">

                            <label class="block mb-2">
                                استان تولید
                            </label>


                            <input
                                type="text"
                                name="province"
                                value="{{ old('province') }}"
                                class="border rounded w-full p-2"
                            >

                        </div>



                        <div class="mb-4">

                            <label class="block mb-2">
                                شهر تولید
                            </label>


                            <input
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                class="border rounded w-full p-2"
                            >

                        </div>


                    </div>




                    <div class="mb-4">

                        <label class="block mb-2">
                            توضیحات محصول
                        </label>


                        <textarea
                            name="description"
                            class="border rounded w-full p-2"
                            rows="5"
                        >{{ old('description') }}</textarea>


                    </div>




                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded"
                    >

                        ذخیره محصول

                    </button>


                </form>


            </div>


        </div>

    </div>


</x-app-layout>
