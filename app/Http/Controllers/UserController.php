<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
        /**
     * ユーザー管理画面
     */
    public function index(User $user)
    {

                // modelのUserから全てのデータを受け取る
                $users = User::paginate(6);
                // viewのItemにデータを受け渡す

        return view('user.index', compact('users'));
    }

            /**
     * 削除
     *
     * @param User $user
     */

    public function delete(User $user)
    {
        
        $user->delete();

        User::latest('updated_at')->paginate(6);

        return redirect('/users/index')->with('success',$user['name'] . ' が削除されました。');
    }


        /**
     * ユーザー編集
     */
    public function edit(Request $request, User $user)
    {
        // ユーザーid確認コード
        // dd(Auth::user()->id);

        if ($request->isMethod('post')) {

            $user_id = $request['user_id'];

            // print_r($item_id);
            // exit;

            $userupdate = $request->validate([
                'name' => 'required|max:100',
                'isAdmin' => 'required',
            ],
            [
                'name.required' => 'ユーザー名は必須です。',
                'isAdmin.required' => 'ユーザー管理を選択してください。',
            ]);

            $user->where('id', $user_id)->update($userupdate);

            $users=User::paginate(6);

            // ユーザー管理画面へ
            return view('user.index', compact('users'));
        }

        return view('user.edit', compact('user'));
    }





}
