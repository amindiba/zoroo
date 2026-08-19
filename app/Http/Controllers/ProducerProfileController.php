<?php

namespace App\Http\Controllers;

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


        if ($user->producerProfile) {

            return redirect()
                ->route('producer.profile.show');

        }


        $data = $request->validate([

            'company_name' => 'required|string|max:255',

            'manager_name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:20',

            'province' => 'required|string|max:100',

            'city' => 'required|string|max:100',

            'description' => 'nullable|string',

        ]);


        $user->producerProfile()->create([

            ...$data,

            'status' => 'pending',

        ]);


        return redirect()
            ->route('producer.profile.show')
            ->with(
                'success',
                'پروفایل تولیدکننده ثبت شد.'
            );

    }



    public function show()
    {

        $profile = auth()
            ->user()
            ->producerProfile;


        return view(
            'producer.profile.show',
            compact('profile')
        );

    }



    public function edit()
    {

        $profile = auth()
            ->user()
            ->producerProfile;


        return view(
            'producer.profile.edit',
            compact('profile')
        );

    }



    public function update(Request $request)
    {

        $profile = auth()
            ->user()
            ->producerProfile;


        $data = $request->validate([

            'company_name' => 'required|string|max:255',

            'manager_name' => 'required|string|max:255',

            'phone' => 'nullable|string|max:20',

            'province' => 'required|string|max:100',

            'city' => 'required|string|max:100',

            'description' => 'nullable|string',

        ]);


        $profile->update($data);


        return redirect()
            ->route('producer.profile.show');

    }

}
