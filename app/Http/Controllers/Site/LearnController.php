<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function __invoke()
    {
        return inertia('Site/Learn/Index');
    }
}
