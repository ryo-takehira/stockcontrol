<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

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
     * 商品一覧
     */
    public function index()
    {

                // modelのItemから全てのデータを受け取る
                $items = Item::paginate(6);
                // viewのItemにデータを受け渡す

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request, Item $items)
    {
        // ユーザーid確認コード
        // dd(Auth::user()->id);

        if ($request->isMethod('post')) {

            $items = $request->validate([
                'name' => 'required|max:100',
                'type' => 'required',
                'model_no' => 'required|max:100',
                'order_name' => 'required|max:15',
                'order_person' => 'required|max:100',
                'order_phone' => 'required|regex:/^0[7-9]0\d{8}$/',
                'stock_unit' => 'required|max:50',
                'stock' => 'required|integer',
                'minimum_stock' => 'required|integer',
                'order_quantity' => 'required|integer',
                'price' => 'required|integer',
            ]);

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

            // 商品管理画面へ
            return redirect('/items');
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

        return redirect('/items');
    }





















}
