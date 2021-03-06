<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use App\Profile;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Exception;
use Session;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $this->authorize('isAdmin'); // Limit only for admin &if puted in admin will apply this to all functions
       // $users = User::orderBy('created_at','desc')->paginate(8);
        //$categories = Category::all()->paginate(2);
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->all());

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users'
      ]);

     $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request['password'])
      ]);

      $profile = Profile::create([
          'user_id' => $user->id,
          'avatar' => 'uploads/avatars/1.png'
      ]);

      Session::flash('success', 'You successfully added user');

      return redirect(route('users.index'));

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = User::findOrFail($request->user_id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            //'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6'
        ]);
        $post->update($request->all());

        return back()->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->profile->delete();

        $user->delete();

        Session::flash('success', 'You successfully Deleted user');

        return redirect(route('users.index'));

    }

    public function admin($id)
    {
        $user = User::find($id);

        $user->admin = 1;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');

        return redirect(route('users.index'));
    }

    public function not_admin($id)
    {
        $user = User::find($id);

        $user->admin = 0;

        $user->save();

        Session::flash('success', 'Successfully changed user permission');

        return redirect(route('users.index'));
    }
}
