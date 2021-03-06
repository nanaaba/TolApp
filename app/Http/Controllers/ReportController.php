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

class ReportController extends Controller {

    public function showreport() {

        return view('generalreport');
    }

    public function showyearlyreport() {

        return view('yearlyreport');
    }

    public function showmonthlyreport() {

        return view('monthlyreport');
    }

    public function showdailyreport() {
        return view('daywisereport');
    }

    public function showshiftreport() {

        return view('shiftwisereport');
    }

    public function showendofshift() {

        return view('endofshift');
    }

    public function showcollectorsreport() {

        return view('collectorsreport');
    }

    public function endofshiftreport(Request $request) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/endofshift';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'date' => $request['shiftdate'],
            'cashier' => $request['cashiers'],
            'shift' => $request['shift']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function spoolresult(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/generalreport';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'toll' => $request['tollpoints'],
            'category' => $request['categories'],
            'cashier' => $request['cashiers'],
            'region' => $request['regions'],
            'district' => $request['districts'],
            'shift' => $request['shift'],
            'startdate' => $request['start_date'],
            'enddate' => $request['end_date']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function daywisereport(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/daywisereport';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'toll' => $request['tollpoints'],
            'startdate' => $request['start_date'],
            'enddate' => $request['end_date']
        );


        // return json_encode($dataArray);
        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function monthlyreport(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/monthlywisereport';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'toll' => $request['toll'],
            'month' => $request['month'],
            'year' => $request['year']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function yearlyreport(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/yearlyreport';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);

        $dataArray = array(
            'toll' => $request['toll'],
            'year' => $request['year']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function shiftreport(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/shiftreport';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);


        $dataArray = array(
            'toll' => $request['toll'],
            'shift' => $request['shift'],
            'startdate' => $request['start_date'],
            'enddate' => $request['end_date']
        );

        

        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function weeklyReports(Request $request) {

        $type = $request['type'];
        $value = $request['value'];

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/weeklyreport/' . $type . '/' . $value;

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
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function monthlyReports(Request $request) {

        $type = $request['type'];
        $value = $request['value'];


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/monthlyreport/' . $type . '/' . $value;

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
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function yearlyReports(Request $request) {

        $type = $request['type'];
        $value = $request['value'];


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/yearlyreport/' . $type . '/' . $value;

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
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function customPerfromanceAnalysis(Request $request) {



        $url = config('constants.TEST_URL');

        $baseurl = $url . '/customperformance';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);
        $date = "'" . $request['daterange'] . "'";


        $dataArray = array(
            'toll' => $request['tollpoints'],
            'reportlevel' => $request['reportlevel'],
            'cashier' => $request['cashiers'],
            'region' => $request['regions'],
            'shift' => $request['shift'],
            'startdate' => $request['start_date'],
            'enddate' => $request['end_date']
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

    public function customTrendAnalysis(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/customtrend';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'token' => session('token')
            ],
            'http_errors' => false
        ]);


        $dataArray = array(
            'reporttype' => $request['reporttype'],
            'value' => $request['value'],
            'startdate' => $request['start_date'],
            'enddate' => $request['end_date']
        );

        //return json_encode($dataArray);
        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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

}
