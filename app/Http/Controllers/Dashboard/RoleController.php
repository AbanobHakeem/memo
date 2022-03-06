<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] =Role::all();
        return view ('dashboard.pages.roles.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permissions'] = Permission::get();
        return view('dashboard.pages.roles.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try { 
            $role =Role::create(['name' => $request->name,'guard_name' => 'admin']);
            $permissions=$request->permissions;
            $role->syncPermissions($permissions);
            toastr()->success('New Role added');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        } 
    

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
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::get();
        return view('dashboard.pages.roles.edit',$data);
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
        try { 
            $role =Role::find($id);
            $role->update(['name' => $request->name,'guard_name' => 'admin']);
            $permissions=$request->permissions;
            $role->syncPermissions($permissions);
            toastr()->success('Role Updated');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Role::destroy($id);
            toastr()->success('The Role was deleted');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }
}
