<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {

        $products = auth()
            ->user()
            ->products()
            ->latest()
            ->get();



        return view(
            'products.index',
            compact('products')
        );

    }




    public function create()
    {

        return view('products.create');

    }




    public function store(Request $request)
    {

        $data = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'category' => 'nullable|string|max:255',

            'province' => 'nullable|string|max:100',

            'city' => 'nullable|string|max:100',

        ]);



        auth()
            ->user()
            ->products()
            ->create([

                ...$data,

                'status' => 'pending',

            ]);



        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'محصول با موفقیت ثبت شد.'
            );

    }




    public function show(string $id)
    {

        $product = auth()
            ->user()
            ->products()
            ->findOrFail($id);



        return view(
            'products.show',
            compact('product')
        );

    }




    public function edit(string $id)
    {

        $product = auth()
            ->user()
            ->products()
            ->findOrFail($id);



        return view(
            'products.edit',
            compact('product')
        );

    }




    public function update(Request $request, string $id)
    {

        $product = auth()
            ->user()
            ->products()
            ->findOrFail($id);



        $data = $request->validate([

            'name' => 'required|string|max:255',

            'description' => 'nullable|string',

            'category' => 'nullable|string|max:255',

            'province' => 'nullable|string|max:100',

            'city' => 'nullable|string|max:100',

        ]);



        $product->update($data);



        return redirect()
            ->route('products.index')
            ->with(
                'success',
                'محصول بروزرسانی شد.'
            );

    }




    public function destroy(string $id)
    {

        $product = auth()
            ->user()
            ->products()
            ->findOrFail($id);



        $product->delete();



        return redirect()
            ->route('products.index');

    }

}
