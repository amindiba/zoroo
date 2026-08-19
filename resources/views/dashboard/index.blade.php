<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            داشبورد
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">


                    <div class="mb-6">

                        <h3 class="text-lg font-semibold">

                            خوش آمدید
                            {{ $user->name }}

                        </h3>


                        <p class="text-gray-600 mt-2">

                            نقش شما:

                            {{ $role }}

                        </p>


                    </div>





                    {{-- Producer Dashboard --}}

                    @if($role === 'producer')


                        <div class="border rounded-lg p-5 mb-6">


                            <h4 class="text-lg font-semibold mb-4">

                                پنل تولیدکننده

                            </h4>



                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">



                                <div class="border rounded p-4">


                                    <div class="text-gray-600">

                                        تعداد محصولات

                                    </div>


                                    <div class="text-2xl font-bold mt-2">

                                        {{ $productCount ?? 0 }}

                                    </div>


                                </div>





                                <div class="border rounded p-4">


                                    <div class="text-gray-600">

                                        وضعیت پروفایل

                                    </div>



                                    <div class="mt-2">


                                        @if($profileCompleted ?? false)


                                            <div class="text-green-600">

                                                کامل شده

                                            </div>


                                        @else


                                            <div class="text-red-600 mb-2">

                                                ناقص

                                            </div>



                                            <a
                                                href="{{ route('producer.profile.edit') }}"
                                                class="text-blue-600"
                                            >

                                                تکمیل پروفایل

                                            </a>


                                        @endif


                                    </div>


                                </div>





                                <div class="border rounded p-4">


                                    <div class="text-gray-600 mb-3">

                                        دسترسی سریع

                                    </div>



                                    <div class="flex flex-col gap-2">



                                        <a
                                            href="{{ route('products.create') }}"
                                            class="bg-blue-600 text-white px-4 py-2 rounded text-center"
                                        >

                                            ثبت محصول جدید

                                        </a>




                                        <a
                                            href="{{ route('products.index') }}"
                                            class="border border-blue-600 text-blue-600 px-4 py-2 rounded text-center"
                                        >

                                            مشاهده محصولات

                                        </a>




                                        <a
                                            href="{{ route('producer.profile.edit') }}"
                                            class="border border-gray-400 px-4 py-2 rounded text-center"
                                        >

                                            ویرایش پروفایل

                                        </a>


                                    </div>


                                </div>



                            </div>


                        </div>







                        <div class="border rounded-lg p-5">


                            <h4 class="text-lg font-semibold mb-4">

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


                                            </tr>

                                        </thead>





                                        <tbody>


                                        @foreach($latestProducts as $product)


                                            <tr>


                                                <td class="border p-3">

                                                    {{ $product->name }}

                                                </td>




                                                <td class="border p-3">

                                                    {{ $product->category?->name ?? '-' }}

                                                </td>




                                                <td class="border p-3">


                                                    @if($product->status === 'pending')

                                                        در انتظار تایید


                                                    @elseif($product->status === 'active')

                                                        فعال


                                                    @else

                                                        غیرفعال


                                                    @endif


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



                    @endif







                    {{-- سایر نقش‌ها --}}

                    @if($role !== 'producer')


                        <div class="border rounded-lg p-5">


                            داشبورد نقش شما در مرحله بعد توسعه داده می‌شود.


                        </div>


                    @endif



                </div>

            </div>


        </div>


    </div>


</x-app-layout>
