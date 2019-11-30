<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $records = Product::where(function($query){
            if(request()->has('search')){
                $query->where('name', 'like', '%' . request()->search . '%');
            }
            if(request()->has('category_id')){
                $query->where('category_id', 'like', '%' . request()->category_id . '%');
            }
        })->latest()->paginate(7);
        return view('admin.products.index', compact('records','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $product = Product::create(request()->except('image'));
        if (request()->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '-' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $product->image =   'uploads/' . $name;
        }
        $product->save();
        session()->flash('success', (trans('admin.created')));
        return redirect(route('product.index'));
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
        $model = Product::findOrFail($id);
        return view('admin.products.edit', compact('model'));
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
        $product = Product::findOrFail($id);
        $this->validate(request(),[
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
        ]);
        $product->update(request()->except('image'));
        if (request()->hasFile('image')) {
            if(file_exists($product->image))
            {
                unlink($product->image);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $product->image =   'uploads/' . $name;
            $product->save();
        }
        session()->flash('success', (trans('admin.updated')));
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Product::findOrFail($id);
        $record->delete();
        if ($record->image != null) {
            unlink($record->image);
        }
        session()->flash('success', (trans('admin.deleted')));
        return back();
    }
}
