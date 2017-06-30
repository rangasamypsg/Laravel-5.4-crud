<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Registration;
use App\Country;
use App\State;
use App\City;
use App\Language;
use App\Education;
use Config;
use Mail;
use Auth;
use DB;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {		
		$keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $registrations = Registration::where('name', 'LIKE', "%$keyword%")
				//->orWhere('content', 'LIKE', "%$keyword%")
				//->orWhere('category', 'LIKE', "%$keyword%")
				->paginate($perPage);
        } else {
            $registrations = Registration::paginate($perPage);
        }

        return view('Registration.index',compact('registrations')); 
		
		/*
		 $input = $request->all();

        if($request->get('search')){
            $registrations = Registration::where("name", "LIKE", "%{$request->get('search')}%")
					 ->paginate(5);      
        }else{
		  $registrations = Registration::paginate(5);
        }

        return view('Registration.index',compact('registrations'));  */		
	   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
	
		$countrys = Country::orderBy('id','ASC')->get();
		$language_knowns = Language::orderBy('id','ASC')->get();
		$educations = Education::orderBy('id','ASC')->get();
		/* echo "<pre>";
		print_r($countrys); exit; */
		return view('Registration.create',compact('countrys','language_knowns','educations')); 
		 
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

	public function store(Request $request){
	
		$input = $request->all();
		
		/* echo "<pre>";
		print_r($input);
		exit; */
		
		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name' => 'required',
			'email' => 'required|email|max:255|unique:registrations',	
			'profile_image' => 'required|image|mimes:png,jpg',
			'country' => 'required',
			'state' => 'required',
			'city' => 'required',
			'sex' => 'required',
			'education' => 'required',
			'language_known' => 'required',
        );
		
         // run the validation rules on the inputs from the form
         $validator = Validator::make($input, $rules);

         // if the validator fails, redirect back to the form
         if ($validator->fails()) {
		 
			//echo "<pre>";
			//print_r($validator); exit;
		 
             // If validation falis redirect back to login.
              return redirect()->back()
                              ->withInput()
                              ->with('errors',$validator->errors()); 
			 
         } else {
			
			$image = $request->file('profile_image');
			$input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/images');
			$image->move($destinationPath, $input['profile_image']);
			
			$register = new Registration();
			$register->name = $input['name'];
            $register->email = $input['email'];
			$register->profile_image = $input['profile_image'];
			$register->country = $input['country'];
			$register->state = $input['state'];
			$register->city = $input['city'];
			$register->state = 1;
			$register->city = 1;
			$register->sex = $input['sex'];
			$register->education = $input['education'];
			$register->languages_known = implode(",",$input['language_known']);
            $register->save();
				
			return redirect()->route('Registration.index')
                        ->with('success','Registration created successfully');		
		 }
	}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id) {

        $register = Registration::find($id);
        return view('Registration.show',compact('register'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){

        $countrys = Country::orderBy('id','ASC')->get();
		$language_knowns = Language::orderBy('id','ASC')->get();
		$educations = Education::orderBy('id','ASC')->get();
		$register = Registration::find($id);
		//echo "<pre>";
		//print_r($register); exit; 
		
        return view('Registration.edit',compact('register','countrys','language_knowns','educations'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id){

		$input = $request->all();
		
		// validate
        $rules = array(
            'name' => 'required',
			'email' => 'required|email|unique:registrations,email,'. $id,
			'profile_image' => 'required | mimes:jpeg,jpg,png',
			'country' => 'required',
			'state' => 'required',
			'city' => 'required',
			'sex' => 'required',
			'education' => 'required',
			'language_known' => 'required',
        );
		
         // run the validation rules on the inputs from the form
         $validator = Validator::make($input, $rules);

         // if the validator fails, redirect back to the form
         if ($validator->fails()) {
             // If validation falis redirect back to login.
              return redirect()->back()
                              ->withInput()
                              ->with('errors',$validator->errors()); 
				/* return Redirect::to('register/'.$id.'/edit')
						->withErrors($validator)
						->withInput(); */

         } else {
			
			
			$image = $request->file('profile_image');
			$input['profile_image'] = time().'.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/images');
			$image->move($destinationPath, $input['profile_image']);
						
			$register = Registration::find($id);
			$register->name = $input['name'];
            $register->email = $input['email'];
			$register->profile_image = $input['profile_image'];
			$register->country = $input['country'];
			$register->state = $input['state'];
			$register->city = $input['city'];
			$register->sex = $input['sex'];
			$register->education = $input['education'];
			$register->languages_known = implode(",",$input['language_known']);
            $register->save();
				
			return redirect()->route('Registration.index')
                        ->with('success','Record updated successfully');
				
		 }
    
	}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id){

        Registration::find($id)->delete();
        return redirect()->route('Registration.index')
                        ->with('success','Record deleted successfully');
    }
   

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	public function getStateList(Request $request){
		if($request->ajax()) {
			$input = $request->all();
			$countryId = $input['country_id'];
			$state = DB::table('states')->where('country_id',$countryId)->pluck("name","id")->all();			
			return json_encode($state);
        }
	}
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

	public function getCityList(Request $request){
		
		if($request->ajax()) {
			$input = $request->all();
			$stateId = $input['state_id'];
			$city = DB::table('cities')->where('state_id',$stateId)->pluck("name","id")->all();		
			return json_encode($city);
        }
	}
}
