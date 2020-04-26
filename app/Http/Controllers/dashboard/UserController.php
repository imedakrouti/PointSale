<?php

namespace App\Http\Controllers\dashboard;
//use session;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\NewUser;
use App\user;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        //create read update delete
        // $this->middleware(['permission:read_users'])->only('index');
        // $this->middleware(['permission:create_users'])->only('create');
        // $this->middleware(['permission:update_users'])->only('edit');
        // $this->middleware(['permission:delete_users'])->only('destroy');
    } //end of constructor

    public function index(Request $request)
    {
        // if ($request->table_search) {
        //     //dd($request->table_search);
        //     $users = user::where('first_name', 'like', '%' . $request->table_search . '%')
        //         ->orwhere('last_name', 'like', "%{$request->table_search}%")->get();
        // } else {
        //     $users = user::whereroleIs('admin')->get();
        // }
           // $super_admin=user::whereroleIs('super_admin')->get();
            //dd($super_admin);
        $users =user::select('id','first_name','last_name','email','image')->whereroleIs('admin')->where(function ($q) use ($request) {
            return $q->when($request->table_search, function ($query) use ($request) {
                return $query->where('first_name', 'like', '%' . $request->table_search . '%')
                    ->orwhere('last_name', 'like', "%{$request->table_search}%");
            });
        })->latest()->paginate(5);
        /*
        $users = user::whereroleIs('admin')->when($request->table_search, function ($query) use ($request) {
            return $query->where('first_name', 'like', '%' . $request->table_search . '%')
                ->orwhere('last_name', 'like', "%{$request->table_search}%");
        })->get();*/
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.')->position('center-center');
        //alert()->info('InfoAlert','Lorem ipsum dolor sit amet.');
        //toast('Info Toast','info');

        // toast('No Categories yet','error')->position('center-center')->autoClose(5000)->hideCloseButton();
        // toast(__('site.add'),'error')->position('center-center')->autoClose(5000)->hideCloseButton();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $data_user=$request->except(['image','password_confirmation','permissions']);
       // dd($data_user);

        if($request->image){
           // $request->image->store('user-images','public_upload');
             Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
         })->save(public_path('uploads/user-images/'.$request->image->hashName()));
         $data_user['image']=$request->image->hashName();
        }
        $user = user::create($data_user);
        // session()->flash('success', );
        // toast('Success Toast',('site.added_successfully'))->autoClose(5000);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);
        $super_admin=user::where('first_name','super')->first();
        $super_admin=user::whereRoleIs('super_admin')->first();
       // dd(($super_admin));
        $super_admin->notify(new NewUser($user));
        toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        return view('dashboard.user.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, user $user)
    {

        $data = $request->except(['permissions','image']);
        if($request->image){
            if($user->image != 'default.png'){
               // Storage::disk('public_upload')->delete('/user-images/' . $request->image);
                Storage::disk('public_upload')->delete('/user-images/'.$user->image);
            }
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
         })->save(public_path('uploads/user-images/'.$request->image->hashName()));
         $data['image']=$request->image->hashName();
        }


        $user->update($data);
        // $user->update([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'image'    => $request->image->hashName()
        // ]);
        $user->syncPermissions($request->permissions);
        toast(__('site.added_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect()->route('dashboard.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        if($user->image != 'default.png'){
            Storage::disk('public_upload')->delete('/user-images/'.$user->image);
        }
        $user->delete();
        toast(__('site.deleted_successfully'), 'success')->position('left', 'left')->background('#ddd');
        return redirect()->back();
    }
}
