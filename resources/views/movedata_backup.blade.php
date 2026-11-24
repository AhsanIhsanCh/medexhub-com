<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MoveDataController extends Controller
{
    

   public function movedata()
    {
        // //Payments
        // $PaymentsOlds = DB::table('payments_old')->orderby('pay_id')->get();
        // $index = 1;
        // foreach($PaymentsOlds as $PaymentsOld)
        //     {
        //         $PayPalPaymentId = $PaymentsOld->pay_paypal_payment_id.'_'.$PaymentsOld->pay_id;
        //         $PayPalType = $PaymentsOld->pay_paypal_payment_type.'_'.$PaymentsOld->pay_id;
        //         DB::table('payments')->insert([
        //             'pay_u_id' => $PaymentsOld->pay_user_id,
        //             'pay_in_id' => $PaymentsOld->pay_subscribe_id,
        //             'pay_e_id' => $PaymentsOld->pay_cat_id,
        //             'paypal_order_id' => $PayPalPaymentId,
        //             'paypal_capture_id' => $PayPalType,
        //             'pay_for' => $PaymentsOld->pay_for,
        //             'pay_purchase_type' => $PaymentsOld->pay_purchase_type,
        //             'pay_description' => 'Old Data Migration',
        //             'pay_amount_total' => $PaymentsOld->pay_amount_total,
        //             'pay_amount_minor' => $PaymentsOld->pay_amount_pay,
        //             'pay_amount_discount' => $PaymentsOld->pay_amount_discount,
        //             'pay_currency' => 'AUD',
        //             'status' => 'completed',
        //             'paid_at' => $PaymentsOld->pay_date,
        //             'created_at' => $PaymentsOld->pay_date,
        //             'updated_at' => $PaymentsOld->pay_date
        //     ]);

            
            // }
        


    //     //Add Users Updata Password
    //    DB::table('users_db')->('aa' != Null)->orderBy('userid', 'asc')->chunk(500, function ($Users) {

    //     foreach ($Users as $User) {

    //         DB::table('users_profiles')->updateOrInsert(
    //             ['up_u_id' => $User->userid],
    //             [
    //                 'up_dob' => $User->u_dobaa ?? null,
    //                 'up_gender' => $User->u_genderaa ?? null,
    //                 'up_address' => $User->u_addressaa ?? null,
    //                 'up_city' => $User->u_city ?? null,
    //                 'up_country' => $User->u_country ?? null,
    //                 'up_image' => $User->u_imageaa ?? 'noimage.png',
    //                 'up_name_safety' => $User->u_name_safety ?? null,
    //             ]
    //         );
    //     }
    // });



    $Users = DB::table('users_db')->('u_addressaa' != Null)->orderBy('userid', 'asc')->grt();


        foreach ($Users as $User) {

            echo $User->u_addressaa;
            echo "<br>";
            // DB::table('users_profiles')->updateOrInsert(
            //     ['up_u_id' => $User->userid],
            //     [
            //         'up_dob' => $User->u_dobaa ?? null,
            //         'up_gender' => $User->u_genderaa ?? null,
            //         'up_address' => $User->u_addressaa ?? null,
            //         'up_city' => $User->u_city ?? null,
            //         'up_country' => $User->u_country ?? null,
            //         'up_image' => $User->u_imageaa ?? 'noimage.png',
            //         'up_name_safety' => $User->u_name_safety ?? null,
            //     ]
            // );
        }
    

echo "User profiles migration completed for IDs 4007 to 5900.";

									

        
        


// $existingIds = DB::table('users_db')
//     ->whereBetween('userid', [1, 5900])
//     ->pluck('userid')
//     ->map(fn($id) => (int) $id)
//     ->toArray();

// $missingIds = array_values(array_diff(range(1, 5900), $existingIds));

// foreach ($missingIds as $id) {
//     echo $id . '<br>';
    
//     DB::table('users_db')->insert([
//                     'userid' => $id,
//                     'username' => 'A',
//                     'firstname' => '1',
//                     'lastname' => '1',
//                     'passward' => '1',
//                     'dateofbirth' => '1',
//                     'gander' => '1',
//                     'usertype' => '1',
//                     'phoneno' => '1',
//                     'city' => '1',
//                     'postalcodeaa' => '1',
//                     'countryaa' => '1',
//                     'address' => '1',
//                     'imagename' => '1',
//                     'jiondate' => '2010-01-01',
//                     'jiontime' => '00:01',
//                     'jionip' => '1',
//                     'newsletteraa' => '1',
//                     'demostatus' => '1',
  
//             ]);











// }
        // foreach($Users as $User)
        //     {
        //         echo $loop->iteration;
        //         echo $User->userid;
        //         echo "<br>";
        //     }



        
        
        
        // foreach($Users as $User)
        // {
        //     $password = Hash::make($User->password);
        //     DB::table('users')->where('id', $User->userid)->update(['password' => $password]);
        // }

        

        
    }
    
}

