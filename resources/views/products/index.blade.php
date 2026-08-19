<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            محصولات من
        </h2>

    </x-slot>



    <div class="py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


            <div class="mb-6">

                <a
                    href="{{ route('products.create') }}"
                    class="bg-blue-600 text-white px-5 py-2 rounded"
                >
                    ثبت محصول جدید
                </a>

            </div>



            <div class="bg-white shadow-sm rounded-lg p-6">


                @if(session('success'))

                    <div class="mb-4 bg-green-100 p-3 rounded">

                        {{ session('success') }}

                    </div>

                @endif



                @if($products->count())


                    <div class="space-y-4">


                        @foreach($products as $product)


                            <div class="border rounded-lg p-4">


                                <div class="flex justify-between items-center">


                                    <div>


                                        <h3 class="font-bold text-lg">

                                            {{ $product->name }}

                                        </h3>


                                        <div class="text-sm text-gray-600">

                                            {{ $product->category }}

                                        </div>


                                    </div>



                                    <div>

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="text-blue-600"
                                        >
                                            مشاهده
                                        </a>

                                    </div>


                                </div>


                            </div>


                        @endforeach


                    </div>


                @else


                    <div class="text-gray-600">

                        هنوز محصولی ثبت نشده است.

                    </div>


                @endif


            </div>


        </div>

    </div>


</x-app-layout>
