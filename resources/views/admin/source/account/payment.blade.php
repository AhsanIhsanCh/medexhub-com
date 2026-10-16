@php
use Carbon\Carbon;
$TotalYearAmount = "0";  
$TotalYearOrder = "0";  
@endphp
@extends('admin.adminlayout')
@section('payment')
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Payment</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active text-primary">Payment</li>
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
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Select Year</a>
                                <ul class="dropdown-menu  dropdown-menu-end p-3" style="max-height: 300px; overflow-y: auto;">
                                    <?php
                                    $StartYearA =  '2015-01-01';
                                    $CurentYear =  date('Y');
                                    $startYear = (int)date('Y', strtotime($StartYearA));
                                    $endYear   = (int)date('Y', strtotime($CurentYear));
                                    for ($yearinner = $endYear; $yearinner >= $startYear; $yearinner--) 
                                        {
                                            echo "<li><a href='/admin-payment/$yearinner' class='dropdown-item rounded-1'>Payment Year $yearinner</a></li>";
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?PHP
                        foreach ($Payments as $Paymentfull)
                            {
                                $cleanString = preg_replace('/[^0-9.]/', '', $Paymentfull->total_payment);
                                $TotalYearAmount = $TotalYearAmount + $cleanString;
                                $cleanStringA = preg_replace('/[^0-9.]/', '', $Paymentfull->total_orders);
                                $TotalYearOrder = $TotalYearOrder + $cleanStringA;

                                
                            }
                        ?>
                        <div class="text-primary fw-bold" style="text-align: right;margin-bottom:10px;"><a  class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">No of Sale : {{$TotalYearOrder}} </a>   <a  class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Total Sale {{$year}}: $ {{number_format($TotalYearAmount, 2, '.', '')}} AUD </a></div>
                        


                        <div class="table-responsive on-search">
                            <table class="table datatable" data-page-length="12">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Month</th>
                                        <th style="width: 150px;text-align: center;">Total Sale</th>
                                        <th style="width: 150px;text-align: center;">Total invoice</th>
                                        <th style="width: 150px;text-align: center;">Discount</th>
                                        <th style="width: 150px;text-align: center;">Total Payment</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Payments as $Payment)
                                        <tr>
                                        <td style='text-align: center;'>{{$loop->iteration}}</td>
                                        <td>{{ $monthName = DateTime::createFromFormat('!m', $Payment->month)->format('F');}}, {{ $year}}</td>
                                        <td style='text-align: center;'>{{$Payment->total_orders}}</td>
                                        <td style='text-align: center;'>$ {{number_format($Payment->total_amount, 2, '.', '')}} AUD</td>
                                        <td style='text-align: center;'>$ {{number_format($Payment->total_discount, 2, '.', '')}} AUD</td>
                                        <td style='text-align: center;'>$ {{number_format($Payment->total_payment, 2, '.', '')}} AUD</td>
                                        <td style='text-align: center;'>-</td>
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