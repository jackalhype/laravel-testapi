<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SwaggerController extends \L5Swagger\Http\Controllers\SwaggerController
{
    public function api(Request $request)
    {
        Artisan::call('l5-swagger:generate');
        return parent::api($request);
    }
}
