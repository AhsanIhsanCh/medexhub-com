<section class="question-section" id="sample">
      <div class="container question-layout exam-mode-showcase">
            <div class="exam-mode-copy">
                  <div class="section-kicker">Interactive exam mode</div>
                  <h2 class="section-title">Let candidates practise in a real exam-style environment</h2>
                  <p class="section-copy">This preview brings the MCQ examination interface into the MedExHub landing page while keeping the original teal medical theme. It shows the question card, answer selection, timer, progress tracking, navigation and paid-member discussion flow.</p>
                  <div class="question-benefits">
                        <div class="question-benefit"><svg fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg>Answer cards styled like the exam page</div>
                        <div class="question-benefit"><svg fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg>Performance sidebar with timer and progress</div>
                        <div class="question-benefit"><svg fill="none" stroke="currentColor" stroke-width="2" viewbox="0 0 24 24"><path d="m5 12 4 4L19 6"></path></svg>Discussion button appears after answer submission</div>
                  </div>
                  <div class="exam-mode-note">
                        <strong>Landing-page friendly:</strong> the full MCQ layout is condensed into a polished marketing preview instead of replacing the existing MedExHub theme.
                  </div>
            </div>
            <div aria-label="MedExHub MCQ exam-mode preview" class="exam-demo-shell">
                  <div class="exam-demo-topbar">
                        <div class="exam-demo-brand">
                              <div class="exam-demo-mark">A</div>
                              <div>
                                    <div class="exam-demo-title">ACEM Primary Exam</div>
                                    <div class="exam-demo-subtitle">Examination Mode</div>
                              </div>
                        </div>
                        <div class="exam-demo-status"><span></span>Demo live</div>
                  </div>
                  <div class="exam-demo-grid">
                        <div class="exam-demo-main">
                              <div class="exam-demo-label">
                                    <span class="exam-demo-badge">Question 3</span>
                                    <span>3 of 10</span>
                              </div>
                              <div class="exam-demo-question-card">
                                    <p id="demoQuestionText">A patient develops a rapidly progressive neurodegenerative disorder after exposure to contaminated nervous tissue. Laboratory investigation does not identify bacterial DNA, viral RNA or a conventional toxin. Instead, the disease is associated with an abnormally folded protein that causes normal proteins in the brain to adopt the same harmful shape. Which infectious agent is responsible?</p>
                              </div>
                              <div class="exam-demo-answers" id="demoAnswers">
                                    <button class="exam-demo-answer" data-correct="false"><span class="exam-demo-letter">A</span><span><strong>Viroid</strong><small>Small infectious RNA molecule</small></span><span class="exam-demo-radio"></span></button>
                                    <button class="exam-demo-answer" data-correct="false"><span class="exam-demo-letter">B</span><span><strong>Virion</strong><small>Complete virus particle</small></span><span class="exam-demo-radio"></span></button>
                                    <button class="exam-demo-answer" data-correct="true"><span class="exam-demo-letter">C</span><span><strong>Prion</strong><small>Infectious misfolded protein</small></span><span class="exam-demo-radio"></span></button>
                                    <button class="exam-demo-answer" data-correct="false"><span class="exam-demo-letter">D</span><span><strong>Virus</strong><small>Nucleic acid-based infectious agent</small></span><span class="exam-demo-radio"></span></button>
                              </div>
                              <div class="exam-demo-feedback" id="demoFeedback" role="status"></div>
                              <div class="exam-demo-actions">
                                    <button class="btn btn-light btn-sm" disabled="" id="demoSubmit">Submit answer</button>
                                    <button class="btn btn-ghost btn-sm" id="demoClear">Clear</button>
                                    <button class="btn btn-secondary btn-sm exam-demo-discussion-btn" hidden="" id="demoDiscussionBtn">Discussion</button>
                              </div>
                              <div class="exam-demo-discussion" hidden="" id="demoDiscussion">
                                    <div class="exam-demo-discussion-head">
                                          <div>
                                                <strong>Question discussion</strong>
                                                <span>Paid members can compare reasoning and ask follow-up questions.</span>
                                          </div>
                                          <span class="exam-demo-paid-pill">Paid</span>
                                    </div>
                                    <div class="exam-demo-post">
                                          <div class="exam-demo-votes">▲<strong>24</strong>▼</div>
                                          <p><strong>MedExHub Educator:</strong> The key clue is an infectious protein with no nucleic acid. That distinguishes a prion from viruses, virions and viroids.</p>
                                    </div>
                                    <div class="exam-demo-post">
                                          <div class="exam-demo-votes">▲<strong>11</strong>▼</div>
                                          <p><strong>ClinicalLearner92:</strong> I initially chose virus, but the stem specifically says no viral RNA, so prion is the better answer.</p>
                                    </div>
                              </div>
                        </div>
                        <aside class="exam-demo-sidebar">
                              <div class="exam-demo-side-card">
                                    <h3><span>◷</span>Timer</h3>
                                    <div class="exam-demo-timer-row"><div><small>Time remaining</small><strong id="timerText">05:57</strong></div><div class="exam-demo-ring"></div></div>
                              </div>
                              <div class="exam-demo-side-card">
                                    <h3><span>✓</span>Progress</h3>
                                    <div class="exam-demo-progress-row">
                                          <div class="exam-demo-donut"><strong id="demoProgressPercent">20%</strong><small>completed</small></div>
                                          <div class="exam-demo-stats">
                                                <span><i class="green"></i>Answered <strong id="demoAnsweredCount">2</strong></span>
                                                <span><i class="amber"></i>Skipped <strong>0</strong></span>
                                                <span><i class="grey"></i>Remaining <strong id="demoRemainingCount">8</strong></span>
                                          </div>
                                    </div>
                              </div>
                              <div class="exam-demo-side-card">
                                    <h3><span>#</span>Navigation</h3>
                                    <div class="exam-demo-nav">
                                          <button class="done">1</button>
                                          <button class="done">2</button>
                                          <button class="current">3</button>
                                          <button>4</button>
                                          <button>5</button>
                                          <button>6</button>
                                          <button>7</button>
                                          <button>8</button>
                                          <button>9</button>
                                          <button>10</button>
                                    </div>
                              </div>
                        </aside>
                  </div>
            </div>
      </div>
</section>