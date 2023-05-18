<?php

namespace App\Http\Controllers;

use App\Http\Services\CategoryService;

class CategoryController extends BaseController
{
    /**
     * @param App\Http\Services\CategoryService $service
     *
     * @return \Illuminate\Http\Response
     */
    public function list(CategoryService $service)
    {
        return $this->success($service->list());
    }
}
