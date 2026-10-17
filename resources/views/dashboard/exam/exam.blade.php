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
  <?php
    $userId = auth()->id();
    //Count the number of exams the user has subscribed to
    $subscribes = DB::table('subscribes')->where('su_u_id', $userId)->get();
    if($subscribes->count() == 0)
      $ExamCount = "Browse Exams";
    else
      $ExamCount = $subscribes->count();
    //Get the latest subscription for the user to find the selected exam
    $subscribes2 = DB::table('subscribes')->where('su_u_id', $userId)->orderByDesc('su_expdate')->first();
    $SelectedExamId = $subscribes2->su_e_id ?? null;
    //Get the reviewed questions for the selected exam
    $Reviwed = DB::table('tests_reviewed')->select('tr_questions')->where('tr_u_id', $userId)->where('tr_e_id', $SelectedExamId)->get();
    $RawData_Questions = $Reviwed->first()->tr_questions ?? 0;
    $ReviewedQuestions = explode(',', $RawData_Questions);
    $ReviewedQuestionsCount = count($ReviewedQuestions);
    // Calculate the number of days left until the subscription expires
    $DaysExpiry = "";
    if ($subscribes2) 
      {
        $expiryDate = Carbon::parse($subscribes2->su_expdate);
        $daysLeft = (int) Carbon::now()->diffInDays($expiryDate, false);
        
        if ($daysLeft > 0) 
          {
            $DaysExpiry = $daysLeft;
          }
        elseif ($daysLeft == 0)
          {
            $DaysExpiry = "Expires today!";
          } 
        else
          {
            $DaysExpiry = "<div style='color: red;font-size: 17px;'>Expired " . abs($daysLeft) . " days ago.</div>";
          }
      }
    else
      {
        $DaysExpiry = "No subscription found.";
      }
  ?>
  <div class="quick-row" aria-label="Quick stats">
    <div class="quick-card">
      <div class="quick-icon">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v18H6a2 2 0 0 1-2-1.5Z"/><path d="M8 7h7"/></svg>
      </div>
      <div><strong>{{$ExamCount}}</strong><span>Exam collections</span></div>
    </div>
    <div class="quick-card">
      <div class="quick-icon green">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
      </div>
      <div><strong>{{$ReviewedQuestionsCount}}</strong><span>Questions completed</span></div>
    </div>
    <div class="quick-card">
      <div class="quick-icon pink">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
      </div>
      <div><strong>{!! $DaysExpiry !!}</strong><span>Days left</span></div>
    </div>
  </div>
  <div class="exam-grid">
    @foreach ($Subscribes as $Subscribe)
      @php
        $Exam = DB::table('exams')->select('e_name','e_info','e_color','e_count','e_short_description','e_bolt')->where('e_id', $Subscribe->su_e_id)->get();
        $ExamName = $Exam->first()->e_name ?? 'No Category';
        $ExamInfo = $Exam->first()->e_info ?? 'No Info';
        $ExamColor = $Exam->first()->e_color ?? 'exam-card-blue';
        $ExamCount = $Exam->first()->e_count ?? '-';
        $ExamShortDescription = $Exam->first()->e_short_description ?? '-';
        $ExamBolt = $Exam->first()->e_bolt ?? '-';
      @endphp
      <article class="exam-card {{$ExamColor}}">
        <a  href="showexam/{{$Subscribe->su_e_id}}">
          <div class="exam-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 5h12v14H6z"/><path d="M9 9h6"/><path d="M9 13h4"/></svg>
          </div>
          <span class="tile-badge">{{$ExamBolt}}</span>
          <div class="exam-body">
            <h3>{{$ExamName}}</h3>
            <p>{{$ExamShortDescription}}</p>
            <div class="tile-meta">
              <span>{{$ExamCount}}</span>
              <span>{{$ExamInfo}}</span>
            </div>
          </div>
          <div class="tile-footer">
            <a class="details-link" href="/showexam/{{$Subscribe->su_e_id}}">Start <span>→</span></a>
          </div>
        </a>
      </article>
    @endforeach
  </div>
</section>
@endsection