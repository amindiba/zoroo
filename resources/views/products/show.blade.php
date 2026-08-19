<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            جزئیات محصول
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">


                    <div class="flex justify-between items-center mb-6">


                        <h3 class="text-lg font-semibold">

                            {{ $product->name }}

                        </h3>



                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="bg-green-600 text-white px-4 py-2 rounded"
                        >

                            ویرایش محصول

                        </a>


                    </div>





                    <div class="space-y-4">



                        <div>

                            <strong>
                                نام محصول:
                            </strong>


                            {{ $product->name }}

                        </div>





                        <div>

                            <strong>
                                دسته‌بندی:
                            </strong>


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


                        </div>





                        <div>

                            <strong>
                                توضیحات:
                            </strong>


                            <p class="mt-2">

                                {{ $product->description ?? '-' }}

                            </p>

                        </div>





                        <div>

                            <strong>
                                استان:
                            </strong>


                            {{ $product->province ?? '-' }}

                        </div>





                        <div>

                            <strong>
                                شهر:
                            </strong>


                            {{ $product->city ?? '-' }}

                        </div>





                        <div>

                            <strong>
                                وضعیت:
                            </strong>



                            @if($product->status === 'active')

                                فعال


                            @elseif($product->status === 'pending')

                                در انتظار تایید


                            @else

                                غیرفعال


                            @endif


                        </div>





                        <div>

                            <strong>
                                تاریخ ثبت:
                            </strong>


                            {{ $product->created_at->format('Y-m-d') }}

                        </div>



                    </div>





                    <div class="mt-8">


                        <a
                            href="{{ route('products.index') }}"
                            class="text-blue-600"
                        >

                            بازگشت به محصولات

                        </a>


                    </div>



                </div>


            </div>


        </div>


    </div>


</x-app-layout>
