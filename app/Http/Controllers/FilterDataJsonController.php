<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterDataJsonController extends Controller
{
    public function filterdatajson()
    {
    $url = 'https://gist.githubusercontent.com/Loetfi/fe38a350deeebeb6a92526f6762bd719/raw/9899cf13cc58adac0a65de91642f87c63979960d/filter-data.json';
    // dd(dirname(_FILE_));
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    // common description bellow
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, (120));
    $response = curl_exec($ch);
    // dd($response);
    $header = curl_getinfo($ch);
    // 200? 404? or something?
    $error_no = curl_errno($ch);
    $error = curl_error($ch);
    $coderespon = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $data['data'] = json_decode($response, true);
    $data['code'] = $coderespon;

    $array = [];
    $array2 = [];
    $array3 = [];
    foreach ($data['data']['data']['response']['billdetails'] as $key => $value){
        $array[$key] = preg_replace('/[^0-9]/', '', @$value['body'][0]);
    }
    foreach ($array as $kunci => $val){
        $array2[$kunci] = intval($val);
        if($array2[$kunci] >= 100000){
            $array3[$kunci] = intval($val);
        }
    }
    dd(array_values($array3));
    return $data;
    }
}
