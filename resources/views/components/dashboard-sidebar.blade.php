<div class="bg-white shadow-sm rounded-lg p-4">


    <h3 class="font-bold text-lg mb-4">
        منوی داشبورد
    </h3>



    <ul class="space-y-2">


        @forelse($navigation as $item)


            <li>


                <a
                    href="{{ route($item['route']) }}"
                    class="block p-2 rounded hover:bg-gray-100"
                >

                    {{ $item['title'] }}

                </a>


            </li>



        @empty


            <li class="text-gray-500">

                منویی برای این نقش تعریف نشده است.

            </li>


        @endforelse



    </ul>


</div>
