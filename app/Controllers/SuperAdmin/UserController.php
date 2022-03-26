<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class UserController extends BaseController
{
    public function index()
    {
        return view("super_admin/users/index");
    }
}
