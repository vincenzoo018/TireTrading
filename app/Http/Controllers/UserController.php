<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display customer home page.
     */
    public function home()
    {
        return view('customer.home');
    }

    /**
     * Display products page.
     */
    public function products()
    {
        return view('customer.products');
    }

    /**
     * Display services page.
     */
    public function services()
    {
        return view('customer.services');
    }

    /**
     * Display booking page.
     */
    public function booking()
    {
        return view('customer.booking');
    }

    /**
     * Display cart page.
     */
    public function cart()
    {
        return view('customer.cart');
    }

    /**
     * Display profile page.
     */
    public function profile()
    {
        return view('customer.profile');
    }

    /**
     * Display checkout page.
     */
    public function checkout()
    {
        return view('customer.checkout');
    }

    /**
     * Display orders page.
     */
    public function orders()
    {
        return view('customer.orders');
    }

    /**
     * Display feedback page.
     */
    public function feedback()
    {
        return view('customer.feedback');
    }

    /**
     * Handle logout.
     */
    public function logout()
    {
        // Logout logic would go here
        \Auth::logout();
        return redirect()->route('login');
    }
}