<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpesa;

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
}
