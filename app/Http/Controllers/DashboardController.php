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

class DashboardController extends Controller {

    public function showdashboard() {

        $tollreports = $this->reportsontollpoints();
        $regionreports = $this->reportsonregions();
        $summation = $this->summationofresults();

        return view('dashboard')->with('reports', $tollreports)
                        ->with('regionsreport', $regionreports)
                        ->with('summation', $summation);
    }

    public function reportsontollpoints() {



        $url = config('constants.TEST_URL');

        $baseurl = $url . '/tolltransactions';

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
            $bodyObj = json_decode($body, true);

            if ($response->getStatusCode() == 200) {

                return $bodyObj['data'];
            }

            
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function reportsonregions() {



        $url = config('constants.TEST_URL');

        $baseurl = $url . '/regiontransactions';

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
            $bodyObj = json_decode($body, true);

            if ($response->getStatusCode() == 200) {

                return $bodyObj['data'];
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function summationofresults() {



        $url = config('constants.TEST_URL');

        $baseurl = $url . '/cummulative';

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
            $bodyObj = json_decode($body, true);

            if ($response->getStatusCode() == 200) {

                return $bodyObj['data'];
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
