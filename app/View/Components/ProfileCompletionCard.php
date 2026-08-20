<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class ProfileCompletionCard extends Component
{


    public int $progress;

    public string $status;




    public function __construct()
    {

        $profile = auth()
            ->user()
            ?->producerProfile;



        if (!$profile) {


            $this->progress = 0;

            $this->status = 'پروفایل ایجاد نشده';


            return;

        }





        $fields = [


            'company_name' => $profile->company_name,

            'manager_name' => $profile->manager_name,

            'phone' => $profile->phone,

            'province' => $profile->province,

            'city' => $profile->city,

            'description' => $profile->description,


        ];





        $completed = collect($fields)

            ->filter(function ($value) {

                return !empty($value);

            })

            ->count();





        $total = count($fields);





        $this->progress = (int) (

            ($completed / $total) * 100

        );







        if ($this->progress === 100) {



            if ($profile->status === 'approved') {


                $this->status = 'پروفایل تایید شده است';


            } else {


                $this->status = 'پروفایل تکمیل شده و منتظر بررسی است';


            }



        } else {



            $this->status = 'اطلاعات پروفایل کامل نیست';


        }


    }






    public function render(): View|Closure|string
    {

        return view(
            'components.profile-completion-card'
        );

    }


}
