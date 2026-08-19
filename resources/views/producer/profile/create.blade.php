<x-dashboard-layout>

    <h1 class="text-xl font-bold mb-6">
        ثبت اطلاعات کارخانه
    </h1>


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
                class="border p-2 w-full"
                required>
        </div>


        <div class="mb-4">
            <label class="block mb-2">
                نام مدیر
            </label>

            <input
                type="text"
                name="manager_name"
                class="border p-2 w-full">
        </div>


        <div class="mb-4">
            <label class="block mb-2">
                استان
            </label>

            <input
                type="text"
                name="province"
                class="border p-2 w-full">
        </div>


        <div class="mb-4">
            <label class="block mb-2">
                شهر
            </label>

            <input
                type="text"
                name="city"
                class="border p-2 w-full">
        </div>


        <div class="mb-4">
            <label class="block mb-2">
                معرفی کوتاه
            </label>

            <textarea
                name="description"
                class="border p-2 w-full"></textarea>
        </div>


        <button
            type="submit"
            class="px-4 py-2 bg-black text-white">

            ذخیره اطلاعات

        </button>


    </form>


</x-dashboard-layout>
