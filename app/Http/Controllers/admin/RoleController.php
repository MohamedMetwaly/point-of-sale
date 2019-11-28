<?php

namespace App\Http\Controllers\admin;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::all();
        return view('admin.roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),[
            'name'             => 'required|unique:roles,name',
            'display_name'     => 'required|unique:roles,display_name',
            'permissions_list' => 'required|array'
        ]);
        $record = Role::create($data);
        $record->permissions()->attach(request()->permissions_list);
        session()->flash('success', (trans('admin.created')));
        return redirect(route('role.index'));
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
        $model = Role::findOrFail($id);
        return view('admin.roles.edit',compact('model'));
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
        $record = Role::findOrFail($id);
        $data = $this->validate(request(),[
            'name'             => 'required|unique:roles,name,'.$id,
            'display_name'     => 'required|unique:roles,display_name,'.$id,
            'permissions_list' => 'required|array'
        ]);
        $record->update($data);
        $record->permissions()->sync(request()->permissions_list);
        session()->flash('success', (trans('admin.updated')));
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Role::findOrFail($id);
        $record->delete();
        session()->flash('success', (trans('admin.deleted')));
        return back();
    }
}
