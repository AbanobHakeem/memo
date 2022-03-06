<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $data['permissions']=Permission::get();
       return view("dashboard.pages.permissions.list",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('dashboard.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        try { 
            Permission::create($data);
            toastr()->success('New Permission added');
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
        $data['permission'] = Permission::find($id);
        return view('dashboard.pages.permissions.edit', $data);
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
        $data = $request->except('_token');
        try { 
            Permission::find($id)->update($data);
            toastr()->success('Permission Updated');
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
            Permission::destroy($id);
            toastr()->success('the Permission was deleted');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }
}
