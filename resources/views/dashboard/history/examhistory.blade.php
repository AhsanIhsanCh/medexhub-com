@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('examhistory')
    <div class='container-fluid'>
        <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">Exam History</h1>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 20px;"></div>
        {{-- <h2>Subscription</h2> --}}
        <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Subscription</th>
                                    <th>Subscription Date</th>
                                    <th>Expiry Date</th>
                                    <th>Days Left</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Subscription</th>
                                    <th>Subscription Date</th>
                                    <th>Expiry Date</th>
                                    <th>Days Left</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                {{-- @foreach ($History as $Subscribe)
                                     
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $CategoryName }}</td>
                                        <td> {{ $JionDate }}</td>
                                        <td>{{ $ExpDate }}</td>
                                        <td>1</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach --}}
                                
                                
                            </tbody>
                        </table>
                    </div>
    </div>
@endsection