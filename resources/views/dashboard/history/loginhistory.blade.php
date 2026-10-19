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
            <div class="db-actions"></div>
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
                                $StartTime = Carbon::parse($History->created_at)->format('F j, Y, g:i A');
                                $EndTime = Carbon::parse($History->updated_at)->format('F j, Y, g:i A');
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
                                <td style="text-align: center;">
                                <?php
                                    if($History->lh_status == "0")
                                        echo "<span style='color: green;font-weight: bold;'>Online</span>";
                                    else
                                        echo $ShowDifferenceTime;
                                ?>
                                </td>
                                <td  style="text-align: center;">-</td>
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection