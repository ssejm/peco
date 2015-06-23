<?php

namespace App\Http\Controllers;

use Auth;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Listings;
use App\User;


use Validator;
use Input;
use Session;
use Redirect;

class ListingsController extends Controller
{
    //add constructor that says you need to be logged in - via middleware
    public function __construct()
    {
        //want to publicly show listings for SHOW, so have to do it in routes
        //$this->middleware('auth');
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

        
           $listings = Listings::where('user_id',  Auth::user()->id )->get();      

           
           //WORKED!
             return view('listings.index', compact('listings'));

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
        return view('listings.new');
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'       => 'required',
            'description'       => 'required',
            'category'      => 'required',
            'price'      => 'required|numeric',
            'image_file_name'      => 'required',
        );
        
        $messages = [
            'price.numeric' => 'The price must be a number. (Please do not include commas or dollar signs)',
            'image_file_name.required' => 'At least one image is required.',
        ];       
         
        $validator = Validator::make($request->all(), $rules, $messages);
            

        if ($validator->fails()) {
            return Redirect::to('/listings/create')
                ->withErrors($validator)
                ->withInput( $request->all());
        } 
        else {
            // store

            $listing = new Listings;
            $listing->title = $request->input('title');
            $listing->description =  $request->input('description');
            $listing->category =  $request->input('category');
            $listing->price =  $request->input('price');
            $listing->image_file_name =  $request->input('image_file_name');
            
            $user = Auth::user();
            
            $listing->user_id =  $user->id;
            $listing->save();
            // redirect
            return Redirect::to('/listings')->with('success', 'You have successfully created your listing!');

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
        $listing = Listings::find($id);
        
        //OLD way of doing it
        // $listings = Listings::where('id', $id)->get();      
        //should only be one result!
        //$listing = $listings[0];


        return view('listings.show', compact('listing'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $listing = Listings::find($id);

        return view('listings.edit', compact('listing'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {

        $listing = Listings::find($id);
         
        $rules = array(
            'title'       => 'required',
            'description'       => 'required',
            'category'      => 'required',
            'price'      => 'required|numeric',
            //'price'      =>  array('match:/^[0-9,\$]*\.[0-9]+$/'),
            'image_file_name'      => 'required',
        );
        
        

        $messages = [
            'price.numeric' => 'The price must be a number. (Please do not include commas or dollar signs)',
            'image_file_name.required' => 'At least one image is required.',
        ];       
         
        $validator = Validator::make($request->all(), $rules, $messages);
            

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/listings/'. $listing->id . '/edit')
                ->withErrors($validator)
                ->withInput( $request->all());
        } 
        else {
            // store

            $listing->title = $request->input('title');
            $listing->description =  $request->input('description');
            $listing->category =  $request->input('category');
            
            
            //$price = $request->input('price');
            //preg_replace('/(\d),(\d)/','$1$2',$str);

             
            $listing->price =  $request->input('price');
            $listing->image_file_name =  $request->input('image_file_name');


            $listing->save();
            // redirect
            return Redirect::to('/listings')->with('success', 'You have successfully updated your listing!');

        }
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
