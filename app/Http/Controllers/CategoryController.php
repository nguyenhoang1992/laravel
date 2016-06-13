<?php

namespace App\Http\Controllers;
use Request;
use Validator;
use DB;
use Redirect;

use Illuminate\Routing\Controller as BaseController;


class CategoryController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
    		
    	if(Request::has('active')){
    		$array = Request::get('checkbox');
    		DB::table('categories')->whereIn('id', $array)->update(['active' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
    	}
    	if(Request::has('delete')){
    		$array = Request::get('checkbox');
    		DB::table('categories')->whereIn('id', $array)->update(['active' => 0, 'updated_at' => date('Y-m-d H:i:s')]);
    	}
    	$list = DB::table('categories')->orderBy('id', 'desc')->paginate(10);
    	if(Request::has('search')){
    		$keyword = Request::get('search');
    		$list = DB::table('categories')->where('name', 'like', '%'.$keyword.'%')->orderBy('id', 'desc')->paginate(10);
    	}
		return view("category.index", array('lists' => $list));
    }

    public function add() {
    	if (Request::isMethod('POST')) {
	        $data = Request::all();
	        $rules = array(
	            'name' => 'required'
	        );
	        $validator = Validator::make($data, $rules);

	        if ($validator->fails()){
	            return Redirect::to('/category/add')->withErrors($validator);
	        }
	        else {
	            $newdata = array(
		            'name' => Request::get('name'),
		            'active' => Request::get('active'),
		            'created_at' => date('Y-m-d H:i:s'),
		            'updated_at' => date('Y-m-d H:i:s')
	            );
	            $new = DB::table('categories')->insert($newdata);
	            return Redirect::to('/category');
	        }
		}

		return view("category.add");
    }
    public function edit($id) {
    	if (Request::isMethod('POST')) {
	        $data = Request::all();
	        $rules = array(
	            'name' => 'required'
	        );
	        $validator = Validator::make($data, $rules);

	        if ($validator->fails()){
	            return Redirect::to('/category/edit/'.$id)->withErrors($validator);
	        }
	        else {
	            $newdata = array(
		            'name' => Request::get('name'),
		            'active' => Request::get('active'),
		            'updated_at' => date('Y-m-d H:i:s')
	            );
	            $new = DB::table('categories')->where('id', $id)->update($newdata);
	            return Redirect::to('/category');
	        }
		}


    	$item = DB::table('categories')->where('id', $id)->get();

		return view("category.edit", array('item' => $item[0]));
    }
}