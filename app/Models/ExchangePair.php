<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ExchangePair extends Model
{
    protected $fillable=['base_asset_id','quote_asset_id','is_active','spread_bps','min_amount','max_amount'];
    protected $casts=['is_active'=>'boolean'];
    public function base(){return $this->belongsTo(Asset::class,'base_asset_id');}
    public function quote(){return $this->belongsTo(Asset::class,'quote_asset_id');}
}
