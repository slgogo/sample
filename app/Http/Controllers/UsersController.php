<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }
    public function show(User $user){
        return view('users.show',compact('user'));
    }
    public function store(Request $request){
        $this->validate($request,[
          'name'=>'required|max:50',
          'email'=>'required|email|unique:users|max:255',
          'password'=>'required|confirmed|min:6'
        ]);
          $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        // 注册后直接登录
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);

    }
    public function edit(User $user){
        return view('users.edit',compact('user'));
    }
    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
         // 验证用户更新的表单输入
        $data = [];
        // 新建一个空数组用于存放更改后的内容
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        // 判断如果更新时有新密码才获取新密码存储到临时数组$data
        $user->update($data);
        // 把获取到更新的表单项目内容提交到对应的模型实例
        session()->flash('success', '个人资料更新成功！');
        // 更新完成显示提示信息
        return redirect()->route('users.show', $user);
        // 更新完成重定向到用户资料页面并传入用户数据给当前视图
    }
    // 通过用户模型实例$user的update()方法，更新表单内容到数据库
}
