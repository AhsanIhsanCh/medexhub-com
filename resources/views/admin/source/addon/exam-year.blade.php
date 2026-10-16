@extends('admin.adminlayout')
@section('examyear')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Exam Year</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Exam Year</li>
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive on-search">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Name</th>
                                        
                                        
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ExamYears as $ExamYear)
                                        <tr>
                                            <td style='text-align: center;'>{{$loop->iteration}}</td>
                                            <td>{{$ExamYear->ey_name}}</td>
                                            
                                            <td style='text-align:center;'>
                                                <a href='/adminEditExam/{{ $loop->iteration }}'><i class="fas fa-comment-alt-edit"></i></a>
                                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal{{ $loop->iteration }}"><i class="fas fa-eye"></i></button>
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