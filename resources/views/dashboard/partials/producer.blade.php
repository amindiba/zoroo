<div>

    <h3 class="text-xl font-bold mb-6">
        پنل تولیدکننده
    </h3>



    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">



        <div class="border rounded-lg p-4">

            <div class="text-gray-600">
                وضعیت پروفایل
            </div>

            <div class="text-xl font-bold mt-2">

                {{ $user->producerProfile?->status ?? 'ثبت نشده' }}

            </div>

        </div>





        <div class="border rounded-lg p-4">

            <div class="text-gray-600">
                تعداد محصولات
            </div>

            <div class="text-xl font-bold mt-2">

                {{ $productCount ?? 0 }}

            </div>

        </div>





        <div class="border rounded-lg p-4">

            <div class="text-gray-600">
                در انتظار تایید
            </div>

            <div class="text-xl font-bold mt-2">

                {{ $pendingProductCount ?? 0 }}

            </div>

        </div>





        <div class="border rounded-lg p-4">

            <div class="text-gray-600">
                فعال
            </div>

            <div class="text-xl font-bold mt-2">

                {{ $activeProductCount ?? 0 }}

            </div>

        </div>





        <div class="border rounded-lg p-4">

            <div class="text-gray-600">
                غیرفعال
            </div>

            <div class="text-xl font-bold mt-2">

                {{ $inactiveProductCount ?? 0 }}

            </div>

        </div>


    </div>





    <div class="mt-6 border rounded-lg p-5">


        <h4 class="font-bold mb-3">
            دسترسی سریع
        </h4>



        <div class="flex gap-3 flex-wrap">


            <a
                href="{{ route('products.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded"
            >
                ثبت محصول جدید
            </a>



            <a
                href="{{ route('products.index') }}"
                class="border px-4 py-2 rounded"
            >
                محصولات من
            </a>



            <a
                href="{{ route('producer.profile.edit') }}"
                class="border px-4 py-2 rounded"
            >
                ویرایش پروفایل
            </a>


        </div>


    </div>





    <div class="mt-6 border rounded-lg p-5">


        <h4 class="font-bold mb-4">
            آخرین محصولات
        </h4>




        @if(isset($latestProducts) && $latestProducts->count())



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
                                وضعیت
                            </th>


                            <th class="border p-3 text-right">
                                عملیات
                            </th>


                        </tr>


                    </thead>




                    <tbody>


                    @foreach($latestProducts as $product)


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


                                @if($product->status === 'pending')

                                    در انتظار تایید


                                @elseif($product->status === 'active')

                                    فعال


                                @elseif($product->status === 'inactive')

                                    غیرفعال


                                @elseif($product->status === 'approved')

                                    تایید شده


                                @else

                                    نامشخص


                                @endif


                            </td>




                            <td class="border p-3">


                                <a
                                    href="{{ route('products.show',$product) }}"
                                    class="text-blue-600"
                                >

                                    مشاهده

                                </a>


                            </td>


                        </tr>


                    @endforeach


                    </tbody>


                </table>


            </div>



        @else


            <p class="text-gray-600">

                هنوز محصولی ثبت نشده است.

            </p>


        @endif



    </div>



</div>
