<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش محصول
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">


                    <form method="POST" action="{{ route('products.update', $product->id) }}">

                        @csrf

                        @method('PUT')



                        {{-- نام محصول --}}

                        <div class="mb-4">

                            <label class="block mb-2">
                                نام محصول
                            </label>


                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $product->name) }}"
                                class="border rounded w-full p-2"
                                required
                            >


                            @error('name')

                                <span class="text-red-600">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>





                        {{-- دسته بندی محصول --}}

                        <div class="mb-4">

                            <label class="block mb-2">
                                دسته‌بندی محصول
                            </label>


                            <select
                                name="category_id"
                                class="border rounded w-full p-2"
                                required
                            >

                                <option value="">
                                    انتخاب دسته‌بندی
                                </option>



                                @foreach($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >

                                        {{ $category->parent_id ? '— ' : '' }}
                                        {{ $category->name }}

                                    </option>

                                @endforeach


                            </select>


                            @error('category_id')

                                <span class="text-red-600">
                                    {{ $message }}
                                </span>

                            @enderror


                        </div>





                        {{-- توضیحات --}}

                        <div class="mb-4">

                            <label class="block mb-2">
                                توضیحات محصول
                            </label>


                            <textarea
                                name="description"
                                class="border rounded w-full p-2"
                                rows="5"
                            >{{ old('description', $product->description) }}</textarea>


                            @error('description')

                                <span class="text-red-600">
                                    {{ $message }}
                                </span>

                            @enderror


                        </div>





                        {{-- استان --}}

                        <div class="mb-4">

                            <label class="block mb-2">
                                استان
                            </label>


                            <input
                                type="text"
                                name="province"
                                value="{{ old('province', $product->province) }}"
                                class="border rounded w-full p-2"
                            >


                            @error('province')

                                <span class="text-red-600">
                                    {{ $message }}
                                </span>

                            @enderror


                        </div>





                        {{-- شهر --}}

                        <div class="mb-4">

                            <label class="block mb-2">
                                شهر
                            </label>


                            <input
                                type="text"
                                name="city"
                                value="{{ old('city', $product->city) }}"
                                class="border rounded w-full p-2"
                            >


                            @error('city')

                                <span class="text-red-600">
                                    {{ $message }}
                                </span>

                            @enderror


                        </div>





                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded"
                        >

                            بروزرسانی محصول

                        </button>


                    </form>


                </div>

            </div>

        </div>

    </div>


</x-app-layout>
