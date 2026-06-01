@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('basket')
    <div class='container-fluid'>
        <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">My Basket</h1>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 20px;"></div>
        {{-- <h2>Subscription</h2> --}}
        <div class="table-responsive">
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
                    <tr class='normal' >
                        <td  class='text-center' ><a onClick='return loaddelbasket(73),loadmessage(2);' class='text-danger'  title='remove'><i class='fa fa-trash'></i></a></td>
                        <td  class='text-center'>1</td>
                        <td><strong>Basic Plan : </strong>Starter Uni</td>
                        <td  class='text-center' style='width: 130px;'>
                            <select class='form-control'  onchange='loadbuytime(this,73),loadmessage(1)'>
                                <option value='6' selected>6 Months</option>
                                <option value='12' >12 Months</option>
                            </select>
                        </td>
                        <td class='text-center'>499.00</td>
                        <td class='text-center'>2994.00</td>
                    </tr>
                    <tr class='normal' >
                        <td  class='text-center'></i></td>
                        <td  class='text-center'></td>
                        <td colspan='4'><strong>Scenarios : </strong>Emergency Medicine, </td>
                    </tr>
                    <tr class='info'>
                        <th colspan='5' class='text-right pr-5'>Sub Total</th>
                        <th class='text-center'>2994.00</th>
                    </tr>
                    <tr class='normal'>
                        <th colspan='4' class='text-left pr-5'>Enter discount code :- <input type='text' class='form-control' id='myField' size='5' onchange='loadadddiscount(73)'  name='TextDiscount' value='' placeholder='Enter Code'   style='width: 150px;display:inline;' /> <span class='text-right'>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></th>
                        <th class='text-right pr-5'>Discount</th>
                        <th class='text-center'>$ 0.00</th>
                    </tr>
                    <tr class='danger'>
                        <th colspan='5' class='text-right pr-5'>Total</th>
                        <th class='text-center'>$ 2994.00 AUD</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style='text-align:center;'></form>
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
</div>
@endsection





    
    