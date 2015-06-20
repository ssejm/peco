<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Requests\AuthRequest;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Listings;
use App\User;


class ListingsController extends Controller
{
    //add contstructor that says you need to be logged in - via middleware
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
            //with caching
            /*
            $listings = Cache::remember('listings',  2, function () {
                return Listings::all();
            }); */

           //$listings = Listings::all();

          //  echo Auth::user()->id;
        
           $listings = Listings::where('user_id',  Auth::user()->id )->get();      

           
           
           //WORKED!
             return view('pages.listings', compact('listings'));

                         // return view('pages.listings', $listings);
            // return view('pages.listings')->with($listings);
            //return View::make('pages.listings', $listings);
                
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
    public function store()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
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