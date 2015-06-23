<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Validator;
use Input;
use Session;
use Redirect;


use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    
    //add constructor that says you need to be logged in - via middleware
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
          return view('auth.edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // $user = User::find($id);
         
        $user = Auth::user();

        $rules = array(
            'first_name'       => 'required',
            'last_name'       => 'required',
            'email'      => 'required|email',
            'new_password' => 'confirmed|min:4',
            'password' => 'required',
        );
        
          $validator = Validator::make(Input::all(), $rules);

    
            
        $credentials =  $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            //return redirect()->intended($this->redirectPath());
        }


        
        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } 
        else if(!Auth::attempt($credentials))
        {
            
            return redirect('user/')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'These credentials do not match our records.',
            ]);

        }
        else {
            // store

            $user->first_name = Input::get('first_name');
            $user->last_name =  Input::get('last_name');
            $user->email =  Input::get('email');

            if (Input::has('new_password'))
            {
                 $user->password = bcrypt(Input::get('new_password'));

            }


            $user->updated_at =  Carbon::now();

            $user->save();
            // redirect
            return Redirect::to('user/')->with('success', 'You have successfully edited your profile!');

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // get the nerd
        $user = User::find($id);


         return view('auth.edit', compact('$user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        //return Redirect::to('auth.edit')->with('success', 'You have successfully edited your profile!');

        
        //return view('auth.edit', compact('$user'))->with('success', 'You have successfully edited your profile!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
