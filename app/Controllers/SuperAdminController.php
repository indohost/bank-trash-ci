<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SuperAdminController extends BaseController
{
    public function __construct()
    {
        if (session()->get('role') != "super_admin") {
            echo 'Access denied';
            exit;
        }
    }
    public function index()
    {
        return view("super_admin/dashboard");
    }
}
