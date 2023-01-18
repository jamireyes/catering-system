<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use App\Models\Package;
use App\Models\User;
use Illuminate\Support\Str;
use NumberFormatter;
use Cart;
use Auth;
use DB;

class VoucherController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'USER' || Auth::user()->role == 'ADMIN'){
            return back();
        }
        
        $vouchers = Voucher::selectRaw('vouchers.*, packages.name as package_name')
            ->join('packages', 'vouchers.model_id', 'packages.id')
            ->withTrashed()
            ->paginate(10);

        $packages = Package::select('id as package_id', 'name as package_name')->get();

        return view('pages.vouchers.index', compact(['vouchers', 'packages']));
    }

    public function store(Request $request)
    {
        
        $package = Package::findOrFail($request->package_id);

        $expires_at = isset($request->expires_at) ? $expires_at = $request->expires_at : NULL;

        $voucher = $package->createVoucher([
            'discount' => $request->discount
        ], $expires_at);
        
        $message = 'Successfully generated '.Str::upper($voucher->code).'!';

        return back()->with('success', $message);
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id)->delete();

        return back()->with('warning', 'Successfully removed the voucher');
    }

    public function restore($id)
    {
        $voucher = Voucher::withTrashed()->find($id)->restore();

        return back()->with('warning', 'Successfully restored the voucher');
    }

    public function redeem(Request $request)
    {
        $id = Cart::content()->where('id', 'package')->pluck('options')->pluck('id');

        $formatter = new NumberFormatter('en-PH', NumberFormatter::DECIMAL);
        $price = $formatter->parse(Cart::total());

        $voucher = false;
        if(isset($request->voucher)){
            try {
                $checkVoucher = Voucher::where('code', $request->voucher)
                    ->where('model_id', $id)->exists();

                if($checkVoucher != NULL){
                    $voucher = auth()->user()->redeemCode($request->voucher);
                    Cart::setGlobalDiscount($voucher->data->get('discount'));
                    session()->flash('coupon_success', 'Coupon Applied!');
                } else {
                    session()->flash('coupon_error', 'Cannot use this code for this package');
                }
                
            } catch(\Exception $ex) {
                session()->flash('coupon_error', $ex->getMessage());
            }
        }

        return back();
    }
}
