<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $clients=client::paginate(5);
       $clients=client::withcount('client')->when($request->table_search,function($q) use($request){
           return $q->where('name','like',"%{$request->table_search}%")
                      ->orwhere('phone','like',"%{$request->table_search}%")
                      ->orwhere('adress','like',"%{$request->table_search}%");
       })->latest()->paginate(4);
        return view('dashboard.client.index')->with(['clients'=>$clients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'adress' => 'required',
        ]);
            $request_data=$request->all();
            $request_data['phone']=array_filter($request->phone);
            client::create($request_data);
            toast(__('site.updated_successfully'), 'success')->position('left', 'left')->background('#ddd');
            return redirect(route('dashboard.client.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        return view('dashboard.client.edit')->with(['client'=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'adress' => 'required',
        ]);
            $request_data=$request->all();
            $request_data['phone']=array_filter($request->phone);
            $client->update($request_data);
            toast(__('site.updated_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect(route('dashboard.client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        $client->delete();
        toast(__('site.deleted_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect()->back();
    }
}
