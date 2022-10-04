<?php

namespace App\Http\Controllers;

use Scheb\YahooFinanceApi\ApiClient;
use Scheb\YahooFinanceApi\ApiClientFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;

use App\Models\SahamPrices;

class SahamController extends Controller
{
    public function index($symbol){
        $symbol = strtoupper($symbol);
        try{
            $price = SahamPrices::where('symbol', '=', $symbol)
                            ->whereDate('last_date', '>=', Carbon::yesterday())
                            ->firstOrFail();
        } catch(ModelNotFoundException $e){
            $client = ApiClientFactory::createApiClient();
            $quote = $client->getHistoricalQuoteData($symbol, ApiClient::INTERVAL_1_DAY, 
                                        new \DateTime('-2 day'), new \DateTime('today'));
            $quote = $quote[0];
            $price = ['symbol'=>$symbol, 
                      'last_date'=>Carbon::parse($quote->getDate())->format('Y-m-d'),
                      'open'=> $quote->getOpen(), 'close'=> $quote->getClose(), 
                      'low'=> $quote->getLow(), 'high'=> $quote->getHigh(), 
                      'adjClose'=> $quote->getAdjClose(), 'volume'=> $quote->getVolume()];
            SahamPrices::create($price);
        }
        return response()->json($price);
    }

    public function show_price(){
        echo "<h3>List Harga Saham</h3><ul>";
        foreach(SahamPrices::all() as $saham) {
            echo "<li>".$saham->symbol."[".$saham->last_date."] ".$saham->open." - ".$saham->close."</li>";
        }
        echo "</ul>";
    }
}
