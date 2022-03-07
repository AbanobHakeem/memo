<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\Images;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::search()->paginate(config('app.itemPerPage'));
        return view('dashboard.pages.users.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->except('_token');
        $data['active'] = $request->has('active');
        $data['password']=Hash::make($data['password']);
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('users',$data['avatar']);
        try { 
            User::create($data);
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
        $data['user'] = User::find($id);
        return view('dashboard.pages.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['active'] = $request->has('active');
        $data['password']=Hash::make($data['password']);
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('users',$data['avatar']);
        try { 
            User::find($id)->update($data);
            toastr()->success('New user added');
            return redirect()->route('dashboard.users.index',['search'=>$data['name']]);
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
            return  User::find($id)->update(['active' => $request->input('status')]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
