<?php
namespace App\Http\Controllers;
use App\Models\Asset;
use App\Models\ExchangeOrder;
use App\Models\RateQuote;
use App\Services\RateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ExchangeController extends Controller
{
    public function quote(Request $request, RateService $rates)
    {
        $data=$request->validate(['send_asset'=>'required|integer','receive_asset'=>'required|integer|different:send_asset','amount'=>'required|numeric|gt:0']);
        $base=Asset::where('id',$data['send_asset'])->where('is_active',true)->firstOrFail();
        $quoteAsset=Asset::where('id',$data['receive_asset'])->where('is_active',true)->firstOrFail();
        $rate=$rates->rate($base,$quoteAsset);
        $spread=(float)config('exchange.spread_bps',100)/10000;
        $feeRate=(float)config('exchange.fee_bps',50)/10000;
        $gross=(float)$data['amount']*$rate;
        $fee=$gross*$feeRate;
        $net=$gross*(1-$spread)-$fee;
        $quote=RateQuote::create(['uuid'=>(string)Str::uuid(),'user_id'=>$request->session()->get('supabase_user.id'),'base_asset_id'=>$base->id,'quote_asset_id'=>$quoteAsset->id,'amount_send'=>$data['amount'],'rate'=>$rate,'gross_receive'=>$gross,'fee_amount'=>$fee,'net_receive'=>$net,'expires_at'=>now()->addSeconds((int)config('exchange.quote_ttl',300))]);
        return response()->json(['quote_id'=>$quote->uuid,'send'=>$data['amount'].' '.$base->symbol,'receive'=>number_format($net,8,'.','').' '.$quoteAsset->symbol,'rate'=>$rate,'fee'=>$fee,'expires_at'=>$quote->expires_at->toIso8601String()]);
    }
    public function store(Request $request)
    {
        $data=$request->validate(['quote_id'=>'required|uuid','payment_method'=>'required|string|max:80','sender_reference'=>'nullable|string|max:255','receiver_address'=>'required|string|max:255','terms'=>'accepted']);
        $userId=$request->session()->get('supabase_user.id');
        $quote=RateQuote::where('uuid',$data['quote_id'])->where('user_id',$userId)->firstOrFail();
        if($quote->expires_at->isPast()) return back()->withErrors(['quote_id'=>'This quote has expired. Please request a new quote.']);
        $order=DB::transaction(function() use($quote,$data,$userId){$order=ExchangeOrder::create(['uuid'=>(string)Str::uuid(),'user_id'=>$userId,'quote_id'=>$quote->id,'base_asset_id'=>$quote->base_asset_id,'quote_asset_id'=>$quote->quote_asset_id,'amount_send'=>$quote->amount_send,'amount_receive'=>$quote->net_receive,'rate'=>$quote->rate,'fee_amount'=>$quote->fee_amount,'status'=>'awaiting_payment','payment_method'=>$data['payment_method'],'sender_reference'=>$data['sender_reference']??null,'receiver_address'=>$data['receiver_address'],'expires_at'=>$quote->expires_at]);DB::table('order_events')->insert(['order_id'=>$order->id,'status'=>'awaiting_payment','message'=>'Exchange order created.','created_at'=>now(),'updated_at'=>now()]);return $order;});
        return redirect('/account')->with('success','Order '.$order->uuid.' created. Follow the payment instructions shown in your account.');
    }
}
