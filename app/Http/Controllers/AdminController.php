<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Display the product management page.
     */
    public function product()
    {
        return view('admin.product');
    }

    /**
     * Display the inventory management page.
     */
    public function inventory()
    {
        return view('admin.inventory');
    }

    /**
     * Display the customers management page.
     */
    public function customers()
    {
        return view('admin.customers');
    }

    /**
     * Display the suppliers management page.
     */
    public function suppliers()
    {
        return view('admin.supplier');
    }

    /**
     * Display the orders management page.
     */
    public function orders()
    {
        return view('admin.orders');
    }

    /**
     * Display the sales management page.
     */
    public function sales()
    {
        return view('admin.sales');
    }

    /**
     * Display the transactions management page.
     */
    public function transactions()
    {
        return view('admin.transactions');
    }

    /**
     * Display the employee management page.
     */
    public function employee()
    {
        return view('admin.employee');
    }

    /**
     * Display the stocks management page.
     */
    public function services()
    {
        return view('admin.services');
    }

    /**
     * Display the bookings management page.
     */
    public function bookings()
    {
        return view('admin.bookings');
    }

    /**
     * Display the logout page.
     */
    public function logout()
    {
        return view('admin.logout');
    }
}
