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
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request, Item $items)
    {
        // $items = $request->all();
        if ($request->isMethod('post')) {
// dd($request);
        // $requestのvalidate(データの確認)を行い$itemlistsへ
        // $items = Validator::make($request->all(),[
        $items = $request->validate([
        // $this->validate($request, [
            'name' => ['required'|'max:100'],
            'type' => ['required'],
            'model_no' => ['required||max:100'],
            'order_name' => ['required|max:15'],
            'order_person' => ['required|max:100'],
            'order_phone' => ['required|integer'],
            'stock_unit' => ['required|max:50'],
            'stock' => ['required|integer'],
            'minimum_stock' => ['required|integer'],
            'order_quantity' => ['required|integer'],
            'price' => ['required|integer'],
        ]);

        データの作成
        Item::create($items);

        Item::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'type' => $request->type,
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


        // // POSTリクエストのとき
        //     if ($request->isMethod('post')) {
        //         // バリデーション
        //         $this->validate($request, [
        //             'name' => 'required|max:100',
        //         ]);

        //         // 商品登録
        //     // データの作成
        //     Item::create($items);

        //         Item::create([
        //             'user_id' => Auth::user()->id,
        //             'name' => $request->name,
        //             'type' => $request->type,
        //             'detail' => $request->detail,
        //         ]);

                return redirect('/items');
            }
            return view('item.add');
    }
        
}