<?php

namespace App\Http\Controllers;

use App\Models\AdmParameterCategory;
use Illuminate\Http\Request;

class AdmParameterCategoryController
{
    public function index()
    {
        return AdmParameterCategory::all();
    }
}
