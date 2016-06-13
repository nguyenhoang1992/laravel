<?php

namespace App\Http\Controllers;
use Request;
use Validator;
use Redirect;
use Auth;
use DB;
use Session;
use Cookie;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends BaseController {

    // 
    public function index() {
        // active: update tu 0 -> 1
        if(Request::has('active')){
            $array = Request::get('checkbox');
            DB::table('users')->whereIn('id', $array)->update(['active' => 1, 'updated_at' => date('Y-m-d H:i:s')]);
        }

        // delete: xoa tu 1 -> 0
        if(Request::has('delete')){
            $array = Request::get('checkbox');
            DB::table('users')->whereIn('id', $array)->update(['active' => 0, 'updated_at' => date('Y-m-d H:i:s')]);
        }
        // paginate: phan trang
        $list = DB::table('users')->orderBy('id', 'desc')->paginate(10);

        if(Request::has('search')){
            $keyword = Request::get('search');

            //2 => admin2
            //2 => 2admin
            //2 => ad2min
            // where $name like %text%
            $list = DB::table('users')->where('name', 'like', '%'.$keyword.'%')->orderBy('id', 'desc')->paginate(10);
        }

        return view("user.index", array('lists' => $list));
    }

    public function add() {
        if (Request::isMethod('POST')) {
            $data = Request::all();
            // thiet lap kiem tra thong tin submit
            $rules = array(
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8'
            );
            // kiem tra
            $validator = Validator::make($data, $rules);


            if ($validator->fails()){
                // loi => thong bao loi ra view
                return Redirect::to('/user/add')->withErrors($validator);
            }
            else {
                // thanh cong => insert vao db
                $newdata = array(
                    'name' => Request::get('name'),
                    'email' => Request::get('email'),
                    'password' => bcrypt(Request::get('password')),
                    'active' => Request::get('active'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                // upload file
                if (Request::hasFile('file')) {
                    $destinationPath = 'avatar';
                    $extension = Request::file('file')->getClientOriginalExtension();
                    // doi ten hinh anh
                    $fileName = time().'.'.$extension;
                    // thuc hien upload
                    Request::file('file')->move($destinationPath, $fileName);
                    $newdata['avatar'] = $fileName;
                }
                // thuc hien truy van
                $new = DB::table('users')->insert($newdata);
                if($new){
                    // thanh cong -> chuyen huong ve danh sach
                    return Redirect::to('/user');
                } else {
                    // loi -> bao loi
                    Session::flash('error', "Something wrong!"); 
                }
            }
        }

        return view("user.add");
    }

    public function edit($id) {
        
        if (Request::isMethod('POST')) {
            $data = Request::all();
            $rules = array(
                'name' => 'required',
                'email' => 'required|email'
            );
            $validator = Validator::make($data, $rules);

            if ($validator->fails()){
                return Redirect::to('/user/edit/'.$id)->withErrors($validator);
            }
            else {
                $newdata = array(
                    'name' => Request::get('name'),
                    'email' => Request::get('email'),
                    'active' => Request::get('active'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                if (Request::hasFile('file')) {
                    $destinationPath = 'avatar';
                    $extension = Request::file('file')->getClientOriginalExtension();
                    $fileName = time().'.'.$extension;
                    Request::file('file')->move($destinationPath, $fileName);
                    $newdata['avatar'] = $fileName;
                }
                $new = DB::table('users')->where('id', $id)->update($newdata);
                return Redirect::to('/user');
            }
        }

        // truy van id cua user
        $item = DB::table('users')->where('id', $id)->get();

        return view("user.edit", array('item' => $item[0]));
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
                return Redirect::to('/login');
            }
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('/login');
    }
}