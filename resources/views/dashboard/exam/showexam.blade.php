@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('showtest')
    @php
        $Category = DB::table('exams')->select('e_name')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
    @endphp
<section class="content-panel">
  <div class="title-row">
          <div>
            <span class="title-kicker">Exam dashboard</span>
            <h1>ACEM Primary Examination</h1>
            <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
          </div>
          <div class="db-actions">
            <button class="db-btn" type="button">UpdateDB</button>
            <button class="db-btn" type="button">+ Create New</button>
          </div>
        </div>        




<div class="content-head">
          <div>
            <div class="eyebrow">Exam dashboard</div>
            <h2>Choose your exam</h2>
          </div>
          
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
          <article class="exam-card exam-card-primary">
            <div class="exam-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 5h12v14H6z"/><path d="M9 9h6"/><path d="M9 13h4"/></svg>
            </div>
            <span class="tile-badge">Popular</span>
            <div class="exam-body">
              <h3>ACEM Primary</h3>
              <p>Clinically oriented MCQs and EMQs across anatomy, physiology, pathology and pharmacology.</p>
              <div class="tile-meta">
                <span>1,800+ questions</span>
                <span>MCQ + EMQ</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="/showexam/2">Start <span>→</span></a>
            </div>
          </article>

          <article class="exam-card exam-card-blue">
            <div class="exam-icon blue">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3 19 6v5c0 5-3.2 8.5-7 10-3.8-1.5-7-5-7-10V6z"/><path d="m9 12 2 2 4-5"/></svg>
            </div>
            <span class="tile-badge">Clinical</span>
            <div class="exam-body">
              <h3>ACEM Fellowship</h3>
              <p>Scenario-based preparation across core emergency medicine systems and commonly tested themes.</p>
              <div class="tile-meta">
                <span>500+ questions</span>
                <span>27 topic areas</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="#">Start <span>→</span></a>
            </div>
          </article>

          <article class="exam-card exam-card-green">
            <div class="exam-icon green">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M7 4h10v16H7z"/><path d="M10 8h4"/><path d="M10 12h4"/><path d="M10 16h2"/></svg>
            </div>
            <span class="tile-badge">RACGP</span>
            <div class="exam-body">
              <h3>RACGP AKT</h3>
              <p>Broad general practice coverage using exam-style questions and detailed clinical explanations.</p>
              <div class="tile-meta">
                <span>700+ questions</span>
                <span>24 topic areas</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="#">Start <span>→</span></a>
            </div>
          </article>

          <article class="exam-card exam-card-pink">
            <div class="exam-icon pink">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="8"/><path d="M12 8v8"/><path d="M8 12h8"/></svg>
            </div>
            <span class="tile-badge">AMC</span>
            <div class="exam-body">
              <h3>AMC MCQ</h3>
              <p>Computer-adaptive-test preparation with clinically relevant MCQs and extended matched questions.</p>
              <div class="tile-meta">
                <span>1,000+ questions</span>
                <span>MCQ + EMQ</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="#">Start <span>→</span></a>
            </div>
          </article>

          <article class="exam-card exam-card-gold">
            <div class="exam-icon gold">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M7 5h12v14H7z"/><path d="M5 8h2"/><path d="M5 12h2"/><path d="M5 16h2"/><path d="M11 9h5"/><path d="M11 13h5"/></svg>
            </div>
            <span class="tile-badge">Recall</span>
            <div class="exam-body">
              <h3>RACGP Flash Cards</h3>
              <p>High-yield fellowship facts for spaced revision, rapid recall and personalised review.</p>
              <div class="tile-meta">
                <span>700+ cards</span>
                <span>Editable</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="#">Start <span>→</span></a>
            </div>
          </article>

          <article class="exam-card exam-card-purple">
            <div class="exam-icon purple">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M5 6h14v12H5z"/><path d="M8 10h8"/><path d="M8 14h5"/></svg>
            </div>
            <span class="tile-badge">KFP</span>
            <div class="exam-body">
              <h3>RACGP KFP</h3>
              <p>Key feature problem practice designed to strengthen clinical reasoning and prioritisation.</p>
              <div class="tile-meta">
                <span>150+ cases</span>
                <span>Detailed feedback</span>
              </div>
            </div>
            <div class="tile-footer">
              <a class="details-link" href="#">Start <span>→</span></a>
            </div>
          </article>

          
        </div>
      </section>







