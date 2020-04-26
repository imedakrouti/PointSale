<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\client;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$client=DB::table('clients')->pluck('name');
       // $client=client::pluck('name');
      // $client=client::orderBy('id','desc');
       //$client=DB::table('clients')->orderBy('id','desc');
       //$client=DB::table('clients')->orderBy('id','desc');
    //    $client=client::count();
    //    $client=client::avg('id');
    //    $client=client::min('id');
    //    $client=client::where('id',1)->avg('id');
    /*
    $client=DB::table('clients')->count();
    $client=DB::table('clients')->max('id');
    $client=DB::table('clients')->min('id');
    $client=DB::table('clients')->avg('id');
    */
    // $client=DB::table('clients')->where('id',10)->exists();
    // $client=client::where('id',10)->exists();
    // $client=client::where('id',10)->doesntExist();
        //DB::table('clients')->insert(['name'=>'malek','phone'=>'23741780','adress'=>'citeElOns']);
       //$client=DB::table('clients')->orderBy('id','desc')->paginate(3);
    // $client=DB::table('clients')->whereId(1)->pluck("name");


       // $client=DB::table('clients')->select('name')->distinct()->get();
     //  $client=client::select('name')->distinct()->get();
    //     $client=client::select('name')->whereBetween('name',['a','g'])->get();
    //     $client=DB::table('clients')->select('name')->whereNotBetween('name',['a','g'])->get();
    //     // $client=DB::table('clients')->pluck('id');
    //     // $client=client::whereIn('id',[1,2])->get();
    //      $client=DB::table('clients')->whereIn('name',['a','malek'])->get();
    //     //dd($client,gettype($client));
    //   foreach ($client as $value){
    //      echo $value->name, '<br>';

    //  }
    // $client=DB::table('clients')->whereId('4')->pluck('name');
    // //$id=$client->id;
    // //dd($client);


    //   // $client=client::whereIn('name',['client1','ahmed'])->update(['name'=>'imed']);
    //   // $client=client::whereIn('name',['client1','ahmed'])->delete;
    //   // dd($client);
    // //    $clients=client::select('id','name','phone','adress')->when($request->table_search,function($q) use($request){
    // //        return $q->where('name','like',"%{$request->table_search}%")
    // //                   ->orwhere('phone','like',"%{$request->table_search}%")
    // //                   ->orwhere('adress','like',"%{$request->table_search}%");
    // //    })->latest()->paginate(2);
    // // $clients=DB::table('clients')->select('id','name','phone','adress')->when($request->table_search,function($q) use($request){
    // //     return $q->where('name','==',"%{$request->table_search}%")
    // //              ->orwhere('phone','like',"%{$request->table_search}%")
    // //              ->orwhere('adress','like',"%{$request->table_search}%");

    // // })->latest()->paginate(3);
    //     $clients=client::paginate(4);
    //     $clients=DB::table('clients')->simplepaginate(7);
    //     $clients=client::select('id','name','phone','adress')->get();
    //     $clients=DB::table('clients')->select('id','name','phone','adress')->get();
    //     $clients=client::where('name','imed')->first();
    //    // $clients=client::latest()->get();
    //     $clients=DB::table('clients')->orderBy('name')->limit(4)->get();
    //     $client=client::find(4);
    //     $client->update(['name'=>'akrouti']);
    //     $client=client::where('id',4)->update(['name'=>'imed']);
    //    // $client=client::create(['name'=>'malouka','phone'=>'23456789','adress'=>'cite el ons']);
    //    // $client=DB::table('clients')->insertGetId(['name'=>'mama','phone'=>'25268830','adress'=>'darna']);
    //    // $client=DB::table('clients')->where('name','mama')->delete();
    //   //  $client=client::where('name','malek')->first()->delete();
    //    // $clients=client::distinct("name")->get();
    //   // $clients=DB::table('clients')->select('clients.id','name','phone','adress')->groupBy ('name')->get();
       $clients= client::latest()->get()->unique(['name']);
       $client=client::where('name','malouka')->where('adress','cite el ons')->update(['adress'=>'El Ons']);
      //$clients= DB::table('clients')->latest()->get()->unique(['name']);
        $clients=client::where([['name','imed'],['adress','ZERRR']])->get();
        $clients=client::whereTime('created_at','=','16:16:49')->get();
        $clients=client::whereDate('created_at','2020-04-23')->get();
        $clients=client::whereDay('created_at','23')->get();
        $clients=client::whereMonth('created_at','4')->get();
        //$clients=client::whereYear('created_at',now())->get();
        $clients=DB::table('clients')->whereNull('created_at')->get();
        $clients=DB::table('clients')->whereNotNull('created_at')->get();
        $clients=client::whereColumn('created_at','updated_at')->get();
        $clients=client::whereColumn('created_at','>=','updated_at')->get();
        $id=8;
        $clients=DB::table('clients')->when($id,function($q) use ($id){
            return $q->where('id',$id);},
            function($q){
                return $q->limit(3);
            })->get();
            $clients=DB::table('clients')->limit(7)->get();
      // dd($clients);
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
            session()->flash('toastsuccess', __('site.added_successfully'));

           // toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
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
