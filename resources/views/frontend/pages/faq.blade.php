	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
    @include('messages')
    <style>
        :root {
            --primary: #0f766e;
            --primary-dark: #115e59;
            --primary-soft: #e8f6f4;
            --accent: #14b8a6;
            --navy: #102a43;
            --text: #334e68;
            --muted: #627d98;
            --line: #d9e2ec;
            --surface: #ffffff;
            --background: #f6faf9;
            --shadow: 0 18px 50px rgba(16, 42, 67, 0.08);
            --radius-lg: 24px;
            --radius-md: 16px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--text);
            background: var(--background);
            font-family: Inter, ui-sans-serif, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            line-height: 1.65;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input {
            font: inherit;
        }

        .container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }



        .site-header {
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid rgba(217, 226, 236, 0.8);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(14px);
        }

    
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 11px;
            color: var(--navy);
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            color: #ffffff;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(15, 118, 110, 0.24);
            font-size: 20px;
        }

        

        .button {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0 20px;
            border: 1px solid transparent;
            border-radius: 12px;
            font-weight: 750;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-outline {
            border-color: var(--line);
            background: #ffffff;
            color: var(--navy);
        }

        .button-primary {
            color: #ffffff;
            background: var(--primary);
            box-shadow: 0 10px 24px rgba(15, 118, 110, 0.22);
        }

        .button-primary:hover {
            background: var(--primary-dark);
        }

        .menu-button {
            display: none;
            width: 44px;
            height: 44px;
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #ffffff;
            cursor: pointer;
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 88px 0 76px;
            background:
                radial-gradient(circle at 15% 25%, rgba(20, 184, 166, 0.16), transparent 28%),
                radial-gradient(circle at 85% 10%, rgba(15, 118, 110, 0.11), transparent 25%),
                linear-gradient(180deg, #f4fbfa 0%, #ffffff 100%);
            border-bottom: 1px solid #e7f0ef;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border: 1px solid rgba(15, 118, 110, 0.08);
            border-radius: 50%;
        }

        .hero::before {
            width: 430px;
            height: 430px;
            right: -190px;
            top: -230px;
        }

        .hero::after {
            width: 280px;
            height: 280px;
            left: -150px;
            bottom: -180px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 790px;
            margin: 0 auto;
            text-align: center;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            padding: 7px 12px;
            border: 1px solid #bfe7e1;
            border-radius: 999px;
            color: var(--primary-dark);
            background: rgba(255, 255, 255, 0.86);
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent);
        }

        h1 {
            margin: 0;
            color: var(--navy);
            font-size: clamp(38px, 5vw, 62px);
            line-height: 1.08;
            letter-spacing: -2.4px;
        }

        .hero-copy {
            max-width: 690px;
            margin: 22px auto 0;
            color: var(--muted);
            font-size: 18px;
        }

        .search-wrap {
            max-width: 700px;
            margin: 34px auto 0;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 9px 8px 18px;
            border: 1px solid #cadbd9;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: var(--shadow);
        }

        .search-icon {
            flex: 0 0 auto;
            color: var(--primary);
            font-size: 21px;
        }

        .search-box input {
            width: 100%;
            min-width: 0;
            padding: 11px 0;
            border: 0;
            outline: 0;
            color: var(--navy);
            background: transparent;
            font-size: 16px;
        }

        .search-box input::placeholder {
            color: #8da2b5;
        }

        .search-hint {
            margin-top: 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .main {
            padding: 72px 0 88px;
        }

        .faq-layout {
            display: grid;
            grid-template-columns: 260px minmax(0, 1fr);
            gap: 44px;
            align-items: start;
        }

        .faq-sidebar {
            position: sticky;
            top: 110px;
        }

        .sidebar-card {
            padding: 22px;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            background: var(--surface);
            box-shadow: 0 12px 34px rgba(16, 42, 67, 0.05);
        }

        .sidebar-title {
            margin: 0 0 14px;
            color: var(--navy);
            font-size: 15px;
        }

        .category-list {
            display: grid;
            gap: 7px;
        }

        .category-button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 12px;
            border: 0;
            border-radius: 10px;
            color: var(--text);
            background: transparent;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .category-button:hover,
        .category-button.active {
            color: var(--primary-dark);
            background: var(--primary-soft);
        }

        .category-icon {
            width: 28px;
            height: 28px;
            display: grid;
            place-items: center;
            border-radius: 8px;
            background: #eef5f4;
            font-size: 14px;
        }

        .sidebar-support {
            margin-top: 18px;
            padding: 20px;
            border-radius: var(--radius-md);
            color: #ffffff;
            background: linear-gradient(145deg, var(--navy), #173f5f);
        }

        .sidebar-support h3 {
            margin: 0 0 8px;
            font-size: 17px;
        }

        .sidebar-support p {
            margin: 0 0 16px;
            color: #c8d9e8;
            font-size: 14px;
        }

        .sidebar-support a {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-weight: 800;
            color: #8df0df;
        }

        .faq-heading {
            margin-bottom: 24px;
        }

        .faq-heading h2 {
            margin: 0;
            color: var(--navy);
            font-size: 32px;
            letter-spacing: -0.8px;
        }

        .faq-heading p {
            margin: 8px 0 0;
            color: var(--muted);
        }

        .results-message {
            display: none;
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #bfe7e1;
            border-radius: 12px;
            color: var(--primary-dark);
            background: var(--primary-soft);
            font-size: 14px;
            font-weight: 700;
        }

        .faq-list {
            display: grid;
            gap: 14px;
        }

        .faq-item {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: var(--radius-md);
            background: var(--surface);
            box-shadow: 0 9px 28px rgba(16, 42, 67, 0.045);
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .faq-item:hover {
            border-color: #b9d5d1;
            box-shadow: 0 12px 34px rgba(16, 42, 67, 0.07);
        }

        .faq-question {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 34px;
            align-items: center;
            gap: 18px;
            padding: 21px 22px;
            border: 0;
            color: var(--navy);
            background: transparent;
            text-align: left;
            font-size: 16px;
            font-weight: 780;
            cursor: pointer;
        }

        .faq-toggle {
            width: 32px;
            height: 32px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            color: var(--primary);
            background: var(--primary-soft);
            font-size: 21px;
            line-height: 1;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .faq-question[aria-expanded="true"] .faq-toggle {
            color: #ffffff;
            background: var(--primary);
            transform: rotate(45deg);
        }

        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            transition: grid-template-rows 0.28s ease;
        }

        .faq-answer-inner {
            overflow: hidden;
        }

        .faq-answer-content {
            padding: 0 22px 22px;
            color: var(--text);
        }

        .faq-answer-content p {
            margin: 0;
        }

        .faq-answer-content p + p,
        .faq-answer-content ul {
            margin-top: 11px;
        }

        .faq-answer-content ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .faq-item.open .faq-answer {
            grid-template-rows: 1fr;
        }

        .faq-item.hidden {
            display: none;
        }

        mark {
            padding: 0 2px;
            color: inherit;
            background: #fff0a6;
            border-radius: 3px;
        }

        .empty-state {
            display: none;
            padding: 42px 24px;
            border: 1px dashed #b9cac8;
            border-radius: var(--radius-md);
            background: #fbfdfd;
            text-align: center;
        }

        .empty-state.show {
            display: block;
        }

        .empty-state h3 {
            margin: 0 0 7px;
            color: var(--navy);
        }

        .empty-state p {
            margin: 0;
            color: var(--muted);
        }

        .support-cta {
            margin-top: 34px;
            padding: 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            border: 1px solid #bfe7e1;
            border-radius: var(--radius-lg);
            background:
                linear-gradient(120deg, rgba(232, 246, 244, 0.96), rgba(255, 255, 255, 0.98));
        }

        .support-cta h3 {
            margin: 0;
            color: var(--navy);
            font-size: 23px;
        }

        .support-cta p {
            margin: 6px 0 0;
            color: var(--muted);
        }

        .site-footer {
            padding: 54px 0 24px;
            color: #c8d9e8;
            background: var(--navy);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.7fr repeat(3, 1fr);
            gap: 48px;
        }

        .footer-brand p {
            max-width: 360px;
            margin: 18px 0 0;
            color: #9fb3c8;
            font-size: 14px;
        }

        .footer-title {
            margin: 0 0 14px;
            color: #ffffff;
            font-size: 14px;
        }

        .footer-links {
            display: grid;
            gap: 9px;
            font-size: 14px;
        }

        .footer-links a {
            color: #b7cadb;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            margin-top: 42px;
            padding-top: 22px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
            color: #8da2b5;
            font-size: 13px;
        }

        @media (max-width: 980px) {
            .nav-links {
                position: absolute;
                top: 76px;
                left: 20px;
                right: 20px;
                display: none;
                padding: 18px;
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
                border: 1px solid var(--line);
                border-radius: 16px;
                background: #ffffff;
                box-shadow: var(--shadow);
            }

            .nav-links.open {
                display: flex;
            }

            .nav-links a {
                padding: 9px 10px;
                border-radius: 9px;
            }

            .nav-links a:hover {
                background: var(--primary-soft);
            }

            .nav-actions .button-outline {
                display: none;
            }

            .menu-button {
                display: inline-grid;
                place-items: center;
            }

            .faq-layout {
                grid-template-columns: 1fr;
            }

            .faq-sidebar {
                position: static;
            }

            .sidebar-card {
                overflow-x: auto;
            }

            .category-list {
                display: flex;
                min-width: max-content;
            }

            .category-button {
                width: auto;
            }

            .sidebar-support {
                display: none;
            }

            .footer-grid {
                grid-template-columns: 1.5fr 1fr 1fr;
            }

            .footer-grid > :last-child {
                grid-column: 2 / 4;
            }
        }

        @media (max-width: 700px) {
            .container {
                width: min(100% - 28px, 1180px);
            }

     

            .nav {
                min-height: 68px;
            }

            .nav-links {
                top: 68px;
                left: 14px;
                right: 14px;
            }

            .nav-actions .button-primary {
                display: none;
            }

            .hero {
                padding: 64px 0 58px;
            }

            h1 {
                letter-spacing: -1.5px;
            }

            .hero-copy {
                font-size: 16px;
            }

            .search-box {
                padding-left: 14px;
            }

            .search-box .button {
                display: none;
            }

            .main {
                padding: 48px 0 64px;
            }

            .faq-heading h2 {
                font-size: 27px;
            }

            .faq-question {
                padding: 18px;
                font-size: 15px;
            }

            .faq-answer-content {
                padding: 0 18px 19px;
            }

            .support-cta {
                padding: 26px;
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 34px 26px;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }

            .footer-grid > :last-child {
                grid-column: auto;
            }

            .footer-bottom {
                flex-direction: column;
            }
        }
    </style>

    <main>
        <section class="hero">
            <div class="container hero-content">
                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Help centre
                </div>

                <h1>Answers for your study journey.</h1>

                <p class="hero-copy">
                    Find clear answers about question banks, study modes, subscriptions,
                    account access and technical support.
                </p>

                <div class="search-wrap">
                    <label class="search-box" for="faqSearch">
                        <span class="search-icon" aria-hidden="true">⌕</span>
                        <input id="faqSearch" type="search"
                               placeholder="Search questions, for example: subscription or exam mode"
                               autocomplete="off">
                        <span class="button button-primary">Search</span>
                    </label>
                    <div class="search-hint">Search across all frequently asked questions.</div>
                </div>
            </div>
        </section>

        <section class="main">
            <div class="container faq-layout">
                <aside class="faq-sidebar" aria-label="FAQ categories">
                    <div class="sidebar-card">
                        <h2 class="sidebar-title">Browse by category</h2>

                        <div class="category-list">
                            <button class="category-button active" type="button" data-category="all">
                                <span class="category-icon">✦</span> All questions
                            </button>
                            <button class="category-button" type="button" data-category="getting-started">
                                <span class="category-icon">▶</span> Getting started
                            </button>
                            <button class="category-button" type="button" data-category="exams">
                                <span class="category-icon">✓</span> Exams &amp; study
                            </button>
                            <button class="category-button" type="button" data-category="subscriptions">
                                <span class="category-icon">$</span> Subscriptions
                            </button>
                            <button class="category-button" type="button" data-category="account">
                                <span class="category-icon">◉</span> Account
                            </button>
                            <button class="category-button" type="button" data-category="technical">
                                <span class="category-icon">⚙</span> Technical help
                            </button>
                        </div>
                    </div>

                    <div class="sidebar-support">
                        <h3>Still need help?</h3>
                        <p>Send your question to the MedExHub support team.</p>
                        <a href="https://www.medexhub.com/index.php?D=3&P=5">
                            Contact support <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </aside>

                <div class="faq-content">
                    <div class="faq-heading">
                        <h2>Frequently asked questions</h2>
                        <p id="faqSubtitle">Everything you need to get started and keep studying.</p>
                    </div>

                    <div class="results-message" id="resultsMessage" role="status"></div>

                    <div class="faq-list" id="faqList">
                        <article class="faq-item" data-category="getting-started">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>What is MedExHub?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            MedExHub is an online medical exam preparation platform offering
                                            clinically oriented question banks, detailed explanations, flexible
                                            study modes and performance insights for selected Australian medical
                                            examinations.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="getting-started">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>How do I start using MedExHub?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Browse the exam catalogue, select the resource that matches your
                                            training pathway, then create an account or sign in. You can use a
                                            free trial or sample question where available, or purchase an access
                                            period online.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="getting-started">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Can I try MedExHub before purchasing?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Free trials or sample questions may be available for selected
                                            resources. Open the relevant exam page to view the current trial
                                            and access options.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="exams">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Which examinations are available?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>MedExHub currently presents resources for:</p>
                                        <ul>
                                            <li>ACEM Primary</li>
                                            <li>ACEM Fellowship</li>
                                            <li>RACGP AKT</li>
                                            <li>RACGP KFP</li>
                                            <li>AMC MCQ</li>
                                            <li>Selected RACGP flash-card resources</li>
                                        </ul>
                                        <p>
                                            Availability, question numbers and access options may vary between
                                            resources.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="exams">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>What is the difference between Study Mode and Exam Mode?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            <strong>Study Mode</strong> is designed for focused learning. It allows
                                            you to work through selected topics and review explanations as you
                                            progress. <strong>Exam Mode</strong> provides a more structured,
                                            timed experience intended to resemble exam-style practice.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="exams">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Can I select particular subjects or topics?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Yes. Where supported by the selected question bank, you can create a
                                            focused session by choosing subjects, topics, question volume and
                                            study or exam mode.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="exams">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Do questions include explanations?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Yes. Questions are supported by explanatory content and clinically
                                            relevant context to help you understand why an answer is correct,
                                            rather than relying on recall alone.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="exams">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Can I track my progress and weaker areas?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Performance tools may show accuracy, completion and topic-level
                                            results so you can identify weaker areas and plan more focused
                                            revision.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="subscriptions">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>How do I purchase a subscription?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Select your examination and preferred access period, add it to your
                                            basket, then proceed to checkout. You will need to register or sign in
                                            before completing the online order.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="subscriptions">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Which payment methods are accepted?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Payments are processed online through PayPal. Your payment card
                                            details are entered through the payment provider and are not stored
                                            by MedExHub.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="subscriptions">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>When does my access begin?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Access normally begins after successful payment and order
                                            confirmation. Sign in to your account and open the purchased resource
                                            from your dashboard.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="subscriptions">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Can I extend or renew my access?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            You can purchase another available access period for the relevant
                                            resource. For assistance with an existing subscription, contact
                                            support before your access expires.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="subscriptions">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>What is the refund policy?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Refund requests are considered under the current Terms and Conditions
                                            and applicable consumer law. Contact support with your account email,
                                            order details and the reason for your request.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="account">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>I cannot sign in. What should I do?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Confirm that you are using the email address registered with your
                                            order. Check for typing errors, try resetting your password and make
                                            sure cookies are enabled. Contact support if the problem continues.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="account">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Can I use my account on more than one device?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            You may sign in using a supported browser on your personal devices.
                                            Your account must remain for your individual use and should not be
                                            shared with another person.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="account">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>What happens to my study data after my subscription ends?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Session data for an expired or cancelled service may be deleted in
                                            accordance with the current data-deletion policy. Review the Privacy
                                            Policy and account terms for the latest retention details.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="technical">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Which browser should I use?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            For the best experience, use an up-to-date version of Google Chrome.
                                            Current versions of Safari, Microsoft Edge and Firefox may also be
                                            used. Ensure JavaScript and cookies are enabled.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="technical">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>The site is loading slowly. What can I try?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>Try the following steps:</p>
                                        <ul>
                                            <li>Refresh the page and sign in again.</li>
                                            <li>Use the latest version of Google Chrome.</li>
                                            <li>Clear the browser cache and cookies for MedExHub.</li>
                                            <li>Close unnecessary tabs or browser extensions.</li>
                                            <li>Try another device or internet connection.</li>
                                        </ul>
                                        <p>
                                            If the issue continues, contact support and include the affected page,
                                            browser, device and a screenshot where possible.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="technical">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>Why are pop-up windows or question pages not opening?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Your browser may be blocking pop-ups, cookies or JavaScript. Allow
                                            pop-ups for MedExHub, enable cookies and reload the page. Also check
                                            whether an ad blocker or privacy extension is preventing the page
                                            from opening.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <article class="faq-item" data-category="technical">
                            <button class="faq-question" type="button" aria-expanded="false">
                                <span>How do I report an incorrect question or technical problem?</span>
                                <span class="faq-toggle" aria-hidden="true">+</span>
                            </button>
                            <div class="faq-answer">
                                <div class="faq-answer-inner">
                                    <div class="faq-answer-content">
                                        <p>
                                            Contact support and include the exam name, question number or page,
                                            a short description of the issue and any relevant screenshot. This
                                            information helps the team review the problem more efficiently.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="empty-state" id="emptyState">
                        <h3>No matching questions found</h3>
                        <p>Try a shorter search term or contact support for assistance.</p>
                    </div>

                    <div class="support-cta">
                        <div>
                            <h3>Couldn’t find the answer?</h3>
                            <p>Our support team can help with your account, order or technical issue.</p>
                        </div>
                        <a class="button button-primary"
                           href="https://www.medexhub.com/index.php?D=3&P=5">
                            Contact support
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const faqItems = Array.from(document.querySelectorAll('.faq-item'));
            const categoryButtons = Array.from(document.querySelectorAll('.category-button'));
            const searchInput = document.getElementById('faqSearch');
            const resultsMessage = document.getElementById('resultsMessage');
            const emptyState = document.getElementById('emptyState');
            const faqSubtitle = document.getElementById('faqSubtitle');
            const menuButton = document.getElementById('menuButton');
            const mainNavigation = document.getElementById('mainNavigation');

            let selectedCategory = 'all';

            function setAccordion(item, shouldOpen) {
                const button = item.querySelector('.faq-question');
                item.classList.toggle('open', shouldOpen);
                button.setAttribute('aria-expanded', String(shouldOpen));
            }

            faqItems.forEach(function (item) {
                const button = item.querySelector('.faq-question');

                button.addEventListener('click', function () {
                    const isOpen = item.classList.contains('open');

                    faqItems.forEach(function (otherItem) {
                        if (otherItem !== item) {
                            setAccordion(otherItem, false);
                        }
                    });

                    setAccordion(item, !isOpen);
                });
            });

            function applyFilters() {
                const query = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;

                faqItems.forEach(function (item) {
                    const categoryMatches =
                        selectedCategory === 'all' ||
                        item.dataset.category === selectedCategory;

                    const text = item.textContent.toLowerCase();
                    const searchMatches = query === '' || text.includes(query);
                    const shouldShow = categoryMatches && searchMatches;

                    item.classList.toggle('hidden', !shouldShow);

                    if (!shouldShow) {
                        setAccordion(item, false);
                    } else {
                        visibleCount += 1;
                    }
                });

                emptyState.classList.toggle('show', visibleCount === 0);

                if (query !== '') {
                    resultsMessage.style.display = 'block';
                    resultsMessage.textContent =
                        visibleCount + (visibleCount === 1 ? ' result' : ' results') +
                        ' found for “‘' + searchInput.value.trim() + '”';
                } else {
                    resultsMessage.style.display = 'none';
                    resultsMessage.textContent = '';
                }

                faqSubtitle.textContent = selectedCategory === 'all'
                    ? 'Everything you need to get started and keep studying.'
                    : 'Showing questions in the selected category.';
            }

            categoryButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    selectedCategory = button.dataset.category;

                    categoryButtons.forEach(function (otherButton) {
                        otherButton.classList.remove('active');
                    });

                    button.classList.add('active');
                    applyFilters();
                });
            });

            searchInput.addEventListener('input', applyFilters);

            menuButton.addEventListener('click', function () {
                const isOpen = mainNavigation.classList.toggle('open');
                menuButton.setAttribute('aria-expanded', String(isOpen));
                menuButton.textContent = isOpen ? '✕' : '☰';
            });

            document.addEventListener('click', function (event) {
                if (
                    window.innerWidth <= 980 &&
                    !mainNavigation.contains(event.target) &&
                    !menuButton.contains(event.target)
                ) {
                    mainNavigation.classList.remove('open');
                    menuButton.setAttribute('aria-expanded', 'false');
                    menuButton.textContent = '☰';
                }
            });
        });
    </script>
    @include('frontend.footer')
	@include('frontend.index_footer')