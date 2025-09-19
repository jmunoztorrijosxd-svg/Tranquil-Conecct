<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function formularioEspecial()
    {
        return view('formulario-especial'); // 👈 tu vista con el formulario
    }
}
