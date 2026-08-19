<div>

    <h3 class="text-xl font-bold mb-6">
        پنل تولیدکننده
    </h3>


    <div class="mb-6">

        <x-profile-completion-card />

    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


        <x-dashboard-card
            title="وضعیت پروفایل"
            value="{{ auth()->user()->producerProfile?->status ?? 'ثبت نشده' }}"
            description="وضعیت بررسی پروفایل تولیدکننده"
        />


        <x-dashboard-card
            title="محصولات"
            value="0"
            description="تعداد محصولات ثبت شده"
        />


        <x-dashboard-card
            title="درخواست‌های خرید"
            value="0"
            description="درخواست‌های مرتبط با محصولات"
        />


    </div>



    @if(auth()->user()->producerProfile)

        <div class="mt-6 bg-blue-100 p-4 rounded-lg">

            <div class="font-bold mb-2">
                پروفایل تولیدکننده
            </div>


            <a
                href="{{ route('producer.profile.edit') }}"
                class="text-blue-600"
            >
                ویرایش پروفایل
            </a>


        </div>


    @else


        <div class="mt-6 bg-yellow-100 p-4 rounded-lg">


            <div class="font-bold mb-2">

                پروفایل تولیدکننده کامل نیست

            </div>


            <a
                href="{{ route('producer.profile.create') }}"
                class="text-blue-600"
            >
                ایجاد پروفایل تولیدکننده
            </a>


        </div>


    @endif


</div>
