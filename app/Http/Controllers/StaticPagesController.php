<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;


class StaticPagesController extends Controller
{
    //

    function home(){

        $feed_items = [];
        if (Auth::check()) {
            // 检查是否登陆
            $feed_items = Auth::user()->feed()->paginate(30);
            // 当前用户的所有微博信息并分页
        }

        return view('static_pages/home', compact('feed_items'));
    }

    function about(){
        return view('static_pages/about');
    }

    function help(){
        return view('static_pages/help');
    }
}