<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ReportingController extends Controller
{
    public $http;
    public $fromDate;
    public $toDate;
    public $tokenMin;

    public function __construct(){
        $this->http = new Client([ 'verify' => false ]);
        $this->fromDate = '2013-07-01';
        $this->toDate = '2018-10-01';
        $this->tokenMin = 10;
    }

    public function merchantLogin(Request $request){
        
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $email = $request->input('email');
        $password = $request->input('password');

        try{

            $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login', [
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
        
        $tokenCookie = cookie('token', $token, $this->tokenMin);
        
        return redirect('dashboard')->cookie($tokenCookie);
    }

    public function merchantLogout(){
        \Cookie::queue(\Cookie::forget('token'));
        return redirect("/");
    }

    public function getDashboardData(){

        $token = \Cookie::get('token');

        if(isset($token)){
            
            try{
                $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report', [
                    'form_params' => [
                        'fromDate' => $this->fromDate,
                        'toDate' => $this->toDate,   
                    ],
                    'headers' => [
                        'Authorization'     => $token,
                    ]
                ]);

            }catch(\Exception $e){
                return redirect("/dashboard")->withErrors(['Whoops, looks like something went wrong.']);
            }

            $data =  json_decode((string) $response->getBody(), true);

        }else{
            return redirect("/")->withErrors(['The Token has expired. Please login again.']);
        }

        return view("dashboard")->with('data', $data);

    }

    public function getTransactions(){
      
        $token = \Cookie::get('token');

        if(isset($token)){
            
            if(isset($_GET["page"])){
                
                $pageNum = $_GET["page"];
               
                $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list?page='.$pageNum, [
                    'form_params' => [
                        'fromDate' => $this->fromDate,
                        'toDate' => $this->toDate,    
                        'page' => $pageNum,
                    ],
                    'headers' => [
                        'Authorization'     => $token,
                    ]
                ]);
        
                $data =  json_decode((string) $response->getBody(), true);

            }else{
                $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list', [
                    'form_params' => [
                        'fromDate' => $this->fromDate,
                        'toDate' => $this->toDate,   
                    ],
                    'headers' => [
                        'Authorization'     => $token,
                    ]
                ]);

                $data =  json_decode((string) $response->getBody(), true);

            }

        }else{
            return redirect("/")->withErrors(['The Token has expired. Please login again.']);
        }

        return view("transactions")->with('transactions', $data);
    }

    public function getTransactionDetail(){

        $token = \Cookie::get('token');

        if(isset($token)){

            $transactionId = $_GET["transactionId"];
            
            try{
                $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction', [
                    'form_params' => [
                        'transactionId' => $transactionId,
                    ],
                    'headers' => [
                        'Authorization'     => $token,
                    ]
                ]);

            }catch(\Exception $e){
                return redirect("/transactions")->withErrors(['Please enter a valid transaction ID.']);
            }

            $data =  json_decode((string) $response->getBody(), true);

        }else{
            return redirect("/")->withErrors(['The Token has expired. Please login again.']);
        }

        return view("transaction")->with('transaction', $data);
    }

    public function getClientDetail(){

        $token = \Cookie::get('token');

        if(isset($token)){

            $transactionId = $_GET["transactionId"];

            try{
                $response = $this->http->post('https://sandbox-reporting.rpdpymnt.com/api/v3/client', [
                    'form_params' => [
                        'transactionId' => $transactionId,
                    ],
                    'headers' => [
                        'Authorization'     => $token,
                    ]
                ]);

            }catch(\Exception $e){
                return redirect("/transactions")->withErrors(['Please enter a valid transaction ID.']);
            }

            $data =  json_decode((string) $response->getBody(), true);
        }else{
            return redirect("/")->withErrors(['The Token has expired. Please login again.']);
        }

        return view("client")->with('client', $data);

    }
}