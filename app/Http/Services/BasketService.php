<?php

namespace App\Http\Services;

use App\Models\Basket;

class BasketService
{

    /**
     * @param array<string,string> $basket
     * @param bool $remember
     *
     * @return bool
     */
    public function add(array $basket)
    {
        try {
            $basket = Basket::create([
                "items" => $basket["items"]
            ]);
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }

}
