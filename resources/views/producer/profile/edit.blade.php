<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش پروفایل تولیدکننده
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <form method="POST" action="{{ route('producer.profile.update') }}">

                    @csrf

                    @method('PUT')



                    <div class="mb-4">

                        <label class="block mb-2">
                            نام شرکت
                        </label>

                        <input
                            type="text"
                            name="company_name"
                            value="{{ old('company_name', $profile->company_name) }}"
                            class="border rounded w-full p-2"
                            required
                        >

                    </div>




                    <div class="mb-4">

                        <label class="block mb-2">
                            نام مدیر
                        </label>

                        <input
                            type="text"
                            name="manager_name"
                            value="{{ old('manager_name', $profile->manager_name) }}"
                            class="border rounded w-full p-2"
                            required
                        >

                    </div>




                    <div class="mb-4">

                        <label class="block mb-2">
                            تلفن
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone', $profile->phone) }}"
                            class="border rounded w-full p-2"
                        >

                    </div>




                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                        <div class="mb-4">

                            <label class="block mb-2">
                                استان
                            </label>

                            <input
                                type="text"
                                name="province"
                                value="{{ old('province', $profile->province) }}"
                                class="border rounded w-full p-2"
                                required
                            >

                        </div>




                        <div class="mb-4">

                            <label class="block mb-2">
                                شهر
                            </label>

                            <input
                                type="text"
                                name="city"
                                value="{{ old('city', $profile->city) }}"
                                class="border rounded w-full p-2"
                                required
                            >

                        </div>


                    </div>




                    <div class="mb-4">

                        <label class="block mb-2">
                            توضیحات
                        </label>

                        <textarea
                            name="description"
                            class="border rounded w-full p-2"
                            rows="5"
                        >{{ old('description', $profile->description) }}</textarea>

                    </div>




                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded"
                    >
                        ذخیره تغییرات
                    </button>


                </form>


            </div>


        </div>

    </div>


</x-app-layout>
