<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Hash;


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
                    'users.subscriptionday',
                    'users.unique_id'
                )
            );
            return Datatables::of($data)->make(true);
        }
        return view('home');
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);

        return Response()->json("deleted");

    }

    public function create()
    {
        return view('user_create');
    }

    public function store(Request $request, User $user)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // $request['password'] = bcrypt($request['password']);

        // User::create($request->all());
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'subscriptionday' =>$request->get('subscriptionday'),
        ]);

        return redirect('home')->with('success', 'User inserted successfully');
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('user_edit', compact('user'));
    }

    public function update(Request $request)
    {

        $id = $request->id;

        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'email is required',
            'password.required' => 'Password is required'
        ]);

        $request['password'] = bcrypt($request['password']);

        $input = $request->all();

        $user->fill($input)->save();

        return redirect('home')->with('success', 'User updated successfully');

    }
}
