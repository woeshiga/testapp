<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function renderHome() {
        if (Auth::check()) {
            if (Auth::user()->email == env("ADMIN_EMAIL")) {
                $status = "Admin";
            } else {
                $status = "User";
            }
            return view('home')->with('userName', Auth::user()->name)->with('userStatus', $status);
        } else {
            return view('home_unauth');
        }
    }
}
