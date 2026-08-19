<x-app-layout>

<div class="p-6">

    <h1 class="text-xl font-bold">
        پروفایل کارخانه
    </h1>


    <div class="mt-4">

        <p>
            نام کارخانه:
            {{ $profile->company_name }}
        </p>


        <p>
            مدیر:
            {{ $profile->manager_name }}
        </p>


        <p>
            استان:
            {{ $profile->province }}
        </p>


        <p>
            شهر:
            {{ $profile->city }}
        </p>


        <p>
            وضعیت:
            {{ $profile->status }}
        </p>

    </div>


    <a href="{{ route('producer.profile.edit') }}">
        ویرایش
    </a>


</div>

</x-app-layout>
