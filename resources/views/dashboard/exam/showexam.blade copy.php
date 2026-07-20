@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('showtest')
    @php
        $Category = DB::table('exams')->select('e_name')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
    @endphp
    <div class='container-fluid'>
        <div class="row">
            <div class="col-md-8">
                <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">{{ $CategoryName }}</h1>
            </div>
            <div class="col-md-4 mb-1" style="text-align: right;">
                <a href="/updatedbentry" class=" btn btn-success">UpdateDB</a>
                <a href="/createnew/{{$e_id}}" class=" btn btn-success">+ Create New</a>
            </div>
        </div>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 50px;"></div>
        {{-- <h2>Subscription</h2> --}}
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sr #</th>
                        <th>Test Type</th>
                        <th>Date</th>
                        <th>lenth</th>
                        <th>answer</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th style="text-align: center;">Sr #</th>
                        <th>Test Type</th>
                        <th>Date</th>
                        <th style="text-align: center;">lenth</th>
                        <th style="text-align: center;">answer</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($Tests as $Test)
                        @if ($Test->t_type == 1)
                            @php
                                $TestType = "Exam (id : " . $Test->t_id.")";
                            @endphp
                        @elseif ($Test->t_type == 2)
                            @php
                                $TestType = "Revision (id : " . $Test->t_id.")";
                            @endphp
                        @endif
                        @php
                            $TestDate = Carbon::parse($Test->created_at)->format('F j, Y, g:i A');
                            $TestLenth = $Test->t_lenth;
                            $AnswerQ = $Test->t_answered;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>{{ $TestType }}</td>
                            <td>{{ $TestDate }}</td>
                            <td style="text-align: center;"> {{ $TestLenth }}</td>
                            <td  style="text-align: center;">{{ $AnswerQ }}</td>
                            @php
                                $testid = $Test->t_id;
                                $examType = $Test->t_type;
                            @endphp
                            @if($examType == 1)
                                 @php
                                    $linkData = array($testid, 2);
                                    $linkDatastring = implode(",", $linkData);
                                @endphp
                                <td style="text-align: center;"><a href="/workboard/{{$linkDatastring}}" class=" btn btn-info">Start</a></td>
                            @elseif($examType == 2)
                                <td style="text-align: center;"><a href="/workboard_r/{{$testid}}" class=" btn btn-info">Start_R</a></td>
                            @endif
                        </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://assets.startbootstrap.com/js/sb-customizer.js"></script>
        <sb-customizer project="sb-admin-pro"></sb-customizer>
@endsection