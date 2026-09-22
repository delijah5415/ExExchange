<?php
namespace App\Services;

use App\Models\Asset;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class RateService
{
    public function rate(Asset $base, Asset $quote): float
    {
        if ($base->id === $quote->id) return 1.0;
        if (!$base->coingecko_id || !$quote->coingecko_id) throw new RuntimeException('A live market identifier is not configured for this asset pair.');
        $url=rtrim((string)config('services.rates.url'),'\/');
        $response=Http::timeout(8)->retry(2,250)->get($url,['ids'=>$base->coingecko_id.','.$quote->coingecko_id,'vs_currencies'=>'usd']);
        if($response->failed()) throw new RuntimeException('Live rate provider is temporarily unavailable.');
        $data=$response->json();
        $b=(float)($data[$base->coingecko_id]['usd']??0); $q=(float)($data[$quote->coingecko_id]['usd']??0);
        if($b<=0 || $q<=0) throw new RuntimeException('Live rate is unavailable for this pair.');
        return $b/$q;
    }
}
