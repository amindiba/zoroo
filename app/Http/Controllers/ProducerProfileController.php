<?php

namespace App\Http\Controllers;

use App\Models\ProducerProfile;
use Illuminate\Http\Request;

class ProducerProfileController extends Controller
{

    public function create()
    {
        return view('producer.profile.create');
    }



    public function store(Request $request)
    {

        $user = auth()->user();


        $validated = $request->validate([

            'company_name' => [
                'required',
                'string',
                'max:255',
            ],

            'manager_name' => [
                'required',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'province' => [
                'required',
                'string',
                'max:100',
            ],

            'city' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],

        ]);



        if ($user->producerProfile) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'پروفایل تولیدکننده قبلاً ثبت شده است.'
                );

        }



        $user->producerProfile()->create([

            ...$validated,

            'status' => 'pending',

        ]);



        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'اطلاعات کارخانه با موفقیت ثبت شد.'
            );

    }

}
