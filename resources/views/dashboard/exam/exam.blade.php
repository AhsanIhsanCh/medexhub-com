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
          <div class="db-actions">
            
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







@endsection