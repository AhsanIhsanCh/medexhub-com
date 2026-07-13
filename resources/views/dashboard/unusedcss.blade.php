  <style>
    

  

  






  

    .page-shell {
      width: min(calc(100% - 48px), var(--container));
      margin: 54px auto 52px;
      display: grid;
      grid-template-columns: 270px minmax(0, 1fr);
      gap: 30px;
      align-items: start;
    }

    .sidebar {
      position: sticky;
      top: 104px;
      background: rgba(255,255,255,.92);
      border: 1px solid rgba(220,232,229,.95);
      border-radius: var(--radius-md);
      box-shadow: var(--shadow-sm);
      overflow: hidden;
    }
    .sidebar-head {
      padding: 18px 20px;
      background: linear-gradient(135deg, #eff9f6, #eef6ff);
      border-bottom: 1px solid var(--line);
    }
    .sidebar-head strong { display: block; font-size: 14px; letter-spacing: -.01em; }
    .sidebar-head span { display: block; margin-top: 4px; color: #6d8794; font-size: 12px; }
    .side-item {
      min-height: 54px;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 0 18px;
      border-bottom: 1px solid #e7efed;
      color: #355269;
      font-weight: 700;
      position: relative;
      transition: background .18s ease, color .18s ease;
    }
    .side-item:last-child { border-bottom: 0; }
    .side-icon {
      width: 30px;
      height: 30px;
      border-radius: 10px;
      display: grid;
      place-items: center;
      color: var(--primary);
      background: var(--primary-soft);
      flex: none;
    }
    .side-icon svg { width: 15px; height: 15px; }
    .side-item .chevron { margin-left: auto; color: #8aa0aa; font-size: 18px; line-height: 1; }
    .side-item:hover { background: #f7fbfa; color: var(--primary-dark); }
    .side-item.active {
      color: #fff;
      background: linear-gradient(135deg, var(--primary), var(--blue));
      box-shadow: inset 4px 0 0 rgba(255,255,255,.35);
    }
    .side-item.active .side-icon { color: #fff; background: rgba(255,255,255,.18); }
    .side-item.active .chevron { color: #fff; }

    .content { min-width: 0; }
    .dashboard-card {
      position: relative;
      overflow: hidden;
      background: rgba(255,255,255,.96);
      border: 1px solid rgba(199,220,216,.86);
      border-radius: var(--radius-lg);
      box-shadow: var(--shadow-md);
    }
    .dashboard-card::before {
      content: "";
      position: absolute;
      width: 260px;
      height: 260px;
      right: -115px;
      top: -145px;
      border-radius: 50%;
      background: rgba(20,125,112,.06);
      box-shadow: 0 0 0 58px rgba(55,120,194,.035);
      pointer-events: none;
    }

    .title-row {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: end;
      gap: 20px;
      padding: 28px 30px 20px;
      border-bottom: 1px solid var(--line);
      background:
        radial-gradient(circle at 95% 20%, rgba(55,120,194,.10), transparent 28%),
        linear-gradient(135deg, rgba(232,247,244,.72), rgba(237,245,255,.70));
    }
    .title-kicker {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: var(--primary-dark);
      background: rgba(255,255,255,.78);
      border: 1px solid #cfeae5;
      padding: 7px 11px;
      border-radius: 999px;
      font-size: 12px;
      font-weight: 850;
      margin-bottom: 12px;
    }
    .title-kicker::before { content: ""; width: 8px; height: 8px; background: var(--primary); border-radius: 50%; box-shadow: 0 0 0 4px rgba(20,125,112,.14); }
    h1 {
      margin: 0;
      color: #153347;
      font-size: clamp(25px, 2.45vw, 34px);
      font-weight: 850;
      letter-spacing: -0.04em;
      line-height: 1.1;
    }
    .title-subtitle { margin: 8px 0 0; color: var(--ink-soft); font-size: 14px; line-height: 1.55; }
    .db-actions { display: flex; flex-wrap: wrap; gap: 9px; justify-content: flex-end; }
    .db-btn {
      border: 0;
      background: var(--success);
      color: #fff;
      border-radius: 12px;
      min-height: 42px;
      padding: 0 16px;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 10px 21px rgba(46,125,89,.19);
    }
    .db-btn:hover { background: #236b4b; }

    .card-body { padding: 26px 30px 30px; position: relative; z-index: 1; }
    .summary-strip {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 14px;
      margin-bottom: 22px;
    }
    .summary-card {
      border: 1px solid #e4edeb;
      border-radius: 18px;
      padding: 16px;
      background: #fff;
      box-shadow: 0 6px 18px rgba(28,75,73,.045);
    }
    .summary-card span { display: block; color: #7e959e; text-transform: uppercase; letter-spacing: .08em; font-size: 10px; font-weight: 850; }
    .summary-card strong { display: block; margin-top: 6px; font-size: 20px; letter-spacing: -.02em; }

    .table-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 14px;
      gap: 16px;
      color: #355269;
    }
    .table-toolbar label { display: flex; align-items: center; gap: 7px; white-space: nowrap; font-weight: 650; }
    select, input[type="search"] {
      height: 36px;
      border: 1px solid #d8e6e2;
      border-radius: 10px;
      background: #fff;
      color: #303846;
      font-size: 14px;
      outline: none;
      transition: border-color .18s ease, box-shadow .18s ease;
    }
    select { padding: 0 9px; }
    input[type="search"] { width: 220px; padding: 0 11px; }
    select:focus, input[type="search"]:focus { border-color: #a9d5cd; box-shadow: 0 0 0 4px rgba(20,125,112,.10); }

    .table-wrap {
      overflow-x: auto;
      border: 1px solid var(--line);
      border-radius: 18px;
      background: #fff;
      box-shadow: 0 6px 24px rgba(28,75,73,.04);
    }
    table {
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
      min-width: 880px;
      table-layout: fixed;
      background: #fff;
    }
    th, td {
      border-right: 1px solid var(--line);
      border-bottom: 1px solid var(--line);
      padding: 0 13px;
      height: 58px;
      vertical-align: middle;
    }
    th:last-child, td:last-child { border-right: 0; }
    thead th {
      height: 50px;
      text-align: left;
      color: #28475a;
      font-weight: 850;
      background: linear-gradient(180deg, #fbfefe 0%, #f3f9f7 100%);
      white-space: nowrap;
      position: relative;
    }
    th .sort { position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #b8c5ca; font-size: 14px; font-weight: 400; letter-spacing: -3px; }
    tbody tr { transition: background .16s ease; }
    tbody tr:hover { background: #f9fcfb; }
    td { color: #314657; }
    tfoot th { height: 46px; font-weight: 850; border-bottom: 0; background: #fbfefe; color: #28475a; }
    tbody tr:last-child td { border-bottom: 1px solid var(--line); }

    .col-sr { width: 100px; text-align: center; }
    .col-type { width: 255px; }
    .col-date { width: 315px; }
    .col-length { width: 116px; text-align: center; }
    .col-answer { width: 140px; text-align: center; }
    .col-action { width: 150px; text-align: center; }
    th.col-sr, th.col-length, th.col-answer, th.col-action { text-align: left; }

    .type-pill {
      display: inline-flex;
      align-items: center;
      padding: 7px 10px;
      border-radius: 999px;
      border: 1px solid #dce8e5;
      color: #355269;
      background: #f8faf9;
      font-weight: 700;
      font-size: 13px;
    }
    .type-pill.exam { background: var(--blue-soft); border-color: #d8e8fb; color: #285f91; }
    .type-pill.revision { background: var(--primary-soft); border-color: #cfeae5; color: var(--primary-dark); }
    .start-btn {
      border: 0;
      background: linear-gradient(135deg, var(--primary), #1aa9b8);
      color: white;
      min-height: 36px;
      min-width: 72px;
      padding: 0 14px;
      border-radius: 10px;
      font-size: 14px;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 7px 16px rgba(20,125,112,.18);
    }
    .start-btn.revision { background: linear-gradient(135deg, var(--blue), var(--primary)); }
    .start-btn:hover { filter: brightness(.97); transform: translateY(-1px); }

    .table-footer { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-top: 14px; color: #496276; }
    .pagination { display: flex; align-items: center; justify-content: flex-end; flex-wrap: wrap; }
    .page-link {
      height: 36px;
      min-width: 35px;
      padding: 0 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid var(--line);
      border-left: 0;
      color: var(--primary-dark);
      background: #fff;
      font-size: 14px;
      font-weight: 700;
      text-decoration: none;
    }
    .page-link:first-child { border-left: 1px solid var(--line); border-top-left-radius: 10px; border-bottom-left-radius: 10px; color: #6f7f89; }
    .page-link:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }
    .page-link.active { background: var(--primary); color: #fff; border-color: var(--primary); box-shadow: 0 0 0 4px rgba(20,125,112,.12); z-index: 1; }
    .page-link.ellipsis { color: #747b86; }

    @media (max-width: 1080px) {
      .nav { gap: 20px; }
      .page-shell { grid-template-columns: 1fr; width: min(100% - 32px, 1100px); margin-top: 32px; }
      .sidebar { position: static; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); }
      .sidebar-head { display: none; }
      .side-item { border-right: 1px solid #e7efed; }
    }
    @media (max-width: 860px) {
      .topbar { display: none; }
      .nav-shell { min-height: auto; padding-block: 14px; flex-wrap: wrap; }
      .nav { order: 3; width: 100%; margin: 0; justify-content: center; flex-wrap: wrap; gap: 18px; }
      .header-actions { margin-left: auto; }
      .summary-strip { grid-template-columns: 1fr; }
    }
    @media (max-width: 680px) {
      .brand img { width: 150px; }
      .header-actions { width: 100%; }
      .header-actions .btn { flex: 1; min-width: 0; }
      .sidebar { grid-template-columns: 1fr; }
      .side-item { border-right: 0; }
      .title-row { align-items: stretch; flex-direction: column; padding: 22px; }
      .db-actions { justify-content: flex-start; }
      .card-body { padding: 20px; }
      .table-toolbar, .table-footer { flex-direction: column; align-items: flex-start; }
      input[type="search"] { width: 100%; }
    }
    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after { scroll-behavior: auto !important; transition: none !important; animation: none !important; }
    }
  

    /* Dashboard sidebar imported for My Exam Log */
    :root {
      --muted: var(--ink-soft);
      --blue-2: #145fe6;
      --panel: rgba(255, 255, 255, 0.86);
    }

    .page-shell {
      grid-template-columns: 304px minmax(0, 1fr);
    }

    .sidebar {
      position: sticky;
      top: 104px;
      background: rgba(255,255,255,.97);
      border: 1px solid #dce8e5;
      border-radius: 26px;
      box-shadow: var(--shadow-sm);
      overflow: hidden;
      backdrop-filter: blur(12px);
    }

    .sidebar-user {
      padding: 22px;
      background: linear-gradient(135deg, #eff9f6, #eef6ff);
      display: flex;
      align-items: center;
      gap: 14px;
      border-bottom: 1px solid #e5eeeb;
    }

    .avatar {
      width: 46px;
      height: 46px;
      border-radius: 16px;
      background: linear-gradient(145deg, var(--primary), var(--blue));
      display: grid;
      place-items: center;
      color: #fff;
      font-weight: 900;
      box-shadow: 0 10px 22px rgba(20,125,112,.18);
      flex: 0 0 46px;
    }

    .sidebar-user strong {
      display: block;
      font-size: 15px;
      letter-spacing: -0.02em;
    }

    .sidebar-user span {
      display: block;
      margin-top: 4px;
      color: var(--ink-soft);
      font-size: 12px;
      font-weight: 700;
    }

    .side-menu {
      list-style: none;
      padding: 10px;
      margin: 0;
    }

    .side-menu li + li {
      margin-top: 5px;
    }

    .side-link {
      display: flex;
      align-items: center;
      gap: 13px;
      padding: 15px 14px;
      border-radius: 14px;
      color: #425d70;
      font-weight: 700;
      transition: background .18s ease, color .18s ease, transform .18s ease;
    }

    .side-link svg {
      width: 19px;
      height: 19px;
      flex: 0 0 19px;
    }

    .side-link .chev {
      margin-left: auto;
      opacity: .45;
    }

    .side-link:hover {
      background: var(--primary-soft);
      color: var(--primary-dark);
      transform: translateX(2px);
    }

    .side-link.active {
      color: #fff;
      background: var(--primary);
      box-shadow: 0 12px 24px rgba(20,125,112,.22);
    }

    .support-card {
      margin: 12px 20px 22px;
      border-radius: 18px;
      padding: 20px;
      background:
        radial-gradient(circle at 90% 0%, rgba(55,120,194,.12), transparent 34%),
        linear-gradient(135deg, #eff9f6, #eef6ff);
      border: 1px solid #dbeae7;
    }

    .support-card strong {
      display: block;
      letter-spacing: -0.02em;
      margin-bottom: 8px;
    }

    .support-card p {
      color: var(--ink-soft);
      margin: 0 0 16px;
      font-size: 13px;
      line-height: 1.5;
    }

    .support-card button {
      width: 100%;
      height: 42px;
      border-radius: 999px;
      background: #fff;
      color: var(--primary-dark);
      font-weight: 800;
      cursor: pointer;
      border: 1px solid #cfe8e3;
      box-shadow: 0 8px 18px rgba(20,125,112,.10);
    }

    @media (max-width: 1080px) {
      .page-shell {
        grid-template-columns: 1fr;
      }

      .sidebar {
        position: relative;
        top: 0;
        display: block;
      }

      .side-menu {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }

      .side-menu li + li {
        margin-top: 0;
      }

      .support-card {
        display: none;
      }
    }

    @media (max-width: 860px) {
      .side-menu {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 680px) {
      .side-menu {
        grid-template-columns: 1fr;
      }
    }


    /* My Exam setup tile replacing the Exam Dashboard table; curriculum panel placed on the left */
    .exam-builder {
      width: 100%;
    }

    .exam-builder-grid {
      display: grid;
      grid-template-columns: minmax(470px, 1.12fr) minmax(360px, .88fr);
      gap: 24px;
      align-items: start;
    }

    .setup-stack {
      display: grid;
      gap: 16px;
      align-self: stretch;
    }

    .setup-panel,
    .curriculum-panel {
      border-radius: 22px;
      border: 1px solid rgba(184, 217, 211, .9);
      background: rgba(255, 255, 255, .94);
      box-shadow: 0 16px 42px rgba(24, 70, 68, 0.09);
      backdrop-filter: blur(12px);
    }

    .setup-panel {
      position: relative;
      overflow: hidden;
      min-height: 116px;
      padding: 20px 22px 22px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-left: 5px solid rgba(20, 125, 112, .82);
      background:
        radial-gradient(circle at 98% 0%, rgba(55, 120, 194, .10), transparent 34%),
        linear-gradient(135deg, #ffffff 0%, #f7fcfb 100%);
      transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .setup-panel:hover {
      transform: translateY(-2px);
      border-color: #b6d9d2;
      box-shadow: 0 22px 52px rgba(24, 70, 68, 0.13);
    }

    .setup-panel::after {
      content: "";
      position: absolute;
      right: -28px;
      top: -42px;
      width: 130px;
      height: 130px;
      border-radius: 50%;
      background: rgba(20, 125, 112, .055);
      pointer-events: none;
    }

    .setup-stack .setup-panel:nth-child(2) { border-left-color: rgba(55, 120, 194, .82); }
    .setup-stack .setup-panel:nth-child(3) { border-left-color: rgba(46, 125, 89, .82); }
    .setup-stack .setup-panel:nth-child(4) { border-left-color: rgba(220, 174, 42, .92); }

    .setup-panel h3,
    .curriculum-panel h3 {
      margin: 0;
      color: #153347;
      font-size: 17px;
      line-height: 1.2;
      font-weight: 850;
      letter-spacing: -.02em;
    }

    .setup-panel h3 {
      display: flex;
      align-items: center;
      gap: 10px;
      position: relative;
      z-index: 1;
    }

    .setup-panel h3::before {
      width: 28px;
      height: 28px;
      border-radius: 10px;
      display: inline-grid;
      place-items: center;
      background: var(--primary-soft);
      color: var(--primary-dark);
      font-size: 12px;
      font-weight: 900;
      box-shadow: inset 0 0 0 1px rgba(20, 125, 112, .13);
      flex: 0 0 auto;
    }

    .setup-stack .setup-panel:nth-child(1) h3::before { content: "1"; }
    .setup-stack .setup-panel:nth-child(2) h3::before { content: "2"; background: var(--blue-soft); color: #285f91; }
    .setup-stack .setup-panel:nth-child(3) h3::before { content: "3"; background: #eef8ef; color: #2f6f38; }
    .setup-stack .setup-panel:nth-child(4) h3::before { content: "4"; background: #fff7df; color: #916c0d; }

    .option-row {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
      padding: 14px 0 0;
    }

    .setup-panel.compact .option-row {
      padding-left: 0;
      gap: 10px;
    }

    .option-label,
    .tree-label {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #2e4151;
      font-size: 14px;
      line-height: 1.25;
      cursor: pointer;
      user-select: none;
    }

    .option-label {
      min-height: 46px;
      padding: 11px 13px;
      border: 1px solid #dbe9e5;
      border-radius: 14px;
      background: rgba(255,255,255,.82);
      box-shadow: 0 6px 15px rgba(24,70,68,.035);
      font-weight: 700;
      transition: background .16s ease, border-color .16s ease, box-shadow .16s ease, transform .16s ease;
    }

    .option-label:hover {
      background: #f4fbf9;
      border-color: #badbd4;
      transform: translateY(-1px);
    }

    .option-label:has(input:checked) {
      background: linear-gradient(135deg, #e8f7f4, #edf5ff);
      border-color: #7fc8bc;
      color: var(--primary-dark);
      box-shadow: 0 10px 22px rgba(20,125,112,.10);
    }

    .option-label input,
    .tree-label input {
      width: 15px;
      height: 15px;
      margin: 0;
      accent-color: var(--primary);
      flex: 0 0 auto;
    }

    .setup-panel .helper-text {
      position: relative;
      z-index: 1;
      margin: 15px 0 0;
      color: #587082;
      font-size: 14px;
      line-height: 1.45;
      padding: 12px 14px;
      border-radius: 14px;
      background: #f8fbfa;
      border: 1px dashed #cfe4df;
    }

    .question-count-options {
      position: relative;
      z-index: 1;
      display: none;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 14px;
      padding-left: 0;
    }

    .question-count-options.visible {
      display: flex;
    }

    .count-choice {
      border: 1px solid #cfe4df;
      background: #fff;
      color: #21556b;
      border-radius: 999px;
      min-height: 38px;
      min-width: 56px;
      padding: 0 16px;
      font-weight: 800;
      cursor: pointer;
      box-shadow: 0 6px 15px rgba(24,70,68,.04);
      transition: background .16s ease, color .16s ease, border-color .16s ease, transform .16s ease;
    }

    .count-choice:hover,
    .count-choice.selected {
      background: var(--primary);
      color: #fff;
      border-color: var(--primary);
      transform: translateY(-1px);
    }

    .curriculum-panel {
      padding: 18px 18px 16px;
      background:
        radial-gradient(circle at 95% 0%, rgba(55,120,194,.09), transparent 30%),
        linear-gradient(135deg, rgba(255,255,255,.98), rgba(239,249,246,.94));
    }

    .curriculum-panel h3 {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .curriculum-panel h3::before {
      content: "";
      width: 9px;
      height: 9px;
      border-radius: 999px;
      background: var(--primary);
      box-shadow: 0 0 0 5px rgba(20,125,112,.12);
    }

    .curriculum-note {
      margin: 7px 0 13px 2px;
      color: #c80f0f;
      font-size: 13px;
      line-height: 1.25;
    }

    .curriculum-group-title {
      min-height: 34px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      padding: 0 14px;
      border-radius: 11px;
      background: linear-gradient(135deg, #5ab5e9, #3778c2);
      color: #fff;
      font-size: 14px;
      font-weight: 750;
      box-shadow: 0 9px 18px rgba(55,120,194,.15);
    }

    .caret {
      font-size: 12px;
      line-height: 1;
      opacity: .95;
      margin-left: auto;
    }

    .tree-list {
      margin-top: 9px;
      display: grid;
      gap: 5px;
    }

    .tree-row {
      display: grid;
      grid-template-columns: 1fr auto;
      align-items: center;
      column-gap: 10px;
      min-height: 27px;
      padding: 0 11px 0 12px;
      color: #2e363d;
      font-size: 13px;
      border-radius: 10px;
      transition: background .16s ease;
    }

    .tree-row:hover {
      background: rgba(232,247,244,.76);
    }

    .tree-row.parent {
      margin-top: 5px;
      font-weight: 750;
    }

    .tree-row.child {
      padding-left: 34px;
    }

    .tree-row.plain {
      padding-left: 12px;
      font-weight: 750;
    }

    .tree-row .caret {
      color: #26323a;
      font-size: 11px;
    }

    .tree-row input[type="checkbox"] {
      width: 14px;
      height: 14px;
      margin: 0;
      accent-color: var(--primary);
    }

    @media (max-width: 1180px) {
      .exam-builder-grid {
        grid-template-columns: 1fr;
      }
      .setup-stack {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 760px) {
      .setup-stack {
        grid-template-columns: 1fr;
      }
      .option-row,
      .setup-panel.compact .option-row {
        grid-template-columns: 1fr;
      }
    }

    @media (max-width: 680px) {
      .setup-panel,
      .curriculum-panel {
        border-radius: 18px;
      }
      .setup-panel {
        min-height: 0;
        padding: 18px;
      }
      .tree-row.child {
        padding-left: 24px;
      }
    }




    /* Alternative CSS for the right-side exam option tiles */
    .exam-builder-grid {
      grid-template-columns: minmax(470px, 1.1fr) minmax(390px, .9fr);
      gap: 28px;
    }

    .setup-stack {
      gap: 14px;
    }

    .setup-panel {
      min-height: 0;
      padding: 0;
      overflow: hidden;
      justify-content: flex-start;
      border: 1px solid rgba(207, 228, 223, .95);
      border-left: 1px solid rgba(207, 228, 223, .95);
      border-radius: 20px;
      background: linear-gradient(180deg, rgba(255,255,255,.98) 0%, rgba(247,252,251,.96) 100%);
      box-shadow: 0 12px 30px rgba(24, 70, 68, .075);
    }

    .setup-panel:hover {
      transform: translateY(-1px);
      border-color: rgba(127, 200, 188, .95);
      box-shadow: 0 18px 40px rgba(24, 70, 68, .11);
    }

    .setup-panel::after {
      content: none;
    }

    .setup-panel::before {
      content: "";
      display: block;
      height: 4px;
      width: 100%;
      background: linear-gradient(90deg, var(--primary), rgba(55,120,194,.92));
    }

    .setup-stack .setup-panel:nth-child(2)::before {
      background: linear-gradient(90deg, #3778c2, #65b7e8);
    }

    .setup-stack .setup-panel:nth-child(3)::before {
      background: linear-gradient(90deg, #2e7d59, #77bf7b);
    }

    .setup-stack .setup-panel:nth-child(4)::before {
      background: linear-gradient(90deg, #dcae2a, #f0ca63);
    }

    .setup-panel h3 {
      padding: 17px 18px 10px;
      color: #173047;
      font-size: 15.5px;
      font-weight: 850;
      letter-spacing: -.01em;
      border-bottom: 1px solid rgba(220, 232, 229, .72);
      background: rgba(255, 255, 255, .68);
    }

    .setup-panel h3::before {
      width: 30px;
      height: 30px;
      border-radius: 999px;
      color: #fff;
      background: linear-gradient(135deg, var(--primary), var(--blue));
      box-shadow: 0 8px 16px rgba(20, 125, 112, .18);
      font-size: 12px;
    }

    .setup-stack .setup-panel:nth-child(2) h3::before {
      background: linear-gradient(135deg, #3778c2, #65b7e8);
      color: #fff;
    }

    .setup-stack .setup-panel:nth-child(3) h3::before {
      background: linear-gradient(135deg, #2e7d59, #77bf7b);
      color: #fff;
    }

    .setup-stack .setup-panel:nth-child(4) h3::before {
      background: linear-gradient(135deg, #dcae2a, #f0ca63);
      color: #fff;
    }

    .option-row {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      padding: 14px 18px 18px;
    }

    .setup-panel.compact .option-row {
      padding: 14px 18px 18px;
    }

    .option-label {
      flex: 1 1 150px;
      min-height: 46px;
      padding: 10px 13px;
      border-radius: 999px;
      border: 1px solid #d8e8e4;
      background: #fff;
      color: #334b5d;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.75), 0 7px 18px rgba(24,70,68,.04);
      font-size: 13.5px;
      font-weight: 780;
      justify-content: flex-start;
    }

    .option-label:hover {
      background: #f5fbfa;
      border-color: #aacfc8;
      transform: translateY(-1px);
      box-shadow: 0 10px 22px rgba(24,70,68,.075);
    }

    .option-label:has(input:checked) {
      background: linear-gradient(135deg, var(--primary), #1aa9b8);
      border-color: transparent;
      color: #fff;
      box-shadow: 0 12px 24px rgba(20,125,112,.18);
    }

    .option-label input {
      width: 16px;
      height: 16px;
      accent-color: var(--primary);
      background: #fff;
    }

    .option-label:has(input:checked) input {
      accent-color: #fff;
    }

    .setup-panel .helper-text {
      margin: 14px 18px 0;
      padding: 11px 13px;
      border: 1px solid rgba(207, 228, 223, .9);
      border-radius: 14px;
      background: #f4faf8;
      color: #547084;
      font-size: 13.5px;
    }

    .question-count-options {
      padding: 0 18px 18px;
      margin-top: 13px;
      gap: 9px;
    }

    .count-choice {
      min-width: 54px;
      min-height: 38px;
      border-radius: 12px;
      border-color: #d6e8e4;
      color: #173047;
      background: #fff;
      box-shadow: 0 7px 16px rgba(24,70,68,.045);
    }

    .count-choice:hover,
    .count-choice.selected {
      background: linear-gradient(135deg, var(--primary), #1aa9b8);
      border-color: transparent;
      color: #fff;
      box-shadow: 0 12px 24px rgba(20,125,112,.17);
    }

    @media (max-width: 1180px) {
      .exam-builder-grid {
        grid-template-columns: 1fr;
      }

      .setup-stack {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 760px) {
      .setup-stack {
        grid-template-columns: 1fr;
      }

      .option-row,
      .setup-panel.compact .option-row {
        display: grid;
        grid-template-columns: 1fr;
      }

      .option-label {
        flex-basis: auto;
      }
    }


    /* Matching modern card style for Select Curriculum */
    .curriculum-panel {
      position: relative;
      overflow: hidden;
      padding: 0;
      border: 1px solid rgba(207, 228, 223, .95);
      border-radius: 20px;
      background: linear-gradient(180deg, rgba(255,255,255,.98) 0%, rgba(247,252,251,.96) 100%);
      box-shadow: 0 12px 30px rgba(24, 70, 68, .075);
      transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease;
    }

    .curriculum-panel:hover {
      transform: translateY(-1px);
      border-color: rgba(127, 200, 188, .95);
      box-shadow: 0 18px 40px rgba(24, 70, 68, .11);
    }

    .curriculum-panel::before {
      content: "";
      display: block;
      height: 4px;
      width: 100%;
      background: linear-gradient(90deg, var(--primary), rgba(55,120,194,.92));
    }

    .curriculum-panel::after {
      content: "";
      position: absolute;
      right: -44px;
      top: -64px;
      width: 170px;
      height: 170px;
      border-radius: 50%;
      background: rgba(20, 125, 112, .05);
      pointer-events: none;
    }

    .curriculum-panel h3 {
      position: relative;
      z-index: 1;
      display: flex;
      align-items: center;
      gap: 10px;
      margin: 0;
      padding: 17px 18px 10px;
      color: #173047;
      font-size: 15.5px;
      font-weight: 850;
      letter-spacing: -.01em;
      border-bottom: 1px solid rgba(220, 232, 229, .72);
      background: rgba(255, 255, 255, .68);
    }

    .curriculum-panel h3::before {
      content: "C";
      width: 30px;
      height: 30px;
      border-radius: 999px;
      display: inline-grid;
      place-items: center;
      color: #fff;
      background: linear-gradient(135deg, var(--primary), var(--blue));
      box-shadow: 0 8px 16px rgba(20, 125, 112, .18);
      font-size: 12px;
      font-weight: 900;
      flex: 0 0 auto;
    }

    .curriculum-note {
      position: relative;
      z-index: 1;
      margin: 14px 18px 16px;
      padding: 12px 14px;
      border: 1px solid rgba(220, 174, 42, .28);
      border-radius: 14px;
      background: linear-gradient(135deg, #fffaf0, #f7fcfb);
      color: #5c6f7d;
      font-size: 13.5px;
      line-height: 1.45;
      box-shadow: inset 4px 0 0 rgba(220, 174, 42, .68);
    }

    .curriculum-group-title {
      position: relative;
      z-index: 1;
      min-height: 44px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin: 0 18px 12px;
      padding: 0 15px;
      border-radius: 15px;
      background: linear-gradient(135deg, var(--primary), #1aa9b8);
      color: #fff;
      font-size: 14px;
      font-weight: 850;
      box-shadow: 0 12px 24px rgba(20,125,112,.18);
    }

    .tree-list {
      position: relative;
      z-index: 1;
      margin: 0;
      padding: 0 18px 18px;
      display: grid;
      gap: 8px;
    }

    .tree-row {
      display: grid;
      grid-template-columns: minmax(0, 1fr) auto;
      align-items: center;
      column-gap: 10px;
      min-height: 42px;
      padding: 8px 12px;
      border: 1px solid #d8e8e4;
      border-radius: 14px;
      background: #fff;
      color: #334b5d;
      font-size: 13.5px;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.75), 0 7px 18px rgba(24,70,68,.04);
      transition: background .16s ease, border-color .16s ease, box-shadow .16s ease, transform .16s ease, color .16s ease;
    }

    .tree-row:hover {
      background: #f5fbfa;
      border-color: #aacfc8;
      transform: translateY(-1px);
      box-shadow: 0 10px 22px rgba(24,70,68,.075);
    }

    .tree-row.parent {
      margin-top: 4px;
      font-weight: 850;
      background: linear-gradient(135deg, #ffffff, #f3faf8);
    }

    .tree-row.parent:first-child {
      margin-top: 0;
    }

    .tree-row.child {
      margin-left: 22px;
      padding-left: 14px;
      border-left: 4px solid rgba(20,125,112,.22);
    }

    .tree-row.plain {
      padding-left: 12px;
      font-weight: 850;
      background: linear-gradient(135deg, #ffffff, #f4f8ff);
    }

    .tree-label {
      display: inline-flex;
      align-items: center;
      gap: 9px;
      min-width: 0;
      color: inherit;
      font-size: 13.5px;
      line-height: 1.25;
      font-weight: inherit;
      cursor: pointer;
      user-select: none;
    }

    .tree-label span {
      min-width: 0;
      overflow-wrap: anywhere;
    }

    .tree-row .caret {
      color: #78909c;
      font-size: 11px;
      line-height: 1;
      margin-left: auto;
      transition: color .16s ease, opacity .16s ease;
    }

    .tree-row input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin: 0;
      accent-color: var(--primary);
      flex: 0 0 auto;
    }

    .tree-row:has(input:checked) {
      background: linear-gradient(135deg, var(--primary), #1aa9b8);
      border-color: transparent;
      color: #fff;
      box-shadow: 0 12px 24px rgba(20,125,112,.18);
    }

    .tree-row:has(input:checked) .caret {
      color: rgba(255,255,255,.9);
      opacity: 1;
    }

    .tree-row:has(input:checked) input[type="checkbox"] {
      accent-color: #fff;
    }

    @media (max-width: 760px) {
      .curriculum-note,
      .curriculum-group-title,
      .tree-list {
        margin-left: 14px;
        margin-right: 14px;
      }

      .tree-list {
        padding-left: 14px;
        padding-right: 14px;
      }

      .tree-row.child {
        margin-left: 12px;
      }
    }


    /* ACEM Primary Exam open / close control */
    button.curriculum-group-title {
      width: calc(100% - 36px);
      border: 0;
      cursor: pointer;
      font: inherit;
      text-align: left;
    }

    button.curriculum-group-title:focus-visible {
      outline: 3px solid rgba(20,125,112,.26);
      outline-offset: 3px;
    }

    .tree-list[hidden],
    .subsection-list[hidden] {
      display: none !important;
    }

    .subsection-list {
      display: grid;
      gap: 8px;
    }

    .subsection-toggle {
      width: 28px;
      height: 28px;
      border: 0;
      border-radius: 999px;
      display: inline-grid;
      place-items: center;
      background: rgba(20, 125, 112, .08);
      color: inherit;
      cursor: pointer;
      transition: background .16s ease, transform .16s ease;
    }

    .subsection-toggle:hover {
      background: rgba(20, 125, 112, .14);
      transform: translateY(-1px);
    }

    .subsection-toggle:focus-visible {
      outline: 3px solid rgba(20,125,112,.26);
      outline-offset: 2px;
    }

    .tree-row:has(input:checked) .subsection-toggle {
      background: rgba(255,255,255,.18);
      color: #fff;
    }

</style>