@php
use Carbon\Carbon;
$ExamTotal = "0";
@endphp
@extends('dashboard.layoutDashboard')
@section('examhistory')
    
    <section class="content-panel">
        <div class="title-row">
            <div>
                <span class="title-kicker">Subscription</span>
                <h1>My Basket</h1>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
            <div class="db-actions"><a href="/createnew/" class=" btn db-btn btn-sm">+ Create New</a></div>
        </div>
        <div class="card-body">
            <div  style="margin-top: 20px;">
                <form name="" action="{{ route('basketaddcoupon') }}" method="post">
                @csrf
                <table class='table table-bordered'>
                    <tbody>
                        <tr class='danger'>
                            <th class='text-center' style='width: 60px;'></th>
                            <th class='text-center' style='width: 60px;'>Sr.#</th>
                            <th>Description</th>
                            <th class='text-center'>Scribe For</th>
                            <th class='text-center' style='width: 130px;'>Price</th>
                            <th class='text-center' style='width: 180px;'>Total</th>
                        </tr>
                        @foreach ($Baskets as $Basket)
                            @php
                                $Exams = DB::table('exams')->select('e_name','e_price1y')->where('e_id', $Basket->ba_e_id)->get();
                            @endphp
                            <tr class='normal' >
                                <td class='text-center text-danger' ><a href="/basketremoveitem/{{ $Basket->ba_id }}" class='text-danger'  title='remove' ><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20" viewBox="0 0 512 512"><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="rgb(189, 35, 42)" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg>
</a></td>
                                <td class='text-center'>{{ $loop->iteration }}</td>
                                <td><strong>Exam : </strong>{{ $Exams->first()->e_name }}</td>
                                <td class='text-center' style='width: 130px;'>
                                    @php
                                        $Exams2 = DB::table('exams')->select('e_price3m','e_price6m','e_price1y')->where('e_id', $Basket->ba_e_id)->get();
                                        if($Basket->ba_for == 3) $ExamPrice = $Exams2->first()->e_price3m;
                                        if($Basket->ba_for == 6) $ExamPrice = $Exams2->first()->e_price6m;
                                        if($Basket->ba_for == 12) $ExamPrice = $Exams2->first()->e_price1y;
                                        $ExamTotal = $ExamTotal + $ExamPrice;
                                    @endphp
                                    <select name='TextGender' class='form-control' onchange='if(this.value) { window.location.href = this.value; }'>
                                        <option  value="{{ route('basketupdateitem', ['for' => 3 , 'ba_id' => $Basket->ba_id]) }}" @selected($Basket->ba_for == 3)>3 Months</option>
                                        <option  value="{{ route('basketupdateitem', ['for' => 6, 'ba_id' => $Basket->ba_id]) }}" @selected($Basket->ba_for == 6)>6 Months</option>
                                        <option  value="{{ route('basketupdateitem', ['for' => 12, 'ba_id' => $Basket->ba_id]) }}" @selected($Basket->ba_for == 12)>1 Year</option>
                                    </select>
                                </td>
                                <td class='text-center'>{{ $ExamPrice}}</td>
                                <td class='text-center'>{{ $ExamTotal}}</td>
                            </tr>
                        @endforeach

                    
                    <tr class='info'>
                        <th colspan='5' class='text-right pr-5'>Sub Total</th>
                        <th class='text-center'>{{ $ExamTotal}}</th>
                    </tr>
                    <tr class='normal'>
                        <th colspan='4' class='text-left pr-5'>Enter discount code :- <input type='text' class='form-control'size='5'  name='TextDiscount' value='' placeholder='Enter Code'   style='width: 150px;display:inline;' /> <input type="submit" class='btn btn-light btn-sm' style='font-size: 12px; padding: 4px 8px !important;height: 20px !important;' name="submit" value="Add Coupon"/> <span class='text-right'>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></th>
                        <th class='text-right pr-5'>Discount</th>
                        <th class='text-center'>$ 0.00</th>
                    </tr>
                    <tr class='danger'>
                        <th colspan='5' class='text-right pr-5'>Total</th>
                        <th class='text-center'>$ {{ $ExamTotal}} AUD</th>
                    </tr>
                </tbody>
            </table>    
        </form>    
            <div style='text-align:center;'>
<form class="paypal" action="../payments/paypal/payments.php" method="post" id="paypal_form" target="_blank">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="lc" value="AU" />
    <input type="hidden" name="currency_code" value="AUD" />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />                    
    <input type="hidden" name="custom" value="2" / >
    <input type="hidden" name="paypal_my_proname" value="isim Subscription" / >
	<input type="hidden" name="paypal_my_TotalPrice" value="2994" / >                    
    <input type="hidden" name="first_name" value="Ahsan"  />
    <input type="hidden" name="last_name" value="Ihsan"  />
    <input type="hidden" name="payer_email" value="ahsonihsan@gmail.com"  />
    <input type="hidden" name="item_number" value="1" / > 
    <input type="hidden" name="my_session_id" value="3b717afaaa82147fa8bc1a78b9a6edf9" / > 
    <input type="hidden" name="option_selection1" value="6777">
    <input type="submit" class='btn btn-success checkout-button' name="submit" value="Checkout"/>
</form>
            

            <img src='../theme_files/images/payment_logo.png' width='525'/>
            
            </div>
        </div>
    </section>
    







  
@endsection





    
    