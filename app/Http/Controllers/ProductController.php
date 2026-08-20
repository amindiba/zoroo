<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ProductController extends Controller
{

    use AuthorizesRequests;



    public function index()
    {

        $user = auth()->user();

        $role = $user->role?->slug;



        if ($role === 'admin') {


            $products = Product::with([

                    'category.parent',

                    'user'

                ])

                ->latest()

                ->get();


        } else {


            $products = $user

                ->products()

                ->with([

                    'category.parent'

                ])

                ->latest()

                ->get();


        }



        return view(

            'products.index',

            compact('products')

        );

    }






    public function create()
    {

        $this->authorize(

            'create',

            Product::class

        );



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

        $this->authorize(

            'create',

            Product::class

        );



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

        $product = Product::with([

                'category.parent',

                'user'

            ])

            ->findOrFail($id);




        $this->authorize(

            'view',

            $product

        );




        return view(

            'products.show',

            compact('product')

        );

    }







    public function edit(string $id)
    {

        $product = Product::findOrFail($id);




        $this->authorize(

            'update',

            $product

        );




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

        $product = Product::findOrFail($id);




        $this->authorize(

            'update',

            $product

        );




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

        $product = Product::findOrFail($id);




        $this->authorize(

            'delete',

            $product

        );




        $product->delete();




        return redirect()

            ->route('products.index')

            ->with(

                'success',

                'محصول حذف شد.'

            );

    }


}
