<div class="bg-white shadow-sm rounded-lg p-5">


    <div class="text-sm text-gray-500 mb-2">

        {{ $title }}

    </div>


    <div class="text-2xl font-bold text-gray-900">

        {{ $value }}

    </div>


    @if($description)

        <div class="text-sm text-gray-600 mt-2">

            {{ $description }}

        </div>

    @endif


</div>
