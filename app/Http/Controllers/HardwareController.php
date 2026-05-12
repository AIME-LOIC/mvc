<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HardwareController extends Controller
{
    public function index(): View
    {
        return view('hardware.index');
    }

    public function show(string $category, ?int $item_id = null): View
    {
        return view('hardware.show', [
            'category' => $category,
            'item_id' => $item_id,
        ]);
    }
}

