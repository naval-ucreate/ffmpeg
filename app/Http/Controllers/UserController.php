<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ListUser;
class UserController extends Controller
{
    //
    public function ListUser(ListUser $list_user)
    {
        $list_user->dispatch();
    }
}
