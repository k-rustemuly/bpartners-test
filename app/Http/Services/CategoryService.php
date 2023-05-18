<?php

namespace App\Http\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryService
{

    /**
     *
     * @return bool
     */
    public function list()
    {
        return new CategoryResource(Category::all());
    }

}