<div class="dashboard-card">
        <div class="title-row">
          <div>
            <span class="title-kicker">Exam dashboard</span>
            <h1>ACEM Primary Examination</h1>
            <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
          </div>
          <div class="db-actions">
            <button class="db-btn" type="button">UpdateDB</button>
            <button class="db-btn" type="button">+ Create New</button>
          </div>
        </div>

        <div class="card-body">
          <div class="summary-strip" aria-label="Exam summary">
            <div class="summary-card"><span>Total entries</span><strong>712</strong></div>
            <div class="summary-card"><span>Completed answers</span><strong>85</strong></div>
            <div class="summary-card"><span>Mode</span><strong>Exam &amp; Revision</strong></div>
          </div>

          <div class="table-toolbar">
            <label>Show
              <select id="entriesSelect" aria-label="Rows per page">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
              </select>
              entries
            </label>
            <label>Search:
              <input id="searchInput" type="search" aria-label="Search exams" />
            </label>
          </div>

          <div class="table-wrap">
            <table aria-label="ACEM Primary Examination tests">
              <thead>
                <tr>
                  <th class="col-sr">Sr # <span class="sort">↑↓</span></th>
                  <th class="col-type">Test Type <span class="sort">↑↓</span></th>
                  <th class="col-date">Date <span class="sort">↑↓</span></th>
                  <th class="col-length">Length <span class="sort">↑↓</span></th>
                  <th class="col-answer">Answer <span class="sort">↑↓</span></th>
                  <th class="col-action">Action <span class="sort">↑↓</span></th>
                </tr>
              </thead>
              <tbody id="examRows">
              <tr><td class="col-sr">1</td><td><span class="type-pill exam">Exam (ID : 223978)</span></td><td>May 23, 2026, 2:49 AM</td><td class="col-length">10</td><td class="col-answer">8</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">2</td><td><span class="type-pill revision">Revision (ID : 223971)</span></td><td>May 14, 2026, 2:12 AM</td><td class="col-length">20</td><td class="col-answer">20</td><td class="col-action"><button class="start-btn revision" type="button">Start_R</button></td></tr>
              <tr><td class="col-sr">3</td><td><span class="type-pill exam">Exam (ID : 223970)</span></td><td>May 14, 2026, 2:10 AM</td><td class="col-length">20</td><td class="col-answer">20</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">4</td><td><span class="type-pill exam">Exam (ID : 223969)</span></td><td>May 14, 2026, 2:10 AM</td><td class="col-length">10</td><td class="col-answer">0</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">5</td><td><span class="type-pill exam">Exam (ID : 223968)</span></td><td>May 14, 2026, 2:09 AM</td><td class="col-length">20</td><td class="col-answer">0</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">6</td><td><span class="type-pill exam">Exam (ID : 223967)</span></td><td>May 14, 2026, 2:08 AM</td><td class="col-length">10</td><td class="col-answer">10</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">7</td><td><span class="type-pill exam">Exam (ID : 223966)</span></td><td>May 14, 2026, 2:07 AM</td><td class="col-length">11</td><td class="col-answer">11</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">8</td><td><span class="type-pill exam">Exam (ID : 223965)</span></td><td>May 14, 2026, 2:07 AM</td><td class="col-length">3</td><td class="col-answer">3</td><td class="col-action"><button class="start-btn " type="button">Start</button></td></tr>
              <tr><td class="col-sr">9</td><td><span class="type-pill revision">Revision (ID : 223964)</span></td><td>May 14, 2026, 2:07 AM</td><td class="col-length">3</td><td class="col-answer">3</td><td class="col-action"><button class="start-btn revision" type="button">Start_R</button></td></tr>
              <tr><td class="col-sr">10</td><td><span class="type-pill revision">Revision (ID : 223963)</span></td><td>May 14, 2026, 2:06 AM</td><td class="col-length">10</td><td class="col-answer">10</td><td class="col-action"><button class="start-btn revision" type="button">Start_R</button></td></tr>
              </tbody>
              <tfoot>
                <tr>
                  <th class="col-sr">Sr #</th>
                  <th>Test Type</th>
                  <th>Date</th>
                  <th class="col-length">Length</th>
                  <th class="col-answer">Answer</th>
                  <th class="col-action">Action</th>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="table-footer">
            <div id="entrySummary">Showing 1 to 10 of 712 entries</div>
            <nav class="pagination" aria-label="Pagination">
              <a href="#" class="page-link">Previous</a>
              <a href="#" class="page-link active">1</a>
              <a href="#" class="page-link">2</a>
              <a href="#" class="page-link">3</a>
              <a href="#" class="page-link">4</a>
              <a href="#" class="page-link">5</a>
              <a href="#" class="page-link ellipsis">...</a>
              <a href="#" class="page-link">72</a>
              <a href="#" class="page-link">Next</a>
            </nav>
          </div>
        </div>
      </div>






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