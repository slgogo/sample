<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    function create(){
        return view('sessions.create');
        // 当路由访问路由别名login时，指定的get方法即会访问绑定的create方法
    }
     public function store(Request $request)
     // 获取用户全部表单数据作为参数，进行验证
    {
       $credentials = $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required'
       ]);

       if (Auth::attempt($credentials,$request->has('remenber'))) {
        // 引用Auth类的attempt方法，查询之前表单提交数据是否与数据库匹配
           session()->flash('success','欢迎回来');
           $fallback = route('users.show', Auth::user());
           // 设置变量内容为访问路由地址并传入用户数据给下次重定向使用
           return redirect()->intended($fallback);
           // 当用户重新登录后跳转到之前请求记录的跳转地址
           // return redirect()->route('users.show',[Auth::user()]);
       } else {
           // 登录失败后的相关操作
          session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
          return redirect()->back()->withInput();
          // back()表示重定向到之前的页面 withInput()表示跳转后显示之前输入的内容
       }

       return;
    }
    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
      public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
}
