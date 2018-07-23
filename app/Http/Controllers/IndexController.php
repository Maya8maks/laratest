<?php

namespace App\Http\Controllers;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Storage;
use App\SocialFacebookAccount;
use App\User;
use App\Doctor;
use App\DoctorNumber;
use App\Question;
use App\TempQuestion;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function main(Request $request)
    {

        if($request->isMethod('post'))
        {
            $input = $request->except('_token');
//            $arrayOfId = DB::select('select id from Doctor WHERE Doctor.role = \'doctor\'');
//            $randomDoctorID = array();
//            for($i=0; $i<count($arrayOfId); $i++){
//                $randomDoctorID[$i]= $arrayOfId[$i]->id;
//            }
//            $randomDoctor = array_random($randomDoctorID);
            $data =
                [   'question' =>$input['question'],
                    'description'=>$input['description'],
                    'email'=>$input['email'],
                    'user_id'=> null,
                    'date_add'=>Carbon::now()->format('Y-m-d H:i:s')
                ];
            $question = new TempQuestion();
            $question->fill($data)->save();
            if (Input::hasFile('file')) {
                if (Input::file('file')->isValid()) {
                    $file = Input::file('file');
                    $ext = $file->guessClientExtension();
                    if ($ext === 'pdf') {
                        $fileName = 'question' . '.pdf';

                        move_uploaded_file($_FILES['file']['tmp_name'], 'files/questions/' . $question->id . '.' . $fileName);
                    }
                    else{
                        return redirect()->back()->with('status', 'load pdf file');
                    }
                }

}
          if($question->fill($data)->save()) {

              return redirect()->back()->with('status', 'successful');
          }

        }
        else {
            return view('index');
        }
    }

    public function prepareToPay($question, $discription, $email){
        $tempQuestion = TempQuestion::where('question', $question)->where('description', $discription)->where('email', $email)->first();
        $data=[
            'question'=>$question,
            'discription'=>$discription,
            'email'=>$email,
            'id'=> $tempQuestion->id,
        ];
        return view('prepareToPay', $data);
    }

   public function editQuestion($question, $email){
        $tempQuestion= TempQuestion::where('question', $question)->where('email',$email)->get();

        /*$description = $tempQuestion[0]->description;*/
        TempQuestion::where('question', $question)->where('email',$email)->delete();
        $data = [
            'question'=>$question,
            'email'=>$email,
            /*'description'=>$description*/
        ];
        return view('index', $data);

    }


}
