<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class BasketController extends Controller
{
    

    function userbasketdata(){
        $userId = auth()->id();
        $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->where('ba_status', '0')->orderBy('created_at', 'desc')->get();
        return view('dashboard/subscription/basket',['u_id' => $userId, 'Baskets' => $Baskets]);
    }
    function buyexam($e_id){
        $userId = auth()->id();
        $Exams = DB::table('exams')->select('e_inner_level','e_price1y')->where('e_id', $e_id)->get();
        $JionDate = date("Y-m-d H:i:s" , time());
        $ExpDate = date("Y-m-d H:i:s", strtotime("+12 months"));
        $BasketsC = DB::table('baskets')->where('ba_e_id', $e_id)->where('ba_status', '0')->get();
        echo $BasketsCount = $BasketsC->count();
        if($BasketsCount > 0)
            {
                return redirect()->back()->with('error_basket4', 'Exam already added in basket.');
            }
        else
            {
                DB::table('baskets')->insert([
                'ba_e_inner_level' => $Exams->first()->e_inner_level,
                'ba_e_id' => $e_id,
                'ba_u_id' => auth()->id(),
                'ba_for' => 12,
                'ba_jiondate' => $JionDate,
                'ba _expdate' => $ExpDate,
                'ba_price' => $Exams->first()->e_price1y,
                'ba_coupon' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                ]);
            $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->where('ba_status', '0')->orderBy('created_at', 'desc')->get();
            return redirect()->back()->with('success_basket3', 'Exam added successfully.');
            }
    }
    function basketremoveitem($ba_id){
        DB::table('baskets')->where('ba_id', $ba_id)->delete();
        return redirect()->back()->with('success_basket1', 'Exam removed successfully.');
    }
    function basketupdateitem(Request $request){
        $for = $request->query('for');
        $ba_Id = $request->query('ba_id');
        $Baskets = DB::table('baskets')->select('ba_e_id')->where('ba_id', $ba_Id)->get();
        $Exams = DB::table('exams')->select('e_price3m','e_price6m','e_price1y')->where('e_id', $Baskets->first()->ba_e_id)->get();
        if($for == 3) $ExamPrice = $Exams->first()->e_price3m;
        if($for == 6) $ExamPrice = $Exams->first()->e_price6m;
        if($for == 12) $ExamPrice = $Exams->first()->e_price1y;
        DB::table('baskets')->where('ba_id', $ba_Id)->update(['ba_for' => $for, 'ba_price' => $ExamPrice, 'ba_discount_price' => '0.00']);
        return redirect()->back()->with('success_basket2', 'Exam updated successfully.');
    }
    function basketaddcoupon(Request $request){
        $userId = auth()->id();
        $Coupon = $request->input('TextDiscount');
        $Coupon = DB::table('coupon')->select('*')->where('coup_coupon', $Coupon)->get();
        //Check if coupon is Avalable
        if ($Coupon->isEmpty()) 
            {
                return redirect()->back()->with('error_basket1', 'Invalid coupon.');
            }
        $TodayDate = date("Y-m-d H:i:s" , time());
        $ExpDate = $Coupon->first()->coup_exp_date;
        //Check if coupon is Expired
        if ($TodayDate > $ExpDate)
            {
                return redirect()->back()->with('error_basket2', 'Date expired.');
            }
        $DiscountType = $Coupon->first()->coup_discount_type;
        $DiscountValue = $Coupon->first()->coup_discount;
        $MessageArr = "";
        $Baskets = DB::table('baskets')->select('ba_price','ba_id','ba_e_id')->where([['ba_u_id', $userId], ['ba_status', '0']])->get();
        foreach($Baskets as $Basket)
            {
                $Exams = DB::table('exams')->select('e_name')->where('e_id', $Basket->ba_e_id)->get();
                if($Coupon->first()->coup_e_id == $Basket->ba_e_id)
                    {
                        $ba_Id = $Basket->ba_id;
                        $FullPrice = $Basket->ba_price;
                        if($DiscountType == '1')
                            {
                                $DiscountAmount = $FullPrice * ($DiscountValue / 100);
                                $DiscountPrice = $FullPrice - $DiscountAmount;
                            }
                        if($DiscountType == '2')
                            {
                                $DiscountPrice = $FullPrice - $DiscountValue;
                            }
                        DB::table('baskets')->where('ba_id', $ba_Id)->update(['ba_discount_price' => $DiscountPrice]);
                        $NewCouponUsage = $Coupon->first()->coup_usage + 1;
                        DB::table('coupon')->where('coup_id', $Coupon->first()->coup_id)->update(['coup_usage' => $NewCouponUsage]);
                        $MessageArr .= '<span style="color: green;">Coupon applied for <strong>' . $Exams->first()->e_name . '</strong> successfully.</span><br>';
                       
                    }
                else
                    {
                        $MessageArr .= '<span style="color: red;">Coupon Not Valid For  <strong>' . $Exams->first()->e_name . '</strong>.</span><br>';
                    }      
            }
        return redirect()->back()->with('onlymessage_basket1', $MessageArr);
    }
    function basketdummypay(Request $request){
        $ExamTotal = "0";
        $TotalDiscount = "0";
        $userId = auth()->id();
        $PassUser = $request->input('custom');
        $Passproname = $request->input('paypal_my_proname');
        $PassTotalPrice = $request->input('paypal_my_TotalPrice');
        $PassFname = $request->input('first_name');
        $PassLname = $request->input('last_name');
        $Passemail = $request->input('payer_email');
        $PassItem = $request->input('item_number');
        //Add Invoice
        DB::table('invoice')->insert([
            'in_u_id' => $userId,
            'in_date' => Carbon::now(),
            'in_paypal_payment_id' => 'Admin Access',
            'in_paypal_payment_type' => 'Free Access',
            'in_total' => $ExamTotal,
            'in_discount' => $TotalDiscount,
            'in_pay' => $PassTotalPrice,
            'in_remarks' => 'Dummy Payment',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $LastAddInvoiceId = DB::getPdo()->lastInsertId();
        //Add Invoice Data
        $Baskets = DB::table('baskets')->select('ba_price','ba_id','ba_e_id','ba_discount_price','ba_for','ba_coupon')->where([['ba_u_id', $PassUser], ['ba_status', '0']])->get();
        foreach ($Baskets as $Basket)
            {
                if($Basket->ba_discount_price == '0.00')
                    {
                        $ExamTotal = $ExamTotal + $Basket->ba_price;
                    }
                else
                    {
                        $ExamTotal = $ExamTotal + $Basket->ba_price;
                        $A = $Basket->ba_price - $Basket->ba_discount_price;
                        $TotalDiscount = $TotalDiscount + $A;
                    }
                DB::table('invoice_data')->insert([
                    'ind_in_id' => $LastAddInvoiceId,
                    'ind_e_id' => $Basket->ba_e_id,
                    'ind_for' => $Basket->ba_for,
                    'ind_price' => $Basket->ba_price,
                    'ind_discount_price' =>$Basket->ba_discount_price,
                    'ind_coupon' => $Basket->ba_coupon,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    ]);
                $SubscribesC = DB::table('subscribes')->select('su_expdate')->where('su_e_id', $Basket->ba_e_id)->where('su_u_id', $PassUser)->get();
                $SubscribesCount = $SubscribesC->count();
                if($SubscribesCount > 0)
                    {
                        
                        $ForMonths = $Basket->ba_for;
                        $OldExpDate = $SubscribesC->first()->su_expdate;
                        if ($OldExpDate < now()) 
                            {
                                if($ForMonths == 3) $ExpDate = date("Y-m-d H:i:s", strtotime("+3 months"));
                                if($ForMonths == 6) $ExpDate = date("Y-m-d H:i:s", strtotime("+6 months"));
                                if($ForMonths == 12) $ExpDate = date("Y-m-d H:i:s", strtotime("+12 months"));
                            }
                        else
                            {
                                if($ForMonths == 3) $ExpDate = date("Y-m-d H:i:s", strtotime('+3 months', strtotime($OldExpDate)));
                                if($ForMonths == 6) $ExpDate = date("Y-m-d H:i:s", strtotime('+6 months', strtotime($OldExpDate)));
                                if($ForMonths == 12) $ExpDate = date("Y-m-d H:i:s", strtotime('+12 months', strtotime($OldExpDate)));
                            }
                        DB::table('subscribes')->where('su_e_id', $Basket->ba_e_id)->where('su_u_id', $PassUser)->update(['su_for' => $ForMonths,'su_in_id' => $LastAddInvoiceId,'su_expdate' => $ExpDate, 'updated_at' => Carbon::now()]);
                    }
                else
                    {
                        $TodayDate = date("Y-m-d H:i:s" , time());
                        $ForMonths = $Basket->ba_for;
                        if($ForMonths == 3) $ExpDate = date("Y-m-d H:i:s", strtotime("+3 months"));
                        if($ForMonths == 6) $ExpDate = date("Y-m-d H:i:s", strtotime("+6 months"));
                        if($ForMonths == 12) $ExpDate = date("Y-m-d H:i:s", strtotime("+12 months"));
                        DB::table('subscribes')->insert([
                            'su_e_id' => $Basket->ba_e_id,
                            'su_u_id' => $PassUser,
                            'su_in_id' => $LastAddInvoiceId,
                            'su_for' => $Basket->ba_for,
                            'su_jiondate' => $TodayDate,
                            'su_expdate' => $ExpDate,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
            }
        DB::table('invoice')->where('in_id', $LastAddInvoiceId)->update(['in_total' => $ExamTotal, 'in_discount' => $TotalDiscount]);
        DB::table('baskets')->where('ba_u_id', $PassUser)->update(['ba_status' => 1, 'updated_at' => Carbon::now()]);
        return redirect()->action([SubscribeController::class, 'subscriptions']);
    }    
}