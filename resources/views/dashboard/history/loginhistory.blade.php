@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('loginhistory')
    <section class="content-panel">
        <div class="title-row">
            <div>
                <span class="title-kicker">History</span>
                <h1>Login History</h1>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
            <div class="db-actions"><a href="/createnew/" class=" btn db-btn btn-sm">+ Create New</a></div>
        </div>
        <div class="quick-row" aria-label="Quick stats">
            <div class="quick-card">
                <div class="quick-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v18H6a2 2 0 0 1-2-1.5Z"/><path d="M8 7h7"/></svg>
                </div>
                <div><strong>8</strong><span>Exam collections</span></div>
            </div>
            <div class="quick-card">
                <div class="quick-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
                <div><strong>1,240</strong><span>Questions completed</span></div>
            </div>
            <div class="quick-card">
                <div class="quick-icon pink">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
                </div>
                <div><strong>15</strong><span>Days left</span></div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-wrap">
                <table id="dataTable" >
                    <thead>
                        <tr>
                            <th  style="width: 10%;">Sr # <span class="sort"></span></th>
                            <th  style="width: 30%;">Login Time <span class="sort"></span></th>
                            <th  style="width: 25%;">Logout Time <span class="sort"></span></th>
                            <th  style="width: 10%;">Spending Time <span class="sort"></span></th>
                            <th style="width: 10%;">Detail <span class="sort"></span></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th >Sr #</th>
                            <th>Login Time</th>
                            <th>Logout Time</th>
                            <th >Spending Time</th>
                            <th >Detail</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($LHistorys as $History)
                            @php
                                $StyleClass = "1";
                                $StartTime = Carbon::parse($History->lh_start_datetime)->format('F j, Y, g:i A');
                                $EndTime = Carbon::parse($History->lh_end_datetime)->format('F j, Y, g:i A');
                                $diff = abs(strtotime($EndTime) - strtotime($StartTime)); 
                                $years   = floor($diff / (365*60*60*24)); 
                                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                                $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                                $seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60));
                                $ShowDifferenceTime = "";
                                if($years != 0)
                                    $ShowDifferenceTime .= $years." Years ";
                                if($months != 0)
                                    $ShowDifferenceTime .= $months." Months ";
                                if($days != 0)
                                    $ShowDifferenceTime .= $days." Days ";
                                if($hours != 0)
                                    $ShowDifferenceTime .= $hours." Hours ";
                                if($minuts != 0)
                                    $ShowDifferenceTime .= $minuts." Minuts ";
                                if($seconds != 0)
                                    $ShowDifferenceTime .= $seconds." Seconds ";
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td>{{$StartTime}}</td>
                                <td>{{$EndTime}}</td>
                                <td style="text-align: center;"> {{ $ShowDifferenceTime }}</td>
                                <td  style="text-align: center;">-</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection