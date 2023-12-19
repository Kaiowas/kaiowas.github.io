<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    private $endpoint = "https://randomuser.me/api/";
    private $params = ['results'=>5,'noinfo'=>true,'inc'=>'name,gender,nat'];

    public function initRequest(Request $request){
        $newRequest = $this->params;

        if ($request->results) {
            $newRequest['results'] = $request->results;
        }

        $sendApiData = $this->sendApiData($newRequest);

        return response()->json($sendApiData);
    }

    public function sendApiData($params=null){
        $body = $params??$this->params;

        $response = Http::acceptJson()->connectTimeout(3)->get($this->endpoint, $body)->json();

        return $response;
    }
}
