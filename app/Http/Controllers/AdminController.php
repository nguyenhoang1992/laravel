<?php

namespace App\Http\Controllers;
use Request;
use DB;
use Validator;
use Redirect;
use Illuminate\Routing\Controller as BaseController;


class AdminController extends BaseController {

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        if(Request::has('active')){
            $array = Request::get('checkbox');
            DB::table('products')->whereIn('id', $array)->update(['active' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        }

        if(Request::has('delete')){
            $array = Request::get('checkbox');
            DB::table('products')->whereIn('id', $array)->update(['active' => 0, 'updated_at' => date('Y-m-d H:i:s')]);
        }
        $list = DB::table('products')->orderBy('id', 'desc')->paginate(10);

        if(Request::has('search')){
            $keyword = Request::get('search');
            $list = DB::table('products')->where('name', 'like', '%'.$keyword.'%')->orderBy('id', 'desc')->paginate(10);
        }

        return view("admin.index", array('items' => $list));
    }

    public function add() {
        if (Request::isMethod('POST')) {
            $data = Request::all();
            $rules = array(
                'name' => 'required',
                'category' => 'required',
                'price' => 'required'
            );
            $validator = Validator::make($data, $rules);
            if ($validator->fails()){
                return Redirect::to('/user/add')->withErrors($validator);
            }
            else {
                $newdata = array(
                    'name' => Request::get('name'),
                    'price' => Request::get('price'),
                    'category' => Request::get('category'),
                    'description' => Request::get('description'),
                    'active' => Request::get('active'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                if (Request::hasFile('file')) {
                    $destinationPath = 'product';
                    $extension = Request::file('file')->getClientOriginalExtension();
                    $fileName = time().'.'.$extension;
                    Request::file('file')->move($destinationPath, $fileName);
                    $newdata['image'] = $fileName;
                }
                $new = DB::table('products')->insert($newdata);
                if($new){
                    return Redirect::to('/');
                } else {
                    Session::flash('error', "Something wrong!"); 
                }
            }
        }
        $category = DB::table('categories')->get();
        return view("admin.add", array("categories" => $category));
    }

    public function edit($id) {
        
        if (Request::isMethod('POST')) {
            $data = Request::all();
            $rules = array(
                'name' => 'required',
                'category' => 'required',
                'price' => 'required'
            );
            $validator = Validator::make($data, $rules);

            if ($validator->fails()){
                return Redirect::to('/admin/edit/'.$id)->withErrors($validator);
            }
            else {
                $newdata = array(
                    'name' => Request::get('name'),
                    'price' => Request::get('price'),
                    'category' => Request::get('category'),
                    'description' => Request::get('description'),
                    'active' => Request::get('active'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                if (Request::hasFile('file')) {
                    $destinationPath = 'product';
                    $extension = Request::file('file')->getClientOriginalExtension();
                    $fileName = time().'.'.$extension;
                    Request::file('file')->move($destinationPath, $fileName);
                    $newdata['image'] = $fileName;
                }
                $new = DB::table('products')->where('id', $id)->update($newdata);
                return Redirect::to('/');
            }
        }

        $category = DB::table('categories')->get();
        $item = DB::table('products')->where('id', $id)->get();
        return view("admin.edit", array('item' => $item[0], 'categories' => $category));
    }

    public function login() {
        $data = Request::all();
        $remember_me = Request::input('remember_me');
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6',
            );
        $validator = Validator::make($data, $rules);

        if ($validator->fails()){
            return Redirect::to('/login')->withInput(Request::except('password'))->withErrors($validator);
        }
        else {
            $userdata = array(
                'email' => Request::get('email'),
                'password' => Request::get('password')
                );
            if (Auth::validate($userdata, $remember_me)) {
                if (Auth::attempt($userdata)) {
                    $ckname = Auth::getRecallerName();
                    Cookie::queue($ckname, Cookie::get($ckname), 43200);
                    return Redirect::intended('/');
                }
            } else {
                Session::flash('error', "User & password doesn't match"); 
                return Redirect::to('/');
            }
        }
    }

}