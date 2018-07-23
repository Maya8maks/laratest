<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\AdaptivePayments;
use Srmklive\PayPal\Services\ExpressCheckout;
use PayPal;
use App\TempQuestion;
use App\User;
use App\Question;
use Carbon\Carbon;

class PaypalController extends Controller
{
//    public function paypal(Request $request)
//    {
//        $provider = new AdaptivePayments();
//        $tempQuestion = TempQuestion::where('question', $_POST['question'])->where('email',$_POST['email'])->where('description',$_POST['description'])->get();
//        $tempQuestion_id = $tempQuestion[0]->id;
//        $paypal_doctor_email = User::where('id',$tempQuestion[0]->user_id)->get();
//        $data = [
//            'receivers'  => [
//                [
//                    'email' => 'kruhlov_1-facilitator@ukr.net',
//                    'amount' => 15,
//                    'primary' => true,
//                ],
//                [
//                    'email' => $paypal_doctor_email[0]->paypal_email,
//                    'amount' => 5,
//                    'primary' => false,
//                ],
//            ],
//            'payer' => 'EACHRECEIVER',
//            'return_url' => url('http://laratest.galactika-it.ru/'),
//            'cancel_url' => url('http://laratest.galactika-it.ru/'),
//        ];
//        $data1 = [
//                0 =>[
//                    'email' => 'kruhlov_1-facilitator@ukr.net',
//                    'invoice_data'=>Carbon::now()->format('Y-m-d H:i:s'),
//                    'description'=>$tempQuestion_id
//                ]
//            ];
//        $response = $provider->createPayRequest($data);
//        $provider->setPaymentOptions($response['payKey'], $data1);
//        $redirect_url = $provider->getRedirectUrl('approved', $response['payKey']);
//        return redirect($redirect_url);
//    }

    public function paypal(Request $request)
    {
        if ($_GET['amt'] == 15 and isset($_GET['cm']) and $_GET['st'] == 'Completed' and isset($_GET['tx'])) {
            $tempQuestion = TempQuestion::find($_GET['cm']);
            $question = new Question();
            $question->question = $tempQuestion->question;
            $question->description = $tempQuestion->description;
            $question->user_email = $tempQuestion->email;
            $question->user_id = $tempQuestion->user_id;
            $question->status = 0;
            $question->txn_id = $_GET['tx'];
            $question->date_add = $tempQuestion->date_add;
            $question->save();
            $tempQuestion->delete();
            return redirect()->route('main')->withInput()->withErrors(['success' => 'success']);
        }else{
            return redirect()->back();
        }
    }
}
