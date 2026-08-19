<div>

    <h3 class="text-xl font-bold mb-4">
        پنل تولیدکننده
    </h3>


    <div class="space-y-3">


        <div class="bg-gray-100 p-4 rounded-lg">

            <strong>
                وضعیت پروفایل:
            </strong>

            @if(auth()->user()->producerProfile)

                تکمیل شده

            @else

                نیاز به تکمیل پروفایل

            @endif

        </div>



        <div class="bg-gray-100 p-4 rounded-lg">

            <strong>
                محصولات:
            </strong>

            به زودی

        </div>



        <div class="bg-gray-100 p-4 rounded-lg">

            <strong>
                درخواست‌های خرید:
            </strong>

            به زودی

        </div>


    </div>

</div>
