<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;


class ProductPolicy
{


    /**
     * مشاهده محصول
     */
    public function view(User $user, Product $product): bool
    {

        return $user->role?->slug === 'admin'
            || $user->id === $product->user_id;

    }





    /**
     * ایجاد محصول
     */
    public function create(User $user): bool
    {

        return in_array(
            $user->role?->slug,
            [
                'producer',
                'admin'
            ]
        );

    }





    /**
     * ویرایش محصول
     */
    public function update(User $user, Product $product): bool
    {

        return $user->role?->slug === 'admin'
            || $user->id === $product->user_id;

    }





    /**
     * حذف محصول
     */
    public function delete(User $user, Product $product): bool
    {

        return $user->role?->slug === 'admin'
            || $user->id === $product->user_id;

    }





    /**
     * تایید یا تغییر وضعیت محصول توسط مدیریت
     */
    public function approve(User $user): bool
    {

        return $user->role?->slug === 'admin';

    }


}
