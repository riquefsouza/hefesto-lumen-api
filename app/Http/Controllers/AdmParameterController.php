<?php

namespace App\Http\Controllers;

use App\Models\AdmParameter;
use Illuminate\Http\Request;

class AdmParameterController
{
    public function index()
    {
        return AdmParameter::all();
    }
}
