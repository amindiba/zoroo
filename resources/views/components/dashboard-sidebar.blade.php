<div class="bg-white shadow-sm rounded-lg p-4">

    <h3 class="font-bold text-lg mb-4">
        منوی داشبورد
    </h3>


    <ul class="space-y-2">

        @foreach($navigation as $item)

            <li>

                <a
                    href="{{ route($item['route']) }}"
                    class="block p-2 rounded hover:bg-gray-100"
                >
                    {{ $item['title'] }}
                </a>

            </li>

        @endforeach


    </ul>

</div>
