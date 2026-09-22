<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class RateQuote extends Model
{
    protected $fillable=['uuid','user_id','base_asset_id','quote_asset_id','amount_send','rate','gross_receive','fee_amount','net_receive','expires_at'];
    protected $casts=['amount_send'=>'decimal:12','rate'=>'decimal:12','gross_receive'=>'decimal:12','fee_amount'=>'decimal:12','net_receive'=>'decimal:12','expires_at'=>'datetime'];
    public function base(){return $this->belongsTo(Asset::class,'base_asset_id');}
    public function quote(){return $this->belongsTo(Asset::class,'quote_asset_id');}
}
