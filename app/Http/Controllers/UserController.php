<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Doctor;
use App\User;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Auth;


class UserController extends Controller
{
    public function dashboard(Request $request, $id)
    {
        if($request->isMethod('post'))
        {

        }else {
            $doctor = User::find($id);
            $data = [
                'doctor' => $doctor,
                'currentTime' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            return view('doctor_index', $data);
        }
    }

    public function answer(Request $request, $doctor_id, $question_id)
    {
        if($request->isMethod('post'))
        {
            $input = $request->except('_token');
            $question = Question::find($question_id);
            $doctor = Doctor::find($doctor_id);
            $emailInput =[
                'question_id'=>$question_id,
                'answer'=>$input['text'],
                'question'=>$question->question,
                'doctor_name'=>$doctor->name,
                'doctor_lastName'=>$doctor->lastname,
            ];
            Mail::send('email.email', ['data'=>$emailInput], function($message) use ($question){
                $message->to($question->user_email,"")->subject('Answer from Peppling');
                $message->from('kruhlov.aleksandr@gmail.com', 'Peppling');
            });
            if (Mail::failures()) {
                redirect()->back();
            }
            $question->status = true;
            $question->date_finish = Carbon::now()->format('Y-m-d H:i:s');
            $question->update();

            $data =[
                'question_id'=>$question_id,
                'answer'=>$input['text'],
            ];
            $answer = new Answer();
            $answer->fill($data)->save();
            return redirect()->route('dashboard',array('id'=>$doctor_id));
        }else{
            redirect()->back();
        }
    }

    public function orders($id){
        $doctor = User::find($id);
        $data=[
          'doctor'=>$doctor
        ];
        return view('doctor_orders', $data);
    }

    public function account(Request $request, $id){
        if($request->isMethod('post'))
        {
            $input = $request->except('_token');
            $doctor = User::find($id);
            $data=[
              'name'=>$input['name'],
              'lastname'=>$input['lastName'],
              'country'=>$input['country'],
              'user_name'=>$input['userName'],
              'profession'=>$input['profession'],
            ];
            $doctor->fill($data)->update();
            return redirect()->back();
        }else{
            $doctor = User::find($id);
            $data = [
                'doctor' => $doctor
            ];
            return view('doctor_account', $data);
        }
    }

    public function login(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('auth.login');

        }
        elseif ($request->isMethod('post'))
        {
            $input = $request->except('_token');
            $rules = array(
                'userName' => 'required|min:3',
                'password' => 'required|min:5'
            );
           $validator = Validator::make($input, $rules);
            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator);
            } else {
                $userdata = array(
                    'user_name' => $input['userName'],
                    'password'  => $input['password']
                );

                if (Auth::attempt($userdata)) {

                    $user = Auth::user();
                    if($user->role == "doctor")
                    {
                        return redirect('/'.Auth::id().'/dashboard');
                    }elseif ($user->role == "admin")
                    {
                        return redirect('/admin');
                    }else {
                        return redirect('/');
                    }
                }else{
                    return redirect()->back()->withErrors('bedUser','bed user name or password');
                }
            }

        }else{
            return redirect('main');
        }
    }

    public function loguot(){
        Auth::logout();
        return redirect()->route('main');
    }
}
