<x-app-layout>

<div class="p-6">

    <h1 class="text-xl font-bold">
        داشبورد تولیدکننده
    </h1>


    <p class="mt-4">
        خوش آمدید {{ $user->name }}
    </p>


    @if($user->producerProfile)

        <div class="mt-4">

            <p>
                وضعیت پروفایل کارخانه:
                {{ $user->producerProfile->status }}
            </p>


            <a href="{{ route('producer.profile.show') }}">
                مشاهده پروفایل کارخانه
            </a>


            <br>


            <a href="{{ route('producer.profile.edit') }}">
                ویرایش اطلاعات
            </a>

        </div>


    @else


        <div class="mt-4">

            <a href="{{ route('producer.profile.create') }}">
                ثبت اطلاعات کارخانه
            </a>

        </div>


    @endif


</div>

</x-app-layout>
