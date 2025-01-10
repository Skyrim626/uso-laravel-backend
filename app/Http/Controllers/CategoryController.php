<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    /**
     * Summary of getAllCategories: A public function that gets all categories.
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getAllCategories() {

        // Get all categories
        $categories = Category::all();

        // Return
        return $this->jsonResponse($categories, 200);

    }

}
