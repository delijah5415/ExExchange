<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Network extends Model
{
    protected $fillable=['name','slug','is_active','confirmations'];
    protected $casts=['is_active'=>'boolean'];
    public function assets(){return $this->belongsToMany(Asset::class,'asset_networks')->withPivot(['deposit_enabled','withdrawal_enabled','fee']);}
}
