<nav class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">


            <div class="flex items-center">

                <a href="{{ route('dashboard') }}"
                   class="font-bold text-xl">

                    Zoroo

                </a>


            </div>



            <div class="flex items-center gap-4">


                <span class="text-gray-700">

                    {{ auth()->user()->name }}

                </span>



                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf


                    <button
                        type="submit"
                        class="text-red-600"
                    >

                        خروج

                    </button>


                </form>


            </div>


        </div>

    </div>


</nav>
