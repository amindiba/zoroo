<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            محصولات من
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">


                    <div class="flex justify-between items-center mb-6">


                        <h3 class="text-lg font-semibold">
                            لیست محصولات
                        </h3>



                        <a
                            href="{{ route('products.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded"
                        >

                            ثبت محصول جدید

                        </a>


                    </div>





                    @if(session('success'))

                        <div class="mb-4 text-green-600">

                            {{ session('success') }}

                        </div>

                    @endif





                    @if($products->count())



                        <div class="overflow-x-auto">


                            <table class="min-w-full border">


                                <thead>


                                    <tr class="bg-gray-100">


                                        <th class="border p-3 text-right">
                                            نام محصول
                                        </th>



                                        <th class="border p-3 text-right">
                                            دسته‌بندی
                                        </th>



                                        <th class="border p-3 text-right">
                                            استان
                                        </th>



                                        <th class="border p-3 text-right">
                                            شهر
                                        </th>



                                        <th class="border p-3 text-right">
                                            وضعیت
                                        </th>



                                        <th class="border p-3 text-right">
                                            عملیات
                                        </th>


                                    </tr>


                                </thead>




                                <tbody>


                                @foreach($products as $product)


                                    <tr>


                                        <td class="border p-3">

                                            {{ $product->name }}

                                        </td>





                                        <td class="border p-3">


                                            @if($product->category)

                                                @if($product->category->parent)

                                                    {{ $product->category->parent->name }}
                                                    /
                                                    {{ $product->category->name }}

                                                @else

                                                    {{ $product->category->name }}

                                                @endif


                                            @else

                                                -

                                            @endif


                                        </td>





                                        <td class="border p-3">

                                            {{ $product->province ?? '-' }}

                                        </td>





                                        <td class="border p-3">

                                            {{ $product->city ?? '-' }}

                                        </td>





                                        <td class="border p-3">


                                            @if($product->status === 'pending')

                                                در انتظار تایید


                                            @elseif($product->status === 'approved')

                                                تایید شده


                                            @elseif($product->status === 'active')

                                                فعال


                                            @elseif($product->status === 'inactive')

                                                غیرفعال


                                            @else

                                                نامشخص


                                            @endif


                                        </td>





                                        <td class="border p-3">


                                            <a
                                                href="{{ route('products.show', $product->id) }}"
                                                class="text-blue-600 mr-2"
                                            >

                                                مشاهده

                                            </a>





                                            <a
                                                href="{{ route('products.edit', $product->id) }}"
                                                class="text-green-600 mr-2"
                                            >

                                                ویرایش

                                            </a>





                                            <form
                                                action="{{ route('products.destroy', $product->id) }}"
                                                method="POST"
                                                class="inline"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="text-red-600"
                                                >

                                                    حذف

                                                </button>


                                            </form>


                                        </td>


                                    </tr>


                                @endforeach


                                </tbody>


                            </table>


                        </div>




                    @else


                        <div class="text-gray-600">

                            هنوز محصولی ثبت نکرده‌اید.

                        </div>



                    @endif



                </div>


            </div>


        </div>


    </div>


</x-app-layout>
