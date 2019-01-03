<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;


class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        session()->flash('success', '发布成功！');
        return redirect()->back();
    }

    public function destroy(Status $status)
    // 隐性路由绑定，自动查找对应的id的实例对象
    {
        $this->authorize('destroy', $status);
        // 验证当前删除的权限，登录id等于当前内容作者id
        $status->delete();
        // 调用Status模型的delete()方法进行删除对应内容
        session()->flash('success', '微博已被成功删除！');
        // 返回操作成功信息
        return redirect()->back();
    }
}