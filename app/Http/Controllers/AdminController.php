<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function getIndex()
    {
        //  Fetch posts and messages.
        return view('admin.index');
    }
}