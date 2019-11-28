<?php

namespace App\Http\Controllers\admin;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Client::where(function($query){
            if(request()->has('search')){
                $query->where('name', 'like', '%' . request()->search . '%');
            }
        })->latest()->paginate(7);
        return view('admin.clients.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
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
            'phone' => 'required|numeric|min:11|unique:clients,phone',
            'address' => 'required|string',
            'image' => 'nullable|image'
        ]);
        request()->merge(['password' => bcrypt(request()->password)]);
        $client = Client::create(request()->except( 'image'));
        if (request()->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '-' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $client->image =   'uploads/' . $name;
        }
        $client->save();
        session()->flash('success', (trans('admin.created')));
        return redirect(route('client.index'));
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
        $model = Client::findOrFail($id);
        return view('admin.clients.edit', compact('model'));
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
        $client = Client::findOrFail($id);
        $this->validate(request(),[
            'name' => 'required|string',
            'phone' => 'required|numeric|min:11|unique:clients,phone,'.$id,
            'address' => 'required|string',
            'image' => 'nullable|image'
        ]);
        request()->merge(['password' => bcrypt(request()->password)]);
        $client = Client::create(request()->except( 'image'));
        if (request()->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '-' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $client->image =   'uploads/' . $name;
            $client->save();
        }
        session()->flash('success', (trans('admin.created')));
        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        if ($record->image != null){
            unlink($record->image);
        }
        session()->flash('success', (trans('admin.deleted')));
        return back();
    }
}
