<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        return view('components.domains.index');
    }
}
