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
        $LipaNaMpesaPasskey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType="CustomerPayBillOnline";
        $Amount="1";
        $PartyA="254725038602";
        $PartyB="174379";
        $PhoneNumber="254725038602";
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
