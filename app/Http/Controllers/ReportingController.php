<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ReportingController extends Controller
{
    public function merchantLogin(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        return $request->input('email');
        
        // redirect('/')->with('success', 'message sent')
    }

    public function getTransactions(){
        
        $http = new Client([ 'verify' => false ]);

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
                'form_params' => [
                    'email' => 'demo@bumin.com.tr',
                    'password' => 'cjaiU8CV',
                ],
            ]);
        }catch(Exception $e){
              echo '<div class="alert alert-danger" role="alert">
              Please enter valid credentials.
              </div>';
              die;
        }
 
        $responseParameters =  json_decode((string) $response->getBody(), true);
        $token = $responseParameters["token"];
        
        if(isset($_GET["page"])){
            $pageNum = $_GET["page"];
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list?page='.$pageNum, [
                'form_params' => [
                    'fromDate' => '2013-07-01',
                    'toDate' => '2018-10-01',   
                    'page' => $pageNum,
                ],
                'headers' => [
                    'Authorization'     => $token,
                ]
            ]);
    
            $data =  json_decode((string) $response->getBody(), true);

        }else{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list', [
                'form_params' => [
                    'fromDate' => '2013-07-01',
                    'toDate' => '2018-10-01',
                ],
                'headers' => [
                    'Authorization'     => $token,
                ]
            ]);

            $data =  json_decode((string) $response->getBody(), true);

        }

        return view("transactions")->with('transactions', $data);
    }

    public function getTransactionDetail(){
        return 123;
    }

    public function getClientDetail(){
        return 456;
    }
}