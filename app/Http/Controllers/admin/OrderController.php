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

    public function index()
    {
        $orders = Order::whereHas('client', function ($q){
            return $q->where('name', 'like', '%' . request()->search . '%');
        })->latest()->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function OrderCreate($id)
    {
        $client = Client::findOrFail($id);
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('admin.orders.create', compact('client','categories', 'orders'));
    }

    public function AddOrder($id)
    {
        $client = Client::findOrFail($id);
        $this->validate(request(),[
            'products' => 'required|array',
            'quantities' => 'required|array',
        ]);

        $this->Attach($client);

        session()->flash('success', (trans('admin.created')));
        return redirect(route('order.index'));
    }

    public function Products(Order $order)
    {
        $products = $order->products()->get();
        return view('admin.orders.show', compact('order', 'products'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $client = $order->client_id;
        $categories = Category::with('products')->get();
        return view('admin.orders.edit', compact('order','client', 'categories'));
    }


    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $client = $order->client_id;
        $this->validate(request(),[
            'products' => 'required|array',
            'quantities' => 'required|array',
        ]);

        $this->Detach($order);
        $this->Attach($client);

        session()->flash('success', (trans('admin.updated')));
        return redirect(route('order.index'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        foreach ($order->products as $product){
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
        session()->flash('success', (trans('admin.deleted')));
        return back();
    }

    private function Attach($client)
    {
        $order = $client->orders()->create(request()->all());
        $total_price = 0;
        foreach (request()->products as $index=>$product){
            $product_id = Product::findOrFail($product);
            $total_price += $product_id->sale_price * request()->quantities[$index];
            $order->products()->attach($product_id, ['quantity' => request()->quantities[$index]]);
            $product_id->update([
                'stock' => $product_id->stock - request()->quantities[$index]
            ]);
        }
        $order->update([
            'total_price' => $total_price
        ]);
    }

    private function Detach($order)
    {
        foreach ($order->products as $product){
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }
}
