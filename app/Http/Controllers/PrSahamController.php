<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;



class PrSahamController extends Controller
{
    private $host = "https://yproxy.vercel.app/";

    public function cashflow($symbol){
        $symbol = strtoupper($symbol);
        $response = Http::get($this->host.'cash/'.$symbol);
        $data = $response->json()['data'];
        echo "<table border=\"1\" width=\"900\">";
        foreach($data as $record){
            echo "<tr>";
            echo "<td>".$record['symbol']."</td>";
            echo "<td>".$record['currencyCode']."</td>";
            echo "<td>".$record['periodType']."</td>";
            echo "<td>".$record['FreeCashFlow']."</td>";
            echo "<td>".$record['NetIncome']."</td>";
            echo "<td>".$record['SaleOfPPE']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<pre>".$response->body()."</pre>";
    }

    public function price($symbol){
        $symbol = strtoupper($symbol);
        $response = Http::get($this->host.'price/'.$symbol);
        $data = $response->json()['data'];
        echo "<table border=\"1\" width=\"900\">";
        foreach($data as $record){
            echo "<tr>";
            echo "<td>".$record['symbol']."</td>";
            echo "<td>".$record['open']."</td>";
            echo "<td>".$record['close']."</td>";
            echo "<td>".$record['high']."</td>";
            echo "<td>".$record['low']."</td>";
            echo "<td>".$record['date']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<pre>".$response->body()."</pre>";
    }

    public function profile($symbol){
        $symbol = strtoupper($symbol);
        $response = Http::get($this->host.'profile/'.$symbol);
        $data = $response->json()['data'][$symbol.".JK"];
        echo "<ul>";
        echo "<li>".$data['address1']."</li>";
        echo "<li>".$data['industry']."</li>";
        echo "<li>".$data['sector']."</li>";
        echo "<li>".$data['website']."</li>";
        echo "<li>".$data['phone']."</li>";
        echo "<li><strong>Officers:</strong><ol>";
        foreach($data['companyOfficers'] as $officer){
            echo "<li>".$officer['name']." | ".$officer['title']."</li>";
        }
        echo "</ol></li>";
        echo "</ul>";

        echo "<pre>".$response->body()."</pre>";
    }

    public function summary($symbol){
        $symbol = strtoupper($symbol);
        $response = Http::get($this->host.'summary/'.$symbol);
        $data = $response->json()['data'][$symbol.".JK"];
        echo "<ul>";
        echo "<li>".$data['averageVolume']."</li>";
        echo "<li>".$data['bid']."</li>";
        echo "<li>".$data['dividendRate']."</li>";
        echo "<li>".$data['payoutRatio']."</li>";
        echo "<li>".$data['regularMarketOpen']."</li>";
        echo "<li>".$data['trailingPE']."</li>";
        echo "</ul>";

        echo "<pre>".$response->body()."</pre>";
    }
}