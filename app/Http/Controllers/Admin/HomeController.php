<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  function Index()
   {
    return view('admin.Home.dashbord');
   }


}
