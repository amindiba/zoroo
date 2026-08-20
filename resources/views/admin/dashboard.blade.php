<x-app-layout>


<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800">

        داشبورد مدیریت

    </h2>

</x-slot>





<div class="py-12">


<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">



<div class="grid grid-cols-1 md:grid-cols-5 gap-4">





<div class="bg-white shadow rounded-lg p-5">

<div class="text-gray-500">

کاربران

</div>


<div class="text-2xl font-bold mt-2">

{{ $usersCount }}

</div>

</div>







<div class="bg-white shadow rounded-lg p-5">

<div class="text-gray-500">

تولیدکنندگان

</div>


<div class="text-2xl font-bold mt-2">

{{ $producerCount }}

</div>

</div>








<div class="bg-white shadow rounded-lg p-5">

<div class="text-gray-500">

کل محصولات

</div>


<div class="text-2xl font-bold mt-2">

{{ $productsCount }}

</div>

</div>








<div class="bg-white shadow rounded-lg p-5">

<div class="text-gray-500">

در انتظار تایید

</div>


<div class="text-2xl font-bold mt-2">

{{ $pendingProductsCount }}

</div>

</div>








<div class="bg-white shadow rounded-lg p-5">

<div class="text-gray-500">

محصول فعال

</div>


<div class="text-2xl font-bold mt-2">

{{ $activeProductsCount }}

</div>

</div>




</div>







<div class="mt-8 bg-white shadow rounded-lg p-6">


<div class="flex justify-between items-center mb-5">


<h3 class="font-bold text-lg">

آخرین محصولات

</h3>



<a
href="{{ route('admin.products.index') }}"
class="text-blue-600"
>

مشاهده همه

</a>


</div>







<table class="min-w-full border">


<thead>

<tr class="bg-gray-100">


<th class="border p-3 text-right">

نام محصول

</th>


<th class="border p-3 text-right">

تولیدکننده

</th>


<th class="border p-3 text-right">

وضعیت

</th>


</tr>


</thead>





<tbody>


@foreach($latestProducts as $product)


<tr>


<td class="border p-3">

{{ $product->name }}

</td>



<td class="border p-3">

{{ $product->user?->name }}

</td>



<td class="border p-3">

{{ $product->status }}

</td>


</tr>


@endforeach


</tbody>


</table>



</div>





</div>

</div>



</x-app-layout>
