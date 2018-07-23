<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\User;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $doctors = $doctors = User::all()->where('role','doctor');
        $data=[
            'orderByName' => 'nameF',
            'orderByDay' => 'date_add',
            'doctors' => $doctors,
        ];
        return view('admin_index',$data);
    }

    public function orders(){
        $doctors = User::all()->where('role','doctor');
        $data=[
            'doctors' => $doctors,
        ];
        return view('admin_orders',$data);
    }

    public function createAccount(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = [
                'name' => $request['name'],
                'lastname' => $request['lastName'],
                'user_name' => $request['user_name'],
                'country' => $request['country'],
                'profession' => $request['profession'],
                'password' => Hash::make($request['password']),
                'role' => 'doctor',
            ];
            $doctor = new User();
            $doctor->fill($data)->save();

                if (Input::file('image')->isValid()) {
                    $file = Input::file('image');
                    $ext = $file->guessClientExtension();
                    $name = 'avatar.' . $ext;
                    $file->storeAs('/public/doctor/' . $doctor->id, $name);
                    $doctor->img = $name;
                    $doctor->update();
                }

                return redirect()->back();

            } elseif ($request->isMethod('get')) {
                return view('admin_account');

            } else {
                return redirect()->back();
            }
        }

    public function dashboardOrderBy($orderBy)
    {
        if($orderBy == "name") {
            $doctors = User::orderBy($orderBy)->get();
            $data = [
                'doctors' => $doctors
            ];
            return view('admin_index',$data);
        }elseif($orderBy == "date_add"){
            $questions = Question::orderBy($orderBy)->get();
            $data = [
                'questions'=> $questions
            ];
            return view('admin_index',$data);
        }else{
            redirect()->route('main');
        }
    }

    public function orderOrderBy($orderBy)
    {
        if($orderBy == "name") {
            $doctors = User::orderBy($orderBy)->get();
            $data = [
                'doctors' => $doctors
            ];
            return view('admin_orders',$data);
        }elseif($orderBy == "date_finish"){
            $questions = Question::orderBy($orderBy)->get();
            $data = [
                'questions'=> $questions
            ];
            return view('admin_orders',$data);
        }else{
            redirect()->route('main');
        }
    }

}
