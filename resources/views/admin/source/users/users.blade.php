@extends('admin.adminlayout')
@section('users')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Users</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">User Types</a>
                                <ul class="dropdown-menu  dropdown-menu-end p-3">
                                    <li><a href="/admin-usertype/1" class="dropdown-item rounded-1">Root Admin</a></li>
                                    <li><a href="/admin-usertype/2" class="dropdown-item rounded-1">Admin</a></li>
                                    <!-- <li><a href="/admin-usertype/3" class="dropdown-item rounded-1">Super Moderator</a></li>
                                    <li><a href="/admin-usertype/4" class="dropdown-item rounded-1">Moderator</a></li> -->
                                    <li><a href="/admin-usertype/5" class="dropdown-item rounded-1">Members</a></li>
                                    <li><a href="/admin-usertype/6" class="dropdown-item rounded-1">Suspend</a></li>
                                    <li><a href="/admin-usertype/7" class="dropdown-item rounded-1">Validating</a></li>
                                    <li><a href="/admin-usertype/8" class="dropdown-item rounded-1">Banned</a></li>
                                    <li><a href="/admin-usertype/99" class="dropdown-item rounded-1">All Users</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive no-search">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Email (Username)</th>
                                        <th>Name</th>
                                        <th style='text-align: center;'>Status</th>
                                        <th style='text-align: center;'>Role</th>
                                        <th style='text-align: center;'>Join Ip</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Users as $User)
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td><a href="/admin-innerexams/{{$User->id}}">{{$User->email}}</a></td>
                                            <td>{{$User->u_fname}} {{$User->u_lname}}</td>
                                            <th style='text-align: center;'><span class="d-inline-flex align-items-center p-1 pe-2 rounded-1 text-white bg-success fs-10"><i class="ti ti-point-filled me-1 fs-11"></i>Active</span></th>
                                            <td style='text-align: center;'>
                                            @if($User->u_ut_id == 1) <span class="badge bg-danger">Root Admin</span>
                                            @elseif($User->u_ut_id == 2) <span class="badge bg-danger">Admin</span>
                                            @elseif($User->u_ut_id == 3) <span class="badge bg-secondary">Super Moderator</span>
                                            @elseif($User->u_ut_id == 4) <span class="badge bg-secondary">Moderator</span>
                                            @elseif($User->u_ut_id == 5) <span class="badge bg-success">Members</span>
                                            @elseif($User->u_ut_id == 6) <span class="badge bg-info">Suspend</span>
                                            @elseif($User->u_ut_id == 7) <span class="badge bg-warning">Validating</span>
                                            @elseif($User->u_ut_id == 8) <span class="badge bg-danger">Banned</span>
                                            @endif
                                            </td>
                                            <td style='text-align: center;'>{{$User->u_jionip}}</td>
                                            <td style='text-align:center;'>
                                                <a href='/adminEditExam/{{ $User->id }}'><i class="fas fa-comment-alt-edit"></i></a>
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $User->id }}"><i class="fas fa-eye"></i></button>
                                            </td>
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