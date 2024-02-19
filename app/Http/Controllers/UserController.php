<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
        /**
     * ユーザー管理画面
     */
    public function index(User $user)
    {

				// ②ログイン中のユーザーを取得
                // dd(Auth::user()->isAdmin);
                // $auth_user = Auth::user()->isAdmin;

                $auth_user = Auth::user();

                // dd($auth_user);

                // modelのUserから全てのデータを受け取る
                $users = User::paginate(6);
                // viewのItemにデータを受け渡す

                // dd(compact('users','auth_user'));

        return view('user.index', compact('users','auth_user'));
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

        $auth_user = Auth::user();

        // dd($auth_user);

        // modelのUserから全てのデータを受け取る
        $users = User::paginate(6);
        // viewのItemにデータを受け渡す

        // dd(compact('users','auth_user'));

        return view('user.index', compact('users','auth_user'))->with('success',$user['name'] . ' が削除されました。');

        // return redirect('/users/index')->with('success',$user['name'] . ' が削除されました。');
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
                'user_type' => 'required',
                'isAdmin' => 'required',
            ],
            [
                'name.required' => 'ユーザー名は必須です。',
                'user_type.required' => '所属部署を選択してください。',
                'isAdmin.required' => 'ユーザー権限を選択してください。',
            ]);

            $user->where('id', $user_id)->update($userupdate);

            $auth_user = Auth::user();

            // dd($auth_user);

            // modelのUserから全てのデータを受け取る
            $users = User::paginate(6);
            // viewのItemにデータを受け渡す

            // dd(compact('users','auth_user'));

    return view('user.index', compact('users','auth_user'));
        }

        return view('user.edit', compact('user'));
    }



        // ユーザー一覧検索(ユーザー画面)
        public function usersearch(Request $request)
        {
            $users = User::all();
    
            $search = $request->input('usersearch');
    
            $query = User::query();
    
            // $query = $query->paginate($query->count());
    
            if (!empty($search)) {
    
                // 全角スペースを半角に変換
                $spaceConversion = mb_convert_kana($search, 's');
    
                // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
                $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
    
                // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
                foreach ($wordArraySearched as $value) {
    
                    $query = User::where('name', 'like', '%' . $value . '%')
                        ->orWhere('email', 'like', '%' . $value . '%')
                        ->orWhere('user_type', 'like', '%' . $value . '%');
                }
            }
    
            $users = $query->latest('updated_at')->paginate(10);
    
            $auth_user = Auth::user();

            // dd($auth_user);

            // modelのUserから全てのデータを受け取る
            // $users = User::paginate(6);
            // viewのItemにデータを受け渡す

            // dd(compact('users','auth_user'));

    return view('user.index', compact('users','auth_user'));
        }



}
