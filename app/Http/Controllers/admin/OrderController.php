<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('admin.orders.create', compact('client','categories', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Client $client
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Client $client)
    {

        $this->validate(request(),[
            'products' => 'required|array',
            'quantities' => 'required|array',
        ]);
        $order =$client->orders()->create(request()->all());
        $total_price = 0;
        foreach (request()->products as $index=>$product){
            $product_id = Product::findOrFail($product);
            $total_price += $product_id->sale_price;
            $order->products()->attach($product, ['quantity' => request()->quantities[$index]]);
            $product_id->update([
                'stock' => $product_id->stock - request()->quantities[$index]
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);
        session()->flash('success', (trans('admin.created')));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
