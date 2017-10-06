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

        return view('report');
    }

    public function spoolresult(Request $request) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/queryresults';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        $date = "'" . $request['daterange'] . "'";

        $daterange = explode('-', $date);
        $start_date = substr($daterange[0], 1);
        $end_date = substr($daterange[1], 0, -1);

        $new_start_date = date("Y-m-d", strtotime($start_date));
        $new_end_date = date("Y-m-d", strtotime($end_date));

        $dataArray = array(
            'toll' => $request['tollpoints'],
            'category' => $request['categories'],
            'cashier' => $request['cashiers'],
            'region' => $request['regions'],
            'district' => $request['districts'],
            'startdate' => $new_start_date,
            'enddate' => $new_end_date
        );


        try {

            $response = $client->request('POST', $baseurl, ['json' => $dataArray, 'verify' => false]);

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
