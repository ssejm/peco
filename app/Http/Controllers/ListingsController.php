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
use Illuminate\Support\Str;

use File;
use Image;


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
            'image'      => 'required|max:2000|mimes:jpg,gif,jpeg,bmp,png',
        );
        
        $messages = [
            'price.numeric' => 'The price must be a number. (Please do not include commas or dollar signs)',
            'image.required' => 'At least one image is required.',
            'image.mimes' => 'Not a valid image. Valid types include jpg/jpeg, gif, and png.',
            'image.max' => ' The image must be less than than 2MB!'
        ];       
         
        $validator = Validator::make($request->all(), $rules, $messages);
            

        if ($validator->fails()) {
            return Redirect::to('/listings/create')
                ->withErrors($validator)
                ->withInput( $request->all());
        } 
        else if ( !$request->file('image')->isValid() )
        {
          // sending back with error message.
          return Redirect::to('/listings/create')->with('error', 'uploaded file is not valid');
        }
        else {
            // store

            $listing = new Listings;

//            $listing->title = $request->input('title');
//            $listing->description =  $request->input('description');
            $listing->title = $this->profanityCheck($request->input('title'));
            $listing->description =  $this->profanityCheck($request->input('description'));
            $listing->category =  $request->input('category');
            $listing->price =  $request->input('price');
           // $listing->image_file_name =  $request->input('image_file_name');
            

            $listing->image_content_type =  $request->file('image')->getMimeType();
            $listing->image_file_sizes =  $request->file('image')->getSize();

            //move to correct destination
            //$destinationPath = url( asset('/images/listings/'));
            $destinationPath = public_path('images/listings/');
            $thumbnailPath = public_path('images/thumbnails/');
            $mediumPath = public_path('images/medium/');
            
            $extension =  $request->file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = Str::random(10) . rand(11111,99999).'.'.$extension; // renaming image

           // $listing->image_file_name =   $request->file('image')->getClientOriginalName();
            $listing->image_file_name =  $fileName;
            
            
            $request->file('image')->move($destinationPath, $fileName);

            //use to check image dimensions
            //list($width, $height) = getimagesize($destinationPath . $fileName);
            //echo "Width: $width, Height: $height<br />";
            
            //make thumbnail
            Image::make($destinationPath . $fileName, array(
                'width' => 100,
                'height' => 100,
            ))->save($thumbnailPath . $fileName);
            
            //make medium size image for listing display
            Image::make($destinationPath . $fileName, array(
                'width' => 500,
                'height' => 500,
            ))->save($mediumPath . $fileName);
            
            /*
            //Getting path of uploaded file 
            $path = Input::file('image')->getRealPath();
            */
            
            //for foreign key
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
            'image'      => 'max:999|mimes:jpg,gif,jpeg,bmp,png',
        );
        
        $messages = [
            'price.numeric' => 'The price must be a number. (Please do not include commas or dollar signs)',
            //'image.required' => 'At least one image is required.',
            'image.mimes' => 'Not a valid image. Valid types include jpg/jpeg, gif, and png.'
        ];   
        
         
        $validator = Validator::make($request->all(), $rules, $messages);
            

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/listings/'. $listing->id . '/edit')
                ->withErrors($validator)
                ->withInput( $request->all());
        } 
        else if ( $request->hasFile('image') && !$request->file('image')->isValid() )
        {
          // sending back with error message.
          return Redirect::to('/listings/create')->with('error', 'uploaded file is not valid');
        }
        else {
            // store

            $listing->title = $this->profanityCheck($request->input('title'));
            $listing->description =  $this->profanityCheck($request->input('description'));
            $listing->category =  $request->input('category');
            $listing->price =  $request->input('price');

            
            if ($request->hasFile('image'))
            {
                $listing->image_content_type =  $request->file('image')->getMimeType();
                $listing->image_file_sizes =  $request->file('image')->getSize();

                //move to correct destination
                //$destinationPath = url( asset('/images/listings/'));
                $destinationPath = public_path('images/listings/');
                $thumbnailPath = public_path('images/thumbnails/');
                $mediumPath = public_path('images/medium/');
                $extension =  $request->file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = Str::random(10) . rand(11111,99999).'.'.$extension; // renaming image

               // $listing->image_file_name =   $request->file('image')->getClientOriginalName();
                $listing->image_file_name =  $fileName;


                $request->file('image')->move($destinationPath, $fileName);
                
                //make thumbnail
                Image::make($destinationPath . $fileName, array(
                    'width' => 100,
                    'height' => 100,
                ))->save($thumbnailPath . $fileName);

                //make medium size image for listing display
                Image::make($destinationPath . $fileName, array(
                    'width' => 500,
                    'height' => 500,
                ))->save($mediumPath . $fileName);

            }
            
            
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
        $listing = Listings::find($id);
        
        $destinationPath = public_path('images/listings/');
        
        $fileName =  $listing->image_file_name;

        $file = $destinationPath . $fileName;
        
        //also delete the image associated with listing
        File::delete($file);
                
        $listing->delete();

        return Redirect::to('/listings')->with('success', 'You have successfully deleted your listing!');

    }
    
    private function profanityCheck($str)
    {

        //$count = 0;
        
        $filterRegex = "(boogers|snot|poop|shucks|argh)";
        
        $search1 = '/(c|C)(u|U)(n|N)(t|T)/i';
        $search2 = '/(f|F)(u|U)(c|C)(k|K)/i';
        
        $replace = '$1*$3$4';
        

        // $str = preg_replace($search1, $replace, $str,  -1, $count);
         $str = preg_replace($search1, $replace, $str);
         $str = preg_replace($search2, $replace, $str);
         
         return $str;

    }
}
