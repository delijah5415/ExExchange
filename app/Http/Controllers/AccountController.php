<?php
namespace App\Http\Controllers;
use App\Models\ExchangeOrder;
use Illuminate\Http\Request;
class AccountController extends Controller
{
    public function index(Request $request){$uid=$request->session()->get('supabase_user.id');$orders=ExchangeOrder::with(['base','quote'])->where('user_id',$uid)->latest()->paginate(10);return view('account.index',['user'=>$request->session()->get('supabase_user'),'orders'=>$orders]);}
}
