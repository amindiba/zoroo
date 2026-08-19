<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            جزئیات محصول
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white shadow-sm rounded-lg p-6">


                <div class="mb-6">


                    <h1 class="text-2xl font-bold mb-3">

                        {{ $product->name }}

                    </h1>


                    <p class="text-gray-600">

                        {{ $product->description }}

                    </p>


                </div>




                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">



                    <div class="bg-gray-100 rounded-lg p-4">

                        <strong>
                            دسته‌بندی:
                        </strong>

                        {{ $product->category ?? 'ثبت نشده' }}

                    </div>



                    <div class="bg-gray-100 rounded-lg p-4">

                        <strong>
                            وضعیت:
                        </strong>

                        {{ $product->status }}

                    </div>



                    <div class="bg-gray-100 rounded-lg p-4">

                        <strong>
                            استان:
                        </strong>

                        {{ $product->province ?? 'ثبت نشده' }}

                    </div>



                    <div class="bg-gray-100 rounded-lg p-4">

                        <strong>
                            شهر:
                        </strong>

                        {{ $product->city ?? 'ثبت نشده' }}

                    </div>


                </div>




                <div class="mt-6 flex gap-3">


                    <a
                        href="{{ route('products.edit', $product) }}"
                        class="bg-blue-600 text-white px-5 py-2 rounded"
                    >
                        ویرایش محصول
                    </a>




                    <form
                        method="POST"
                        action="{{ route('products.destroy', $product) }}"
                    >

                        @csrf

                        @method('DELETE')


                        <button
                            type="submit"
                            class="bg-red-600 text-white px-5 py-2 rounded"
                        >
                            حذف محصول
                        </button>


                    </form>


                </div>


            </div>


        </div>

    </div>


</x-app-layout>
