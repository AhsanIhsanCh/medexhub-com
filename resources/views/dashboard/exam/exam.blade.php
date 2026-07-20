@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('exam')
<section class="content-panel">
  <div class="title-row">
    <div>
      <span class="title-kicker">My Exam</span>
      <h1>Choose your exam</h1>
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
  <div class="exam-grid">
    @foreach ($Subscribes as $Subscribe)
      @php
        $Category = DB::table('exams')->select('e_name','e_info','e_color','e_count','e_short_description','e_bolt')->where('e_id', $Subscribe->su_c_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category';
        $CategoryInfo = $Category->first()->e_info ?? 'No Info';
        $CategoryColor = $Category->first()->e_color ?? 'exam-card-blue';
        $CategoryCount = $Category->first()->e_count ?? '-';
        $CategoryShortDescription = $Category->first()->e_short_description ?? '-';
        $CategoryBolt = $Category->first()->e_bolt ?? '-';
      @endphp
      <article class="exam-card {{$CategoryColor}}">
        <a  href="showexam/{{$Subscribe->su_c_id}}">
          <div class="exam-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 5h12v14H6z"/><path d="M9 9h6"/><path d="M9 13h4"/></svg>
          </div>
          <span class="tile-badge">{{$CategoryBolt}}</span>
          <div class="exam-body">
            <h3>{{$CategoryName}}</h3>
            <p>{{$CategoryShortDescription}}</p>
            <div class="tile-meta">
              <span>{{$CategoryCount}}</span>
              <span>{{$CategoryInfo}}</span>
            </div>
          </div>
          <div class="tile-footer">
            <a class="details-link" href="/showexam/{{$Subscribe->su_c_id}}">Start <span>→</span></a>
          </div>
        </a>
      </article>
    @endforeach
  </div>
</section>
@endsection