@php
use Carbon\Carbon;    
@endphp
@extends('admin.adminlayout')
@section('maintenance-login')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Maintenance Login</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Maintenance Login</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div class="search-set">
                            <div class="search-input"><span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span></div>
                        </div>
                        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Show No. of Login History</a>
                                <ul class="dropdown-menu  dropdown-menu-end p-3">
                                    <li><a href="/admin-maintenance-login/100" class="dropdown-item rounded-1">Last 100 Login History</a></li>
                                    <li><a href="/admin-maintenance-login/250" class="dropdown-item rounded-1">Last 250 Login History</a></li>
                                    <li><a href="/admin-maintenance-login/500" class="dropdown-item rounded-1">Last 500 Login History</a></li>
                                    <li><a href="/admin-maintenance-login/999999" class="dropdown-item rounded-1">Last All Login History</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive on-search">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th style="width: 150px;text-align: center;">Total No of Login History</th>
                                        <th style="width: 150px;text-align: center;">User Status</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($LoginHistorys as $LoginHistory)
                                        <?php
                                            $User = DB::table('users')->select('email', 'u_fname', 'u_lname')->where('id', $LoginHistory->lh_u_id)->get();
                                            $Subscribes = DB::table('subscribes')->select('su_e_id')->where('su_u_id', $LoginHistory->lh_u_id)->where('su_expdate', '>', Carbon::now())->get();
                                            if($Subscribes->count() > 0) 
                                                {
                                                    $Status = "<span class='d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10'><i class='ti ti-point-filled me-1 fs-11'></i>Active</span>";
                                                }
                                            else
                                                {
                                                    $Status = "<span class='d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-danger fs-10'><i class='ti ti-point-filled me-1 fs-11'></i>Expired</span>";
                                                }
                                        ?>
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td>{{$User->first()->u_fname}} {{$User->first()->u_lname}}</td>
                                            <td>{{$User->first()->email}}</td>
                                            <td style="width: 150px;text-align: center;">{{$LoginHistory->total_loghistory}}</td>
                                            <td style="width: 150px;text-align: center;">{!! $Status !!}</td>
                                            <td style="width: 150px;text-align: center;">-</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-footer d-flex align-items-center justify-content-between border-top bg-white gap-3 flex-wrap">
        <p class="fs-13 text-gray-9 mb-0">© 2015–{{ date('Y') }} <a href="https://www.medexhub.com" target="_blank" class="link-primary">MedExHub</a>. All Right Reserved</p>
        <p>Designed & Developed By <a href="https://www.it-ocean.net" target="_blank" class="link-primary">It-Ocean.Net</a></p>
    </div>
</div>
@endsection