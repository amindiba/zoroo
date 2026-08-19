<div class="bg-white shadow-sm rounded-lg p-5">


    <div class="flex justify-between items-center mb-4">


        <h3 class="font-bold">

            تکمیل پروفایل تولیدکننده

        </h3>


        <span class="text-sm">

            {{ $progress }}%

        </span>


    </div>



    <div class="w-full bg-gray-200 rounded-full h-3">


        <div

            class="bg-blue-600 h-3 rounded-full"

            style="width: {{ $progress }}%"

        ></div>


    </div>



    <div class="mt-4 text-sm text-gray-700">

        {{ $status }}

    </div>


</div>
