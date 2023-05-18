<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasketAddRequest;
use App\Http\Services\BasketService;

class BasketController extends BaseController
{
    /**
     * @param App\Http\Requests\BasketAddRequest $request
     * @param App\Http\Services\BasketService $service
     *
     * @return \Illuminate\Http\Response
     */
    public function login(BasketAddRequest $request, BasketService $service)
    {
        if(!$service->add($request->validated()))
        {
            return $this->error(__("Ошибка при добавлении в корзину"));
        }
        return $this->success([], __("Успешно добавлено"));
    }
}
