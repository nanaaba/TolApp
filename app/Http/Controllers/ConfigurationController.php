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
                'Accept' => 'application/json'
            ],
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'url' => $request['url'],
            'price' => $request['price'],
            'description' => $request['description'],
            'addedby' => 1
        );

        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);

        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            // $bodyObj = json_decode($body);


            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);

        $dataArray = array(
            'name' => $request['name'],
            'contact' => $request['contact'],
            'email' => $request['email'],
            'toll' => $request['toll'],
            'username' => $request['username'],
            'password' => md5('123456'),
            'addedby' => 1
        );

        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
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
                'Accept' => 'application/json'
            ],
        ]);

        $dataArray = array(
            'name' => $request['region'],
            'contact' => $request['district'],
            'email' => $request['area'],            
            'addedby' => 1
        );

        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }
    
    public function getRegionDistricts($regionid) {
        
        
        $url = config('constants.TEST_URL');

        $baseurl = $url.'/regiondistricts/'.$regionid;



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);

        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            // $bodyObj = json_decode($body);


            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}

//saveToll

 