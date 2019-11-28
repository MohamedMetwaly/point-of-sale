<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::where(function($query){
            if(request()->has('search')){
                $query->where(function($q){
                    $q->where('name', 'like', '%' . request()->search . '%')
                    ->orWhere('email', 'like', '%' . request()->search . '%');
                });
            }
        })->latest()->paginate(7);
        return view('admin.users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'roles_list' => 'required',
            'image' => 'nullable|image'
        ]);
        request()->merge(['password' => bcrypt(request()->password)]);
        $user = User::create(request()->except('roles_list', 'image'));
        $user->roles()->attach(request()->input('roles_list'));
        if (request()->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '-' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->image =   'uploads/' . $name;
        }
        $user->save();
        session()->flash('success', (trans('admin.created')));
        return redirect(route('user.index'));
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
        $model = User::findOrFail($id);
        return view('admin.users.edit', compact('model'));
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
        $user = User::findOrFail($id);
        $this->validate(request(),[
            'name'       => 'required|string',
            'email'      => 'required|email|unique:users,email,'.$id,
            'roles_list' => 'required',
            'image' => 'nullable|image'
        ]);
        $user->roles()->sync(request()->input('roles_list'));
        $user->update(request()->except('image'));
        if (request()->hasFile('image')) {
            if(file_exists($user->image))
            {
                unlink($user->image);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/'; // upload path
            $logo = request()->file('image');
            $extension = $logo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $logo->move($destinationPath, $name); // uploading file to given path
            $user->image =   'uploads/' . $name;
            $user->save();
        }
        session()->flash('success', (trans('admin.updated')));
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        unlink($record->image);
        session()->flash('success', (trans('admin.deleted')));
        return back();
    }
}
