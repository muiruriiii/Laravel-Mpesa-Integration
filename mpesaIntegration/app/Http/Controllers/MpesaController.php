<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpesa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class MpesaController extends Controller
{
//STK Push Simulation
    public function stkSimulation()
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();
        $BusinessShortCode=174379;
        $LipaNaMpesaPasskey="";
        $TransactionType="CustomerPayBillOnline";
        $Amount="1";
        $PartyA="";
        $PartyB="174379";
        $PhoneNumber="";
        $CallBackURL="https://muiruri.com";
        $AccountReference="Testing for TMS";
        $TransactionDesc="Lipa na Mpesa ";
        $Remarks="Payment Successful";

        $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );
        dd($stkPushSimulation);
    }
//C2B Simulation
    public function LipaNaMpesaPassword()
    {
        $timestamp = Carbon::rawParse('now')->format('YmdHms');
        $passKey = "";
        $businessShortCode = 174379;
        //password=concatenate passkey,timestamp and shortcode
        $mpesaPassword = base64_encode($businessShortCode.$passKey.$timestamp);

        return $mpesaPassword;
    }
    public function newAccessToken()
    {
        $consumer_key="";
        $consumer_secret="";
        $credentials = base64_encode($consumer_key.":".$consumer_secret);
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($curl);
        $access_token=json_decode($curl_response);
        curl_close($curl);

        return $access_token->access_token;
    }
    public function stkPush(Request $request)
    {
        $user = $request->user;
        $amount = $request->amount;
        $phone =  $request->phone;
        $formatedPhone = substr($phone, 1);
        $code = "254";
        $phoneNumber = $code.$formatedPhone;

        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl_post_data = [
        'BusinessShortCode' =>174379,
        'Password' => $this->LipaNaMpesaPassword(),
        'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => 1,
        'PartyA' => ,
        'PartyB' => 174379,
        'PhoneNumber' => ,
        'CallBackURL' => 'https://muiruri.com',
        'AccountReference' => "TMS Tester Payment",
        'TransactionDesc' => "Lipa Na M-PESA"
        ];

        $data_string = json_encode($curl_post_data);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->newAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        return redirect('/confirm');

    }


}
