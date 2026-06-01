@php
use Carbon\Carbon;    
@endphp
@extends('admin.assets.adminlayout')
@section('content')
    <div class="container-fluid">
<!-- Page Heading -->
<div class='row align-items-center justify-content-between pt-3 mb-3'>
    <div class='col-auto mb-0 h3 text-gray-800'>Accouts</div>
    <div class='col-12 col-xl-auto mb-0'>
        <a href="main.php?ab=2&p=2&record=7" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fas fa-users-cog fa-sm text-white-50"></i>&nbsp;&nbsp;Show All Users</a>
        <button type='button' id="addUserModal" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-users-cog fa-sm text-white-50"></i>Add User</button>
    </div>
</div>    
@if(session('success'))
    <div class="successAlert">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr #</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Purchase Type</th>
                            <th>PayPal ID</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Sr #</th>
                            <th>Detail</th>
                            <th>Date</th>
                            <th>Purchase Type</th>
                            <th>PayPal ID</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($data as $id => $Accounts)
                            <tr>
                                <td style='text-align: center;'>{{ $Accounts->pay_id}}</td>
                                <td style='text-align: left;'>
                                    @php
                                        $User = DB::table('users')->select('email')->where('id', $Accounts->pay_user_id)->get();
                                        $UserEmail = $User->first()->email ?? 'No Email Found';

                                        $Category = DB::table('category')->select('c_name')->where('c_id', $Accounts->pay_c_id)->get();
                                        $CategoryName = $Category->first()->c_name ?? 'No Category Found';
                                    
                                    
                                    @endphp
                                    <div class="badge bg-success text-white rounded-pill">User </div>  {{ $UserEmail }}<br>
                                    <div class="badge bg-danger text-white rounded-pill">Subscribe Exam</div>  {{ $CategoryName }}
                                    
                                    
                                </td>
                                <td style='text-align: center;'>
                                    @php
                                        $JionDate = Carbon::parse($Accounts->pay_date)->format('F j, Y, g:i A');
                                    @endphp
                                    {{ $JionDate }}</td>
                                <td style='text-align: center;'>
                                    @if ($Accounts->pay_purchase_type == '1')
                                        New Purchase
                                    @else
                                        Renew
                                    @endif
                                </td>
                                <td style='text-align: center;'>{{ $Accounts->pay_paypal_payment_id}}</td>
                                <td style='text-align: center;'>{{ $Accounts->pay_amount_total}}</td>
                                <td style='text-align:center;'>
                                    -
                                </td>
                            </tr>                            
                        @endforeach
                        
                        
                        {{-- @forelse ($Users as $User)
                            @php
                                $ResUT = DB::table('user_types')->where('ut_id', $User->u_ut_id)->first();
                                if($User->u_jionip == "0.0.0.0") $ShowIp = "<span style='color:#f00;'>Admin Added</span>"; else $ShowIp = $User->u_jionip;
                                $JionDate = Carbon::parse($User->u_jiontimedate)->format('F j, Y, g:i A'); // August 15, 2025, 2:30 PM
                                $UserTypeColor = $ResUT->ut_color;                                
                            @endphp --}}
                        
{{-- Modal Edit User Start --}}
{{-- <div class="modal" id="sendPassModal{{ $User->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $User->id }}" aria-hidden="true">
    <div class='row align-items-center justify-content-between pt-3 mb-3'>
        <div class='col-auto mb-0 h3 text-gray-800'>Send User Password</div>
        <div class='col-12 col-xl-auto mb-0'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
    <div class="modal-dialog"></div>  --}}
    {{-- <form action="{{ route('updateUserAdmin') }}" method="post">
    @csrf
        
    </form> --}}
</div> 






                            {{-- Modal Edit User Start --}}
{{-- <div class="modal" id="userModal{{ $User->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $User->id }}" aria-hidden="true">
    <div class='row align-items-center justify-content-between pt-3 mb-3'>
        <div class='col-auto mb-0 h3 text-gray-800'>Edit User</div>
        <div class='col-12 col-xl-auto mb-0'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
    <div class="modal-dialog"></div>  
    <form action="{{ route('updateUserAdmin') }}" method="post">
    @csrf
    <div class="row">
<div class="col-12">
<div class="form-floating mb-3">
<input class="form-control" type="email" name="email" value="{{$User->email}}" disabled placeholder="name@example.com" />
<label for="email">Username must be a valid email.</label>
</div>
</div>
</div>
<div class="row">
<div class="col-6">
<div class="form-floating mb-3">
<input class="form-control" type="text" name="u_fname" value="{{$User->u_fname}}" placeholder="name@example.com" />
<label for="email">First Name</label>
</div>
</div>
<div class="col-6">
<div class="form-floating mb-3">
<input class="form-control" type="text" name="u_lname" value="{{$User->u_lname}}" placeholder="name@example.com" />
<label for="email">Last Name</label>
</div>
</div>
</div>
<div class="row">
<div class="col-6">
<div class="form-floating mb-3">
<input class="form-control" type="date" name="u_dob" value="{{$User->u_dob}}" placeholder="Password" />
<label for="dateofbirth">Date Of Birth</label>
</div>
</div>
<div class="col-6">
<div class="form-floating mb-3">
@php
$ResUT2 = DB::table('user_types')->where('ut_status', '=' , 1)->get();
@endphp
<select name='u_ut_id' class='form-select' >
<option value='0'>Select User Type</option>
@foreach($ResUT2 as $a)
<option value='{{ $a->ut_id }}' {{ $a->ut_id == $User->u_ut_id ? 'selected' : '' }}>{{ $a->ut_name }}</option>
@endforeach		
</select>
<label for="floatingSelect">User Type</label>
</div>
</div>
</div>
<div class="row">
<div class="col-12 text-center mt-3">
<div class="form-floating mb-3">
<input type="hidden" name="user_id" value="{{ $User->id }}" />
<button type="submit" class="btn btn-success">Update User</button>
</div>
</div>
</div>
    </form>
                                        
</div> --}}
{{-- Modal Edit User End --}}



