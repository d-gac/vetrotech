<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/testing",
     *     @OA\Response(response="200", description="Display a listing of projects.")
     * )
     */
    public function index($test="testtt"){
        return $test;
    }
}
