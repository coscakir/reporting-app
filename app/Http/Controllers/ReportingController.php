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
        $email = $request->input('email');
        $password = $request->input('password');

        // redirect('/')->with('success', 'message sent')
                
        $http = new Client([ 'verify' => false ]);

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
                'form_params' => [
                    'email' => $email,
                    'password' => $password,
                ]
            ]);
        }catch(\Exception $e){
            return redirect("/")->withErrors(['Please enter valid credentials.']);
        }
 
        $responseParameters =  json_decode((string) $response->getBody(), true);
        $token = $responseParameters["token"];    
        
        return $token;

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
        }catch(\Exception $e){
            return redirect("/")->withErrors(['Please enter valid credentials.']);
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
        $http = new Client([ 'verify' => false ]);

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
                'form_params' => [
                    'email' => 'demo@bumin.com.tr',
                    'password' => 'cjaiU8CV',
                ],
            ]);
        }catch(\Exception $e){
            return redirect("/transaction")->withErrors(['Please enter valid credentials.']);
        }

        $responseParameters =  json_decode((string) $response->getBody(), true);
        $token = $responseParameters["token"];

        $transactionId = $_GET["transactionId"];

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction', [
                'form_params' => [
                    'transactionId' => $transactionId,
                ],
                'headers' => [
                    'Authorization'     => $token,
                ]
            ]);

        }catch(\Exception $e){
            return redirect("/transaction")->withErrors(['Please enter a valid transaction ID.']);
        }

        $data =  json_decode((string) $response->getBody(), true);

       

        return view("transaction")->with('transaction', $data);
    }

    public function getClientDetail(){
        $http = new Client([ 'verify' => false ]);

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
                'form_params' => [
                    'email' => 'demo@bumin.com.tr',
                    'password' => 'cjaiU8CV',
                ],
            ]);
        }catch(\Exception $e){
            return redirect("/transaction")->withErrors(['Please enter valid credentials.']);
        }

        $responseParameters =  json_decode((string) $response->getBody(), true);
        $token = $responseParameters["token"];

        $transactionId = $_GET["transactionId"];

        try{
            $response = $http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/client', [
                'form_params' => [
                    'transactionId' => $transactionId,
                ],
                'headers' => [
                    'Authorization'     => $token,
                ]
            ]);

        }catch(\Exception $e){
            return redirect("/transaction")->withErrors(['Please enter a valid transaction ID.']);
        }

        $data =  json_decode((string) $response->getBody(), true);

        return view("client")->with('client', $data);

    }
}