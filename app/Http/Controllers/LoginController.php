<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {

    public function authenticateuser(Request $request) {

        // $data = $request->all(); // This will get all the request data.
        $username = $request['email'];
        $password = $request['password'];


        return $this->userAuthentication($username, $password);
    }

    public function userAuthentication($username, $password) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/authenticate';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);

        $dataArray = array(
            'email' => $username,
            'password' => $password
        );
        
      
        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();
            $bodyObj = json_decode($body);


            if ($response->getStatusCode() == 200) {

                $status = $bodyObj->status;

                if ($status == 0) {
//
                    session(['email' => $username]);
                    session(['name' => $bodyObj->details->name]);
                    session(['userid' => $bodyObj->details->userid]);
                    session(['lastlogin' => $bodyObj->details->lastlogin]);
                    session(['token' => $bodyObj->details->token]);
                    session(['role' => $bodyObj->details->role]);
                    return 'success';
                } else {
                    //   return Redirect::back()->withErrors(['msg',  $bodyObj->message]);
                    return $bodyObj->message;
                    //return redirect('login')->with('message', $bodyObj->message);
                }
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
