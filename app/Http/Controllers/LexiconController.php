<?php

namespace App\Http\Controllers;

use App\Models\Lexicon;
use Illuminate\Http\Request;

class LexiconController extends Controller
{
    public function allDimensions()
    {
        return Lexicon::where('type', 'dimensions')
            ->where('status', 1)
            ->get();
    }

    public function allTypeOfGlass()
    {
        return Lexicon::where('type', 'typeOfGlass')
            ->where('status', 1)
            ->get();
    }

    public function allNameOfGlass()
    {
        return Lexicon::where('type', 'nameOfGlass')
            ->where('status', 1)
            ->get();
    }

    public function allNumberDepartment()
    {
        return Lexicon::where('type', 'numberDepartment')
            ->where('status', 1)
            ->get();
    }

    public function oneDimensions($id)
    {
        return Lexicon::where('type', 'dimensions')
            ->where('status', 1)
            ->where('code_id', $id)
            ->get();

    }

    public function oneTypeOfGlass($id)
    {
        return Lexicon::where('type', 'typeOfGlass')
            ->where('code_id', $id)
            ->where('status', 1)
            ->get();
    }

    public function oneNameOfGlass($id)
    {
        return Lexicon::where('type', 'nameOfGlass')
            ->where('code_id', $id)
            ->where('status', 1)
            ->get();
    }

    public function oneNumberDepartment($id)
    {
        return Lexicon::where('type', 'numberDepartment')
            ->where('code_id', $id)
            ->where('status', 1)
            ->get();
    }

}
