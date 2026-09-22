<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name','symbol','type','icon','coingecko_id','is_active','decimals'];
    protected $casts = ['is_active'=>'boolean'];
    public function networks() { return $this->belongsToMany(Network::class, 'asset_networks')->withPivot(['deposit_enabled','withdrawal_enabled','fee']); }
}
