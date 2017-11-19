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
use Session;

class ConfigurationController extends Controller {

    public function showcategory() {

        return view('category');
    }

    public function showtollpoint() {

        return view('tollpoint');
    }

    public function showcashier() {

        return view('cashier');
    }

    public function showdistrict() {

        return view('districts');
    }

    public function showcategories() {
        return view('categories');
    }

    public function showcashiers() {
        return view('cashiers');
    }

    public function showtollpoints() {
        return view('tollpoints');
    }

    public function saveCategory(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/category';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'url' => $request['url'],
            'price' => $request['price'],
            'description' => $request['description'],
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

    public function getTollpoints() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/tollpoints';

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

    public function getRegions() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/regions';

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

    public function getDistricts() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/districts';

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

    public function getCashiers() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/cashiers';

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

    public function getCategories() {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories';



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
            // $bodyObj = json_decode($body);


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

//saveCashier
    public function saveCashier(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/cashier';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'contact' => $request['contact'],
            'email' => $request['email'],
            'toll' => $request['toll'],
            'addedby' => session('userid')
        );

        // return json_encode($dataArray);
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

    public function saveToll(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/tollpoint';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'region' => $request['region'],
            'area' => $request['area'],
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

    public function getRegionDistricts($regionid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/regiondistricts/' . $regionid;



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
            // $bodyObj = json_decode($body);


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

    public function getCategoryInformation($id) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/category/' . $id;

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

    public function updateCategory(Request $request) {

        $url = config('constants.TEST_URL');
        $baseurl = $url . '/category';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'url' => $request['url'],
            'price' => $request['price'],
            'description' => $request['description'],
            'categoryid' => $request['categoryid']
        );

        // return   json_encode($dataArray);

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

    public function deleteCategory($id) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/category/' . $id;

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

    public function getTollInformation($id) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/toll/' . $id;

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

    public function updateToll(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/toll';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'region' => $request['region'],
            'area' => $request['area'],
            'toll' => $request['tollid']
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

    public function deleteToll($id) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/toll/' . $id;

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

    public function getCashierInformation($id) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/cashier/' . $id;

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

    public function updateCashier(Request $request) {


        $url = config('constants.TEST_URL');
        $baseurl = $url . '/cashier';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'contact' => $request['contact'],
            'email' => $request['email'],
            'toll' => $request['toll'],
            'cashier' => $request['cashierid']
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

    public function deleteCashier($id) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/cashier/' . $id;

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

    public function redirectUrl() {
        return redirect()->route('/logout');
    }

    public function getRegionCashiers($ids) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/districtscashiers/' . $ids;



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
            // $bodyObj = json_decode($body);


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

    public function getTollCashiers($ids) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/tollcashiers/' . $ids;



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
            // $bodyObj = json_decode($body);


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

    public function getRegionTolls($ids) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/regiontolls/' . $ids;



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
            // $bodyObj = json_decode($body);


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

    public function is_connected() {

        $connected = @fsockopen("www.example.com", 80);
        //website, port  (try 80 or 443)
        if ($connected) {
            $is_conn = "true"; //action when connected
            fclose($connected);
        } else {
            $is_conn = "false"; //action in connection failure
        }
        return "true";
    }

    public function tokenvalidity() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/regions';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

           // $body = $response->getBody();
           
            return $response->getStatusCode();
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }
    
    public function resetPassword($cashierid) {


        $url = config('constants.TEST_URL');
        $baseurl = $url .'/cashiers/reset/' . $cashierid;



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


}

//saveToll

 