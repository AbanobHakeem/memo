<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\Images;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of  the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['publishers'] = Publisher::search()->ordered()->paginate(config('app.itemPerPage'));
        return view('dashboard.pages.publishers.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pages.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(PublisherRequest $request)
    {
        $data = $request->except('_token');
        $data['active'] = $request->has('active');
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('publishers',$data['avatar']);
        try { 
            Publisher::create($data);
            toastr()->success('New Publisher added');
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
        $data['publisher'] = Publisher::find($id);
        return view('dashboard.pages.publishers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublisherRequest $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['active'] = $request->has('active');
        if($request->hasFile('avatar'))
            $data['avatar']=Images::save('publishers',$data['avatar']);
        try { 
            Publisher::find($id)->update($data);
            toastr()->success('New Publisher added');
            return redirect()->route('dashboard.publishers.index',['search'=>$data['name']]);
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
            Publisher::destroy($id);
            toastr()->success('the Publisher was deleted');
            return redirect()->back();
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
            return redirect()->back();
        }
    }
    public function toggle(Request $request, $id)
    {
        try {

            return  Publisher::find($id)->update(['active' => $request->input('status')]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
