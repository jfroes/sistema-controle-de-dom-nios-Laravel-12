<?php

namespace App\Http\Controllers\Domain;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        return view('components.domains.index');
    }

    public function show(Domain $domain): View
    {
        $domain = Domain::findOrFail($domain->id);

        return view('components.domains.show', compact('domain'));
    }
}
