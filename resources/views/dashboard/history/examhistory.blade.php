@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('examhistory')
    @php
        $Checkvalue = "0";
        $e_id = "2";
        $Test = "1";
        $Exam = DB::table('exams')->select('e_name','e_qt_id')->where('e_id', $e_id)->get();
        $ExamsName = $Exam->first()->e_name ?? 'No Category Found';
    @endphp
    <section class="content-panel">
        <div class="title-row">
            <div>
                <span class="title-kicker">History</span>
                <h1>Exam History</h1>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
            <div class="db-actions"><a href="/createnew/{{$e_id}}" class=" btn db-btn btn-sm">+ Create New</a></div>
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
                            <th  style="width: 30%;">Test Type <span class="sort"></span></th>
                            <th  style="width: 25%;">Date <span class="sort"></span></th>
                            <th  style="width: 10%;">Length <span class="sort"></span></th>
                            <th style="width: 10%;">Answer <span class="sort"></span></th>
                            <th  style="width: 15%;">Action <span class="sort"></span></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th >Sr #</th>
                            <th>Test Type</th>
                            <th>Date</th>
                            <th >Length</th>
                            <th >Answer</th>
                            <th >Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($Tests as $Test)
                            @if ($Test->t_type == 1)
                                @php
                                    $TestType = "Exam (ID : " . $Test->t_id.")";
                                    $StyleClass = "type-pill exam";
                                @endphp
                            @elseif ($Test->t_type == 2)
                                @php
                                    $TestType = "Revision (ID : " . $Test->t_id.")";
                                    $StyleClass = "type-pill revision";
                                @endphp
                            @endif
                            @php
                                $TestDate = Carbon::parse($Test->created_at)->format('F j, Y, g:i A');
                                $TestLenth = $Test->t_lenth;
                                $AnswerQ = $Test->t_answered;
                                $Exam2 = DB::table('exams')->select('e_name')->where('e_id', $Test->t_e_id)->get();
                                $Exam2Name = $Exam2->first()->e_name ?? 'No record';
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td style="padding-top:5px;"><span class="{{ $StyleClass }}">{{ $TestType}}</span><p class="{{ $StyleClass }}" style="font-size:11px;max-height:20px;background-color: var(--surface-soft);">{{$Exam2Name}}</p></td>
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
                                    <td  style="text-align: center;"><a href="/workboard/{{$linkDatastring}}" class="btn start-btn btn-sm" target="_blank" >Start</a></td>
                                @elseif($examType == 2)
                                    <td style="text-align: center;"><a href="/workboard_r/{{$testid}}" class=" btn start-btn revision btn-sm" target="_blank">Start_R</a></td>
                                @endif
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true
            });
        });
    </script>
@endsection