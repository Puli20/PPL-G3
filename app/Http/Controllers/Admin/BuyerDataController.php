<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerDataController extends Controller
{
    public function index(){
        $data = User::all();
        return view('pages.admin.data-pembeli.data-pembeli',[
            'data' => $data
        ]);
    }
}
