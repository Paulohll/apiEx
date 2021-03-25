<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\APIResponse;


class StackExchangeController extends Controller
{

    public function getQuestions($tagged, $fromdate, $todate)
    {

      
        $client = new Client();
        $url = "https://api.stackexchange.com/2.2/questions";


        $query = [
        ];

        if (!is_null($fromdate)) {
            // $query['fromdate'] = strtotime($fromdate);
            $query['fromdate'] = $fromdate;
        }
        //validaciones null &  ¿formato fecha correcto?
        if (!is_null($todate)) {
            $query['todate'] = $todate;
        }

        $query['site'] = 'stackoverflow';
        $query['order'] = 'desc';
        $query['sort'] = 'activity';
        $query['tagged'] = $tagged;

        $params = [
            'query' => $query,
        ];

       

        $response = $client->request('GET', $url, $params);


        return json_decode($response->getBody(), JSON_OBJECT_AS_ARRAY);
    
    }
}
