<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\Images;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthourRequest;
use App\Models\Authour;
use Illuminate\Http\Request;

class AuthourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['authours'] = Authour::search()->ordered()->paginate(config('app.itemPerPage'));
        return view('dashboard.pages.authours.list', $data);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.authours.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthourRequest $request)
    {
        $data = $request->except('_token');
        $data['active'] = $request->has('active');
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('authours',$data['avatar']);
        try { 
            Authour::create($data);
            toastr()->success('New Authour added');
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
        $data['authour'] = Authour::find($id);
        return view('dashboard.pages.authours.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthourRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['active'] = $request->has('active');
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('authours',$data['avatar']);
        try { 
            Authour::find($id)->update($data);
            toastr()->success(' Authour upated');
            return redirect()->route('dashboard.authours.index',['search'=>$data['name']]);
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
            Authour::destroy($id);
            toastr()->success('the Authour was deleted');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }
    public function toggle(Request $request, $id)
    {
        try {
            return  Authour::find($id)->update(['active' => $request->input('status')]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
