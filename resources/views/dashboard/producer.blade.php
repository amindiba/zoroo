<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            داشبورد تولیدکننده
        </h2>

    </x-slot>


    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">


                    <h1 class="text-xl font-bold mb-4">
                        داشبورد تولیدکننده
                    </h1>


                    <p class="mb-4">
                        خوش آمدید {{ $user->name }}
                    </p>



                    @if($user->producerProfile)


                        <div>

                            <p>
                                وضعیت پروفایل کارخانه:
                                <strong>
                                    {{ $user->producerProfile->status }}
                                </strong>
                            </p>


                            <div class="mt-4">

                                <a href="{{ route('producer.profile.show') }}"
                                   class="underline">

                                    مشاهده پروفایل کارخانه

                                </a>


                                <br>


                                <a href="{{ route('producer.profile.edit') }}"
                                   class="underline">

                                    ویرایش اطلاعات

                                </a>

                            </div>

                        </div>


                    @else


                        <a href="{{ route('producer.profile.create') }}"
                           class="underline">

                            ثبت اطلاعات کارخانه

                        </a>


                    @endif


                </div>

            </div>

        </div>

    </div>


</x-app-layout>
