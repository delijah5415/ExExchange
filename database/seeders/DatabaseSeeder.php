<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder { public function run(): void {
 $assets=[['Bitcoin','BTC','bitcoin'],['Ethereum','ETH','ethereum'],['Tether','USDT','tether'],['USD Coin','USDC','usd-coin'],['Solana','SOL','solana'],['XRP','XRP','ripple'],['Dogecoin','DOGE','dogecoin'],['Litecoin','LTC','litecoin']];
 foreach($assets as [$name,$symbol,$cg]) DB::table('assets')->updateOrInsert(['symbol'=>$symbol],['name'=>$name,'type'=>'crypto','coingecko_id'=>$cg,'icon'=>null,'is_active'=>true,'decimals'=>8,'created_at'=>now(),'updated_at'=>now()]);
 foreach([['Bitcoin','bitcoin'],['Ethereum','ethereum'],['Solana','solana'],['Polygon','polygon']] as [$name,$slug]) DB::table('networks')->updateOrInsert(['slug'=>$slug],['name'=>$name,'is_active'=>true,'confirmations'=>3,'created_at'=>now(),'updated_at'=>now()]);
 $ids=[];foreach(['BTC','ETH','USDT','USDC'] as $s)$ids[$s]=DB::table('assets')->where('symbol',$s)->value('id');foreach([['BTC','ETH'],['ETH','BTC'],['BTC','USDT'],['USDT','BTC'],['ETH','USDT'],['USDT','ETH'],['USDC','USDT'],['USDT','USDC']] as [$a,$b])DB::table('exchange_pairs')->updateOrInsert(['base_asset_id'=>$ids[$a],'quote_asset_id'=>$ids[$b]],['is_active'=>true,'spread_bps'=>100,'min_amount'=>0.000001,'max_amount'=>null,'created_at'=>now(),'updated_at'=>now()]);
 } }
