<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ExchangeOrder extends Model
{
    protected $table='exchange_orders';
    protected $fillable=['uuid','user_id','quote_id','base_asset_id','quote_asset_id','amount_send','amount_receive','rate','fee_amount','status','payment_method','sender_reference','receiver_address','expires_at','failure_reason'];
    protected $casts=['amount_send'=>'decimal:12','amount_receive'=>'decimal:12','rate'=>'decimal:12','fee_amount'=>'decimal:12','expires_at'=>'datetime'];
    public function base(){return $this->belongsTo(Asset::class,'base_asset_id');}
    public function quote(){return $this->belongsTo(Asset::class,'quote_asset_id');}
}
