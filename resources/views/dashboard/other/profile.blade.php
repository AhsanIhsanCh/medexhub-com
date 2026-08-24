@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('profile')
@include('messages')
<style>
    :root {
        --primary: #5b5cf0;
        --primary-dark: #4849d8;
        --background: #f5f7fb;
        --card: #ffffff;
        --header-bg: #f8f9fc;
        --border: #d9deea;
        --input-border: #cfd5e4;
        --input-disabled: #f0f1f7;
        --text: #5f6475;
        --heading: #555be8;
        --shadow: 0 4px 18px rgba(30, 40, 80, 0.05);
    }
    .account-grid {display: grid;grid-template-columns: repeat(2, minmax(0, 1fr));gap: 30px 35px;}
    .form-group {display: flex;flex-direction: column;gap: 9px;}
    .form-group.full-width {grid-column: 1 / -1;}
    label {font-size: 16px;color: #686d7e;}
    input,select {width: 100%;height: 54px;border: 1px solid var(--input-border);border-radius: 7px;background: #ffffff;padding: 0 18px;font-size: 18px;color: #555b6d;outline: none;transition: border-color 0.2s,box-shadow 0.2s;}
    input:focus, select:focus {border-color: var(--primary);box-shadow: 0 0 0 3px rgba(91, 92, 240, 0.10);}
    input[readonly], input:disabled, select:disabled {background: var(--input-disabled);color: #626777;cursor: not-allowed;}
    .password-form {max-width: 565px;}
    .password-form .form-group {margin-bottom: 20px;}
    .password-form input {height: 48px;font-size: 15px;}
    .password-form label {font-size: 13px;}
    .show-password {display: flex;align-items: center;gap: 10px;margin: 3px 0 22px;}
    .show-password input {width: 15px;height: 15px;cursor: pointer;accent-color: var(--primary);}
    .show-password label {font-size: 15px;cursor: pointer;}
    .btn-primary {border: none;background: #496be8;color: #ffffff;min-height: 40px;padding: 0 17px;border-radius: 5px;font-size: 14px;cursor: pointer;transition: background 0.2s,transform 0.1s;}
    .btn-primary:hover {background: #385ad5;}
    .btn-primary:active {transform: translateY(1px);}
    .radio-option input {width: 15px;height: 15px;accent-color: #2869ff;cursor: pointer;}
    .radio-option label {font-size: 15px;cursor: pointer;}
    @media (max-width: 768px) {
        .account-grid {grid-template-columns: 1fr;gap: 22px;}
        .form-group.full-width {grid-column: auto;}
        .password-form {max-width: 100%;}
    }
    @media (max-width: 480px) {
        input, select { height: 50px;font-size: 16px;}
    }
</style>
<section class="content-panel">
    <div class="title-row">
        <div>
        <span class="title-kicker">Profile</span>
        <h1>Profile</h1>
        <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
        </div>
        <div class="db-actions"></div>
    </div>
    @php
        $User = DB::table('users')->select('email','u_fname','u_lname','u_dob','u_gender','u_name_safety')->where('id', $u_id)->get();
    @endphp
    <div class="card-body" style="margin-top:30px;">
        <div class="table-wrap">
            <div style="width:90%;margin: 0 auto;margin-top:15px;margin-bottom:30px;">
                <h3>Account Details</h3>
                <form class="signin-form" action="{{ route('saveprofile1') }}" method="POST">
                @csrf
                    <div class="account-grid">
                        <div class="form-group full-width">
                            <label for="email">Username (Email)</label>
                            <input type="email"  name="email" value="{{ $User->first()->email }}" readonly >
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text"  name="TextFname" value="{{ $User->first()->u_fname }}" >
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text"  name="TextLname" value="{{ $User->first()->u_lname }}" >
                        </div>
                        <div class="form-group"> 
                            <label for="gender">Gender</label>
                            <select name="TextGender" style="height: 54px;b";>
                                @switch(true)
                                    @case($User->first()->u_gender == 0)
                                        <option value="0" selected>Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                        @break

                                    @case($User->first()->u_gender == 1)
                                        <option value="0">Select Gender</option>
                                        <option value="1" selected>Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Other</option>
                                        @break

                                    @case($User->first()->u_gender == 2)
                                        <option value="0">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2" selected>Female</option>
                                        <option value="3">Other</option>
                                        @break
                                    @case($User->first()->u_gender == 3)
                                        <option value="0">Select Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3" selected>Other</option>
                                @endswitch
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" name="TextDob" value="{{ $User->first()->u_dob }}" >
                        </div>
                    </div>
                    <div style="text-align:center;">
                        <button class="btn btn-primary" style="margin-top:30px;width:150px;" type="submit">Save</button>
                    </div>
                </form>
                <h3 style="margin-top:20px;">Change Password</h3>
                <form class="signin-form" action="{{ route('saveprofile2') }}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input class="password-field" type="password"  name="old_password" id="old_password" placeholder="Old Password" autocomplete="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input class="password-field" type="password"  name="password" id="password" placeholder="New Password" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input class="password-field" type="password"  name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" autocomplete="password_confirmation">
                    </div>
                    <div style="text-align:center;">
                        <button class="btn btn-primary" style="margin-top:30px;width:150px;" type="submit">Update</button>
                    </div>
                </form>
                <h3 style="margin-top:20px;">Settings</h3>
                <form class="signin-form" action="{{ route('saveprofile3') }}" method="post">
                @csrf
                    <div class="radio-option">
                        @if($User->first()->u_name_safety == 1)
                            <input type="checkbox" name="TextNameSafety2" value="0"  checked>
                            <input type="hidden" name="TextNameSafety" value="0">
                        @else
                            <input type="checkbox" name="TextNameSafety" value="1" >
                        @endif
                        <label for="region_australia">Display name in conversation.</label>
                    </div>
                    <div style="text-align:center;">
                        <button class="btn btn-primary" style="margin-top:30px;width:150px;" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection