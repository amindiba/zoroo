<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index()
    {

        $products = auth()
            ->user()
            ->products()
            ->with('category.parent')
            ->latest()
            ->get();


        return view(
            'products.index',
            compact('products')
        );

    }





    public function create()
    {

        $categories = Category::where('status', true)
            ->orderBy('parent_id')
            ->orderBy('name')
            ->get();


        return view(
            'products.create',
            compact('categories')
        );

    }





    public function store(Request $request)
    {

        $data = $request->validate([


            'name' => [

                'required',
                'string',
                'max:255',

            ],



            'description' => [

                'nullable',
                'string',

            ],



            'category_id' => [

                'required',
                'exists:categories,id',

            ],



            'province' => [

                'nullable',
                'string',
                'max:100',

            ],



            'city' => [

                'nullable',
                'string',
                'max:100',

            ],


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
            ->with('category.parent')
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



        $categories = Category::where('status', true)

            ->orderBy('parent_id')

            ->orderBy('name')

            ->get();



        return view(
            'products.edit',
            compact(
                'product',
                'categories'
            )
        );

    }





    public function update(Request $request, string $id)
    {

        $product = auth()
            ->user()
            ->products()
            ->findOrFail($id);



        $data = $request->validate([


            'name' => [

                'required',
                'string',
                'max:255',

            ],



            'description' => [

                'nullable',
                'string',

            ],



            'category_id' => [

                'required',
                'exists:categories,id',

            ],



            'province' => [

                'nullable',
                'string',
                'max:100',

            ],



            'city' => [

                'nullable',
                'string',
                'max:100',

            ],


        ]);




        $product->update([

            ...$data,

            'status' => 'pending',

        ]);



        return redirect()

            ->route('products.index')

            ->with(
                'success',
                'محصول بروزرسانی شد و برای بررسی مجدد ارسال گردید.'
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

            ->route('products.index')

            ->with(
                'success',
                'محصول حذف شد.'
            );

    }

}
