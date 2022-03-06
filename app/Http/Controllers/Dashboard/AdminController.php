<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\Images;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins'] = Admin::search()->paginate(config('app.itemPerPage'));
        return view('dashboard.pages.admins.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::all();
        return view('dashboard.pages.admins.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $data = $request->except('_token');
        $data['active'] = $request->has('active');
        $data['password']=Hash::make($data['password']);
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('admins',$data['avatar']);
        try { 
            Admin::create($data);
            toastr()->success('New User added');
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
        $data['admin'] = Admin::find($id);
        $data['roles'] = Role::all();
        return view('dashboard.pages.admins.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminRequest $request, $id)
    {
        $data = $request->except('_token', '_method','roles');
        $data['active'] = $request->has('active');
        $data['password']=Hash::make($data['password']);
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('admins',$data['avatar']);
        try { 
           $admin= Admin::find($id);
           $admin->update($data);
           $admin->syncRoles($request->input('roles'));
            toastr()->success('admin Updated');
            return redirect()->route('dashboard.admins.index',['search'=>$data['name']]);
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
    public function toggle(Request $request, $id)
    {
        try {
            return  Admin::find($id)->update(['active' => $request->input('status')]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
