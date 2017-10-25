<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserController extends Controller {

    public function showusers() {


        return view('users');
    }
    
    public function showchangepassword() {
        
        return view('changepassword');
    }

    public function getUsers() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/users';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function saveUser(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/user';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        if ($request['role'] == "Supervisor") {
            $region = $request['region'];
        } else {
            $region = 0;
        }
        $dataArray = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'region' => $region,
            'role' => $request['role'],
            'password' => md5('123456'),
            'addedby' => session('userid')
        );

        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function updateUser(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/users';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'role' => $request['role'],
            'userid' => $request['userid']
        );

        try {

            $response = $client->request('PUT', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function deleteUser($userid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/users/' . $userid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('DELETE', $baseurl);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function userDetail($userid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/users/' . $userid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function changePassword(Request $request) {

        $password = $request['password'];

        $url = config('constants.TEST_URL');
        $baseurl = $url . '/changepassword';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token'),
                'code'=>$password
            ],
            'http_errors' => false
        ]);


        

        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function resetPassword($userid) {


        $url = config('constants.TEST_URL');
        $baseurl = $url .'/reset/' . $userid;



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);




        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function sendemail($receiver, $message) {
        
    }

}
