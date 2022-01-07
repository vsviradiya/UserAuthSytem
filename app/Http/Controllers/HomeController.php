<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Validator;

use App\Mail\Subscribe;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Session;

use App\Http\Controllers\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(
                array(
                    'users.id',
                    'users.name',
                    'users.email',
                )
            )->get();
            return Datatables::of($data)->make(true);
        }
        return view('home');
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);

        //$del_user = User::findOne('id', $request->id)->delete();

        return Response()->json("deleted");

        // $details = [
        //     'title' => 'Mail from logisticli15',
        //     'body' => 'This is for testing email using smtp'
        // ];
      
        // Mail::to('vaibhavviradiya123.vv@gmail.com')->send(new \App\Mail\Subscribe($details));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request, User $user) {
           
        // dd($request->name, $request->email, $request->password);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        $request['password'] = bcrypt($request['password']);
        
        User::create($request->all());

        // Session::flash('flash_message', 'User successfully added!');

        return redirect('home')->with('success','User inserted successfully');
        
    }

    public function edit($id){

        $user = User::findOrFail($id);
        return view('edit',compact('user'));
    }

    public function update(Request $request) {

        // dd($id);
         
        // dd($request->id);
        $id = $request->id;
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'email is required',
            'password.required' => 'Password is required'
        ]);

        $request['password'] = bcrypt($request['password']);

        $input = $request->all();

        $user->fill($input)->save();

        return redirect('home')->with('success','User updated successfully');

        // return view('home')->with('success','User updated successfully');

        // $edituser = User::where('id', $request->id)->update($request->all());

        // if($edituser->passes()) {
        //     return response()->json(['success'=>'User updated successfully']);
        // }
        // else{
        //     return response()->json(['error'=>$request->errors()->all()]);
        // }
        
    }
}
