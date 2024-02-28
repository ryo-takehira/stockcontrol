<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
// メール送信用
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;


class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 備品管理画面
     */
    public function index()
    {

        // modelのItemから全てのデータを受け取る
        $items = Item::paginate(6);
        // viewのItemにデータを受け渡す

        return view('item.index', compact('items'));
    }

    /**
     * 備品一覧
     */
    public function used_item()
    {

        // modelのItemから全てのデータを受け取る
        $items = Item::paginate(6);
        // viewのItemにデータを受け渡す

        return view('item.used_item', compact('items'));
    }

    /**
     * 備品持出モーダルへ移動後、持出処理
     */
    public function take_out(Request $request, $id)
    {

        // $item = Item::find($id);
        // $items = $request->validate([
        //     'input_take_out' => 'required|integer|max:3',
        // ]);


        $used_quantity = $request->input('take_out');

        $model = Item::find($id);

        $model->update(['stock' => $model->stock - $used_quantity,]);

        // if ($model->stock < $model->minimum_stock) {
            // ②メール送信に使うインスタンスを生成
            // $NotificationEmail = new NotificationEmail();
            // ③メール送信
            // Mail::send($NotificationEmail);

            // // ⑤送信成功か確認
            // if (count(Mail::failures()) > 0) {
            //     $message = 'メール送信に失敗しました';

            //     // 元の画面に戻る
            //     return back()->withErrors($message);
            // } else {
            //     $messages = 'メールを送信しました';

            //     // 別のページに遷移する
            //     return redirect()->route('hoge')->with(compact('messages'));
            // }
        // }

        // modelのItemから全てのデータを受け取る
        $items = Item::paginate(6);
        // viewのItemにデータを受け渡す

        // return view('item.used_item', compact('items'));

        // ルート/itemsにリダイレクト
        return redirect('/items')->with('success', $model['name'] . ' が ' . $used_quantity . $model['stock_unit'] . ' 持出確定されました。');
    }

    /**
     * 備品登録
     */
    public function add(Request $request, Item $items)
    {
        // ユーザーid確認コード
        // dd(Auth::user()->id);

        if ($request->isMethod('post')) {

            $items = $request->validate(
                [
                    'name' => 'required|max:100',
                    'type' => 'required',
                    'image_name'=>'required|file|mimes:jpg,jpeg,png,svg,gif',
                    'model_no' => 'required|max:100',
                    'order_name' => 'required|max:15',
                    'order_phone' => ['regex:/^0[7-9]0\d{8}$|^0\d{9}$/', 'nullable'],
                    'stock_unit' => 'required|max:50',
                    'stock' => 'required|integer',
                    'minimum_stock' => 'required|integer',
                    'order_quantity' => 'required|integer',
                    'price' => 'required|integer',
                ],
                [
                    'name.required' => '備品名は必須です。',
                    'type.required' => '部署を選択してください。',
                    'image_name.required' => '画像を選択してください。',
                    'model_no.required' => '型番、品番は必須です。',
                    'order_name.required' => '発注先は必須です。',
                    'order_phone.regex' => '電話番号ではありません。',
                    'stock_unit.required' => '在庫単位は必須です。',
                    'stock.required' => '在庫数は必須です。',
                    'stock.integer' => '在庫数は数字で入力してください。',
                    'minimum_stock.required' => '最低在庫数は必須です。',
                    'minimum_stock.integer' => '最低在庫数は数字で入力してください。',
                    'order_quantity.required' => '発注数は必須です。',
                    'order_quantity.integer' => '発注数は数字で入力してください。',
                    'price.required' => '単価は必須です。',
                    'price.integer' => '単価は数字で入力してください。',
                ]
            );

            // dd($items);  

            // dd($request->file('image_name'));

            // hasFile メソッドでアップロードファイルの存在を確認
            if ($request->hasFile('image_name')) {

                $image_name = $request->file('image_name')->resize(300, 200);

                // ファイル名を取得(ファイル名.拡張子)
                $fileNmae = $image_name->getClientOriginalName();

                // ファイルの名から拡張子のみを取り出す
                $type_name = pathinfo($fileNmae, PATHINFO_EXTENSION);

                // ファイル名をbase64形式でデータのimage_nameに入れる
                $items['image_name'] = 'data:image/' . $type_name . ';base64,' . base64_encode(file_get_contents($image_name->path()));

                // アップロードファイルの存在なし 
                // no_image用の画像データ->config(定数);->$itemlists[image_name];へ
            } else {
                $items['image_name'] = config('noimage.no_image');
            }

            // print_r($items['image_name']);
            // exit;

            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'image_name' => $items['image_name'],
                'model_no' => $request->model_no,
                'order_name' => $request->order_name,
                'order_person' => $request->order_person,
                'order_phone' => $request->order_phone,
                'stock_unit' => $request->stock_unit,
                'stock' => $request->stock,
                'minimum_stock' => $request->minimum_stock,
                'order_quantity' => $request->order_quantity,
                'price' => $request->price,
            ]);

            Item::latest('updated_at')->paginate(6);

            // 備品管理画面へ
            return redirect('/items/index')->with('success', $request['name'] . ' が登録されました。');
        }

        return view('item.add');
    }


    /**
     * 削除
     *
     * @param Item $itemlist
     */

    public function delete(Item $item)
    {

        $item->delete();

        Item::latest('updated_at')->paginate(6);

        return redirect('/items/index')->with('success', $item['name'] . ' が削除されました。');
    }



    /**
     * 備品編集
     */
    public function edit(Request $request, Item $item)
    {
        // ユーザーid確認コード
        // dd(Auth::user()->id);

        if ($request->isMethod('post')) {

            $item_id = $request['item_id'];

            // print_r($item_id);
            // exit;

            $itemupdate = $request->validate(
                [
                    'name' => 'required|max:100',
                    'type' => 'required',
                    'image_name'=>'required|file|mimes:jpg,jpeg,png,svg,gif',
                    'model_no' => 'required|max:100',
                    'order_name' => 'required|max:15',
                    'order_phone' => ['regex:/^0[7-9]0\d{8}$|^0\d{9}$/', 'nullable'],
                    'stock_unit' => 'required|max:50',
                    'stock' => 'required|integer',
                    'minimum_stock' => 'required|integer',
                    'order_quantity' => 'required|integer',
                    'price' => 'required|integer',
                ],
                [
                    'name.required' => '備品名は必須です。',
                    'type.required' => '部署を選択してください。',
                    'image_name.required' => '画像を選択してください。',
                    'model_no.required' => '型番、品番は必須です。',
                    'order_name.required' => '発注先は必須です。',
                    'order_phone.regex' => '電話番号ではありません。',
                    'stock_unit.required' => '在庫単位は必須です。',
                    'stock.required' => '在庫数は必須です。',
                    'stock.integer' => '在庫数は数字で入力してください。',
                    'minimum_stock.required' => '最低在庫数は必須です。',
                    'minimum_stock.integer' => '最低在庫数は数字で入力してください。',
                    'order_quantity.required' => '発注数は必須です。',
                    'order_quantity.integer' => '発注数は数字で入力してください。',
                    'price.required' => '単価は必須です。',
                    'price.integer' => '単価は数字で入力してください。',
                ]
            );

            // dd($items);  

            // dd($request->file('image_name'));

            // hasFile メソッドでアップロードファイルの存在を確認
            if ($request->hasFile('image_name')) {

                $image_name = $request->file('image_name');

                // ファイル名を取得(ファイル名.拡張子)
                $fileNmae = $image_name->getClientOriginalName();

                // ファイルの名から拡張子のみを取り出す
                $type_name = pathinfo($fileNmae, PATHINFO_EXTENSION);

                // ファイル名をbase64形式でデータのimage_nameに入れる
                $itemupdate['image_name'] = 'data:image/' . $type_name . ';base64,' . base64_encode(file_get_contents($image_name->path()));

                // アップロードファイルの存在なし 
                // no_image用の画像データ->config(定数);->$itemlists[image_name];へ
            } else {
                $item['image_name'] = config('noimage.no_image');
            }

            // print_r($item);
            // exit;


            $item->where('id', $item_id)->update($itemupdate);

            Item::latest('updated_at')->paginate(6);

            // 商品管理画面へ
            return redirect('/items/index')->with('success', $request['name'] . ' が更新されました。');
        }

        return view('item.edit', compact('item'));
    }




    /**
     * 入庫
     *
     * @param Request $request
     */

    public function storing(Item $item)
    {
        // $itemlistのstockは$itemlistのstock足す$itemlistのorders
        $item->stock = $item->stock + $item->order_quantity;

        // $itemを更新する
        $item->save();

        Item::latest('updated_at')->paginate(6);

        // 更新後item一覧へ
        return redirect('/items/index')->with('success', $item['name'] . ' の在庫が入庫されました。');
    }

    // 備品一覧検索(管理画面)
    public function itemsearch(Request $request)
    {
        $items = Item::all();

        $search = $request->input('search');

        $query = Item::query();

        // $query = $query->paginate($query->count());

        if (!empty($search)) {

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach ($wordArraySearched as $value) {

                $query = Item::where('name', 'like', '%' . $value . '%')
                    ->orWhere('type', 'like', '%' . $value . '%')
                    ->orWhere('model_no', 'like', '%' . $value . '%')
                    ->orWhere('order_name', 'like', '%' . $value . '%');
            }
        }

        $items = $query->latest('updated_at')->paginate(10);

        return view('item.index', compact('items'));
    }



    // 備品一覧検索(ユーザー画面)
    public function used_itemsearch(Request $request)
    {
        $items = Item::all();

        $search = $request->input('used_search');

        $query = Item::query();

        // $query = $query->paginate($query->count());

        if (!empty($search)) {

            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach ($wordArraySearched as $value) {

                $query = Item::where('name', 'like', '%' . $value . '%')
                    ->orWhere('type', 'like', '%' . $value . '%')
                    ->orWhere('model_no', 'like', '%' . $value . '%');
            }
        }

        $items = $query->latest('updated_at')->paginate(10);

        return view('item.used_item', compact('items'));
    }
}
