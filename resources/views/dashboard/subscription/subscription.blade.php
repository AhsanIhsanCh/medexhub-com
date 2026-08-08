@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('subscriptions')
@include('messages')
    <section class="content-panel">
        <div class="title-row">
            <div>
                <span class="title-kicker">Subscription</span>
                <h1>Subscription</h1>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
            <div class="db-actions"></div>
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
        @if($Subscribes->count() == 0)
            <div class="alert alert-info" role="alert" style="margin-top: 15px;">
                You have no active subscriptions. Please subscribe to an exam collection to start preparing.
            </div>
        @else
            <div class="exam-grid">
                @foreach ($Subscribes as $Subscribe)
                    @php
                        $Exam = DB::table('exams')->select('e_name','e_info','e_color','e_count','e_short_description','e_bolt')->where('e_id', $Subscribe->su_e_id)->get();
                        $ExamName = $Exam->first()->e_name ?? 'No Category';
                        $JionDate = Carbon::parse($Subscribe->su_jiondate)->format('F j, Y');
                        $ExpDate = Carbon::parse($Subscribe->su_expdate)->format('F j, Y');
                        $today = now()->startOfDay();
                        $expiryDate = \Carbon\Carbon::parse($Subscribe->su_expdate)->startOfDay();
                        $isActive = $expiryDate->greaterThanOrEqualTo($today);
                        if ($isActive) 
                                {
                                    $DaysLeftA = $isActive? $today->diffInDays($expiryDate): 0;
                                    $DaysLeft = $DaysLeftA . " Days Left";
                                }
                            else 
                                {
                                    $DaysLeft = "<span style='color:#f11919 !important;'>Expired</span>";
                                }
                        $ExamColor = $Exam->first()->e_color ?? 'exam-card-blue';
                    @endphp
                    <article class="exam-card {{$ExamColor}}">
                        <a  href="showexam/{{$Subscribe->su_e_id}}">
                            <div class="exam-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 5h12v14H6z"/><path d="M9 9h6"/><path d="M9 13h4"/></svg></div>
                            <span class="tile-badge">{!! $DaysLeft !!}</span>
                            <div class="exam-body">
                                <h3>{{$ExamName}}</h3>
                                <div class="tile-meta" style="margin-top:10px !important;">
                                    <span><strong>Subscribed for</strong>  &nbsp; &nbsp; {{$Subscribe->su_for}} Months</span>
                                </div>
                                <div class="tile-meta" style="margin-top:10px !important;">
                                    <span style="background-color:#d2efd1 !important;"><strong>Subscription</strong>  &nbsp; &nbsp; {{$JionDate}}</span>
                                </div>
                                <div class="tile-meta" style="margin-top:10px !important;">
                                    <span style="background-color:#f8d4d4 !important;"><strong>Expiry Date</strong>  &nbsp; &nbsp; {{$ExpDate}}</span>
                                </div>
                            </div>
                            <div class="tile-footer">
                                @if ($isActive)
                                    <a class="details-link" href="/showexam/{{$Subscribe->su_e_id}}">Start <span>→</span></a>
                                @else
                                    <a class="details-link" href="/buyexam/{{$Subscribe->su_e_id}}">Renew subscription <span>→</span></a>
                                @endif
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
        
        
    </section>
@endsection