{{-- Modal View User Start --}}
{{-- <div class="modal" id="viewModal{{ $User->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $User->id }}" aria-hidden="true">
    <div class='row align-items-center justify-content-between pt-3 mb-3'>
        <div class='col-auto mb-0 h3 text-gray-800'>User Detail</div>
        <div class='col-12 col-xl-auto mb-0'>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
    <div class="modal-dialog"></div>  
    <div class="row mb-3" style="font-size:16px;">
        <div class="col-2 fw-bolder">Username :</div>
        <div class="col-10">{{$User->email}}</div>
    </div>
     <div class="row mb-3" style="font-size:16px;">
        <div class="col-2 fw-bolder">First Name :</div>
        <div class="col-4">{{$User->u_fname}}</div>
        <div class="col-2 fw-bolder">Last Name :</div>
        <div class="col-4">{{$User->u_lname}}</div>
    </div>
    <div class="row mb-3" style="font-size:16px;">
        <div class="col-2 fw-bolder">DOB :</div>
        <div class="col-4">{{$User->u_dob}}</div>
        <div class="col-2 fw-bolder">Gender :</div>
        <div class="col-4">{{$User->u_gender}}</div>
    </div>
    <div class="row mb-3" style="font-size:16px;">
        <div class="col-2 fw-bolder">Contact :</div>
        <div class="col-4">{{$User->u_cphone}}</div>
        <div class="col-2 fw-bolder">Join IP :</div>
        <div class="col-4">{{$ShowIp}}</div>
    </div>
    <div class="row mb-3" style="font-size:16px;">
        <div class="col-2 fw-bolder">User Type :</div>
        <div class="col-4"><span style='color:{{$UserTypeColor}}'>{{$ResUT->ut_name}}</span></div>
        <div class="col-2 fw-bolder">Join Date :</div>
        <div class="col-4">{{$JionDate}}</div>
    </div>
    
    
    
    </div>
    
    
        
        
    
                                                                       
</div> --}}
{{-- Modal View User End --}}




                        {{-- @empty
                            {{ 'No Users' }}
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- Modal Add User Start --}}
<div id="myModal" class="modal">
    <div class='row align-items-center justify-content-between pt-3 mb-3'>
        <div class='col-auto mb-0 h3 text-gray-800'>Add User</div>
        <div class='col-12 col-xl-auto mb-0'>
            <span class="close">&times;</span>
        </div>
    </div> 
    {{-- <form action="{{ route('addUserAdmin') }}" method="post">
    @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input class="form-control" type="email" name="email" value="" placeholder="name@example.com" />
                    <label for="email">Username must be a valid email.</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="u_fname" value="" placeholder="name@example.com" />
                    <label for="email">First Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input class="form-control" type="text" name="u_lname" value="" placeholder="name@example.com" />
                    <label for="email">Last Name</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input class="form-control" type="password" name="password" placeholder="Password" />
                    <label for="inputPassword">Password</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    @php
                         $ResUT2 = DB::table('user_types')->where('ut_status', '=' , 1)->get();
                    @endphp
                    <select name='u_ut_id' class='form-select' >
                	    <option value='0'>Select User Type</option>
                        @foreach($ResUT2 as $a)
                            <option value='{{ $a->ut_id }}' >{{ $a->ut_name }}</option>
                        @endforeach		
                    </select>
                    <label for="floatingSelect">User Type</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-3">
                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-success">Add User</button>
                </div>
            </div>
        </div>
    </form>
  </div> --}}
{{-- Modal Add User End --}}
<script>
// Get elements
const modal = document.getElementById('myModal');
const openLink = document.getElementById('addUserModal');
const closeBtn = document.querySelector('.close');
// Open modal
openLink.onclick = function(event) {
  event.preventDefault(); // Prevent default link behavior
  modal.style.display = 'block';
}
// Close modal when clicking the X
closeBtn.onclick = function() {
  modal.style.display = 'none';
}
</script>
@endsection