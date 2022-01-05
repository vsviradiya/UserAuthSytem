<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Mail\Subscribe;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Mail;

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
        $del_user = User::where('id', $request->id)->delete();

        // return Response()->json($del_user);

        $details = [
            'title' => 'Mail from logisticli15',
            'body' => 'This is for testing email using smtp'
        ];
      
        Mail::to('vaibhavviradiya123.vv@gmail.com')->send(new \App\Mail\Subscribe($details));
    }
}
