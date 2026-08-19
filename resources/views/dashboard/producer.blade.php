<x-app-layout>

    <div class="p-6">

        <h1>
            داشبورد تولیدکننده
        </h1>


        <p>
            خوش آمدید {{ $user->name }}
        </p>


        @if($user->producerProfile)

            <div>
                وضعیت پروفایل کارخانه:

                {{ $user->producerProfile->status }}

            </div>

        @else

            <a href="{{ route('producer.profile.create') }}">
                ثبت اطلاعات کارخانه
            </a>

        @endif


    </div>

</x-app-layout>
