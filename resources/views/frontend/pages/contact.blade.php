	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
    @include('messages')
<style>
        :root {
            --primary: #0f766e;
            --primary-dark: #0b5f59;
            --primary-soft: #ecfdf9;
            --navy: #17324d;
            --text: #334155;
            --muted: #64748b;
            --border: #dce7e5;
            --surface: #ffffff;
            --surface-alt: #f7faf9;
            --shadow: 0 18px 45px rgba(15, 118, 110, 0.08);
            --radius: 18px;
            --container: 1380px;
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
            background: var(--surface);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                         "Segoe UI", sans-serif;
            font-size: 16px;
            line-height: 1.75;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(1160px, calc(100% - 40px));
            margin: 0 auto;
        }

       

        .site-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.96);
            border-bottom: 1px solid rgba(220, 231, 229, 0.9);
            backdrop-filter: blur(12px);
        }


        .brand-mark {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            color: #ffffff;
            background: linear-gradient(145deg, #0f8c82, #0f766e);
            border-radius: 12px;
            box-shadow: 0 8px 18px rgba(15, 118, 110, 0.22);
        }

        .brand-mark svg {
            width: 23px;
            height: 23px;
        }



        .btn {
            min-height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 18px;
            border: 1px solid transparent;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 750;
            transition: 0.2s ease;
        }

        .btn-outline {
            color: var(--primary);
            border-color: #b9deda;
            background: #ffffff;
        }

        .btn-outline:hover {
            background: var(--primary-soft);
        }

        .btn-primary {
            color: #ffffff;
            background: var(--primary);
            box-shadow: 0 8px 20px rgba(15, 118, 110, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 86px 0 76px;
            background:
                radial-gradient(circle at 85% 18%, rgba(45, 212, 191, 0.18), transparent 25%),
                radial-gradient(circle at 15% 85%, rgba(15, 118, 110, 0.08), transparent 30%),
                linear-gradient(180deg, #f4fffd 0%, #ffffff 100%);
            border-bottom: 1px solid #e6f0ee;
        }

        .hero::after {
            content: "";
            position: absolute;
            right: -80px;
            bottom: -110px;
            width: 340px;
            height: 340px;
            border: 52px solid rgba(15, 118, 110, 0.045);
            border-radius: 50%;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            padding: 7px 12px;
            color: var(--primary-dark);
            background: #dcf7f2;
            border: 1px solid #c4ece6;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.09em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            background: var(--primary);
            border-radius: 50%;
        }

        .hero h1 {
            max-width: 760px;
            margin: 0;
            color: var(--navy);
            font-size: clamp(42px, 6vw, 68px);
            line-height: 1.08;
            letter-spacing: -2.2px;
        }

        .hero p {
            max-width: 720px;
            margin: 22px 0 0;
            color: #526579;
            font-size: 18px;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 24px;
            margin-top: 28px;
            color: var(--muted);
            font-size: 14px;
        }

        .hero-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .hero-meta svg {
            width: 17px;
            height: 17px;
            color: var(--primary);
        }

        .page-section {
            padding: 76px 0 92px;
            background: var(--surface-alt);
        }

        .legal-layout {
            display: grid;
            grid-template-columns: 270px minmax(0, 1fr);
            gap: 38px;
            align-items: start;
        }

        .side-card {
            position: sticky;
            top: 105px;
            padding: 22px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .side-card h2 {
            margin: 0 0 14px;
            color: var(--navy);
            font-size: 15px;
        }

        .toc {
            display: grid;
            gap: 3px;
        }

        .toc a {
            padding: 9px 11px;
            color: var(--muted);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 650;
        }

        .toc a:hover {
            color: var(--primary-dark);
            background: var(--primary-soft);
        }

        .contact-card {
            margin-top: 18px;
            padding: 15px;
            background: linear-gradient(145deg, #effcf9, #f8fffd);
            border: 1px solid #d0eee9;
            border-radius: 12px;
        }

        .contact-card strong {
            display: block;
            margin-bottom: 3px;
            color: var(--navy);
            font-size: 13px;
        }

        .contact-card p {
            margin: 0 0 10px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.55;
        }

        .contact-card a {
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
        }

        .legal-card {
            padding: clamp(28px, 5vw, 56px);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: var(--shadow);
        }

        .notice {
            display: flex;
            gap: 14px;
            margin-bottom: 38px;
            padding: 18px 20px;
            color: #28534f;
            background: var(--primary-soft);
            border: 1px solid #cdebe6;
            border-radius: 14px;
        }

        .notice svg {
            flex: 0 0 auto;
            width: 22px;
            height: 22px;
            margin-top: 2px;
            color: var(--primary);
        }

        .notice p {
            margin: 0;
            font-size: 14px;
        }

        .legal-section {
            scroll-margin-top: 110px;
        }

        .legal-section + .legal-section {
            margin-top: 38px;
            padding-top: 38px;
            border-top: 1px solid #e6eeec;
        }

        .section-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 31px;
            height: 31px;
            margin-right: 9px;
            color: var(--primary);
            background: var(--primary-soft);
            border: 1px solid #cdebe6;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 850;
            vertical-align: 3px;
        }

        .legal-section h2 {
            margin: 0 0 15px;
            color: var(--navy);
            font-size: 25px;
            line-height: 1.3;
            letter-spacing: -0.45px;
        }

        .legal-section h3 {
            margin: 25px 0 10px;
            color: var(--navy);
            font-size: 18px;
        }

        .legal-section p {
            margin: 0 0 15px;
        }

        .legal-section ul {
            margin: 12px 0 18px;
            padding-left: 22px;
        }

        .legal-section li {
            margin: 7px 0;
            padding-left: 4px;
        }

        .legal-section strong {
            color: #253f57;
        }

        .cta {
            padding: 68px 0;
            color: #ffffff;
            background:
                radial-gradient(circle at 20% 30%, rgba(45, 212, 191, 0.2), transparent 30%),
                linear-gradient(135deg, #17324d, #0d5f5a);
        }

        .cta-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
        }

        .cta h2 {
            margin: 0 0 8px;
            font-size: 31px;
            letter-spacing: -0.7px;
        }

        .cta p {
            max-width: 670px;
            margin: 0;
            color: #d8e8e7;
        }

        .cta .btn {
            flex: 0 0 auto;
            color: var(--primary-dark);
            background: #ffffff;
        }

        .site-footer {
            padding: 64px 0 26px;
            color: #b9c7d3;
            background: #10263a;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.6fr repeat(3, 1fr);
            gap: 42px;
        }

        .footer-brand {
            color: #ffffff;
        }

        .footer-about {
            max-width: 360px;
            margin: 17px 0 0;
            font-size: 14px;
            line-height: 1.7;
        }

        .footer-column h3 {
            margin: 0 0 18px;
            color: #ffffff;
            font-size: 14px;
        }

        .footer-links {
            display: grid;
            gap: 11px;
        }

        .footer-links a {
            font-size: 13px;
        }

        .footer-links a:hover {
            color: #ffffff;
        }

        .footer-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 50px;
            padding-top: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.11);
            font-size: 12px;
        }

        .footer-legal {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        .menu-button {
            display: none;
            width: 44px;
            height: 44px;
            padding: 0;
            color: var(--navy);
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
        }

        .menu-button svg {
            width: 22px;
            height: 22px;
        }



        /* Contact page */
        .contact-hero {
            padding-bottom: 92px;
        }

        .contact-hero .hero-copy {
            max-width: 760px;
        }

        .contact-hero h1 {
            max-width: 680px;
        }

        .contact-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .contact-hero-actions .btn-secondary {
            color: var(--primary-dark);
            background: #ffffff;
            border-color: #badfd9;
        }

        .contact-hero-actions .btn-secondary:hover {
            background: var(--primary-soft);
        }

        .contact-page {
            padding: 78px 0 92px;
            background: var(--surface-alt);
        }

        .contact-summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-top: -126px;
            margin-bottom: 44px;
            position: relative;
            z-index: 3;
        }

        .summary-card {
            min-height: 188px;
            padding: 25px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .summary-icon {
            width: 46px;
            height: 46px;
            display: grid;
            place-items: center;
            margin-bottom: 18px;
            color: var(--primary);
            background: var(--primary-soft);
            border: 1px solid #cceae5;
            border-radius: 13px;
        }

        .summary-icon svg {
            width: 23px;
            height: 23px;
        }

        .summary-card h2 {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 18px;
            line-height: 1.3;
        }

        .summary-card p {
            margin: 0 0 8px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .summary-card a {
            color: var(--primary);
            font-size: 14px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .contact-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.45fr) minmax(300px, 0.75fr);
            gap: 30px;
            align-items: start;
        }

        .form-card,
        .support-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow);
        }

        .form-card {
            padding: clamp(25px, 4vw, 44px);
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading h2,
        .support-card h2 {
            margin: 0 0 8px;
            color: var(--navy);
            font-size: 27px;
            line-height: 1.25;
            letter-spacing: -0.5px;
        }

        .form-heading p,
        .support-card > p {
            margin: 0;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .alert {
            display: flex;
            gap: 12px;
            margin-bottom: 23px;
            padding: 15px 17px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.55;
        }

        .alert svg {
            flex: 0 0 auto;
            width: 20px;
            height: 20px;
            margin-top: 1px;
        }

        .alert-success {
            color: #175c50;
            background: #ecfdf5;
            border: 1px solid #bde9dc;
        }

        .alert-error {
            color: #8a2f2f;
            background: #fff5f5;
            border: 1px solid #f2cccc;
        }

        .alert-error ul {
            margin: 6px 0 0;
            padding-left: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 7px;
            color: #29445b;
            font-size: 13px;
            font-weight: 800;
        }

        .required {
            color: #b42318;
        }

        .form-control {
            width: 100%;
            min-height: 49px;
            padding: 11px 14px;
            color: var(--text);
            background: #ffffff;
            border: 1px solid #cadbd8;
            border-radius: 11px;
            outline: none;
            font: inherit;
            font-size: 14px;
            line-height: 1.5;
            transition: border-color 0.18s ease, box-shadow 0.18s ease;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            border-color: #45a99f;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.1);
        }

        textarea.form-control {
            min-height: 164px;
            resize: vertical;
        }

        .field-help {
            display: block;
            margin-top: 6px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .field-error {
            display: block;
            margin-top: 6px;
            color: #b42318;
            font-size: 12px;
            font-weight: 700;
        }

        .checkbox-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .checkbox-row input {
            width: 17px;
            height: 17px;
            margin-top: 4px;
            accent-color: var(--primary);
        }

        .checkbox-row label {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .checkbox-row a {
            color: var(--primary);
            font-weight: 750;
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 4px;
        }

        .form-actions p {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .submit-btn {
            min-width: 164px;
            cursor: pointer;
        }

        .support-stack {
            display: grid;
            gap: 20px;
        }

        .support-card {
            padding: 27px;
        }

        .support-list {
            display: grid;
            gap: 13px;
            margin-top: 21px;
        }

        .support-item {
            display: flex;
            gap: 12px;
            padding: 13px 0;
            border-top: 1px solid #e8efed;
        }

        .support-item:first-child {
            padding-top: 0;
            border-top: 0;
        }

        .support-item svg {
            flex: 0 0 auto;
            width: 20px;
            height: 20px;
            margin-top: 2px;
            color: var(--primary);
        }

        .support-item strong {
            display: block;
            margin-bottom: 2px;
            color: var(--navy);
            font-size: 13px;
        }

        .support-item span,
        .support-item a {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.55;
        }

        .support-item a:hover {
            color: var(--primary);
        }

        .registration-note {
            color: #28534f;
            background: linear-gradient(145deg, #effcf9, #f8fffd);
            border-color: #d0eee9;
        }

        .registration-note h2 {
            font-size: 20px;
        }

        .quick-links {
            display: grid;
            gap: 10px;
            margin-top: 18px;
        }

        .quick-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 13px;
            color: #365168;
            background: var(--surface-alt);
            border: 1px solid #e1ebe9;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 750;
        }

        .quick-link:hover {
            color: var(--primary-dark);
            background: var(--primary-soft);
            border-color: #c9e8e3;
        }

        .quick-link svg {
            width: 17px;
            height: 17px;
        }

        .privacy-note {
            margin-top: 28px;
            padding: 16px 18px;
            color: var(--muted);
            background: #fbfdfd;
            border: 1px solid #e2ebe9;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.65;
        }

        .privacy-note strong {
            color: #345267;
        }

        .privacy-note a {
            color: var(--primary);
            font-weight: 800;
        }

        .honeypot {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
        }

        @media (max-width: 980px) {
            .contact-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                margin-top: -106px;
            }

            .contact-layout {
                grid-template-columns: 1fr;
            }

            .support-stack {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .nav-menu {
                display: none;
            }

            .menu-button {
                display: grid;
                place-items: center;
            }

            .legal-layout {
                grid-template-columns: 1fr;
            }

            .side-card {
                position: static;
            }

            .toc {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 680px) {
            .contact-hero {
                padding-bottom: 73px;
            }

            .contact-page {
                padding-top: 55px;
            }

            .contact-summary-grid {
                grid-template-columns: 1fr;
                margin-top: -93px;
            }

            .summary-card {
                min-height: 0;
            }

            .form-grid,
            .support-stack {
                grid-template-columns: 1fr;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .submit-btn {
                width: 100%;
            }
            .container {
                width: min(100% - 28px, 1160px);
            }

            .topbar-inner,
            .cta-inner,
            .footer-bottom {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar-inner {
                gap: 5px;
            }

            .topbar-links {
                gap: 14px;
            }

            .nav {
                min-height: 68px;
            }

            .nav-actions .btn-outline {
                display: none;
            }

            .nav-actions .btn-primary {
                display: none;
            }

            .hero {
                padding: 64px 0 58px;
            }

            .hero h1 {
                letter-spacing: -1.4px;
            }

            .hero p {
                font-size: 16px;
            }

            .page-section {
                padding: 45px 0 62px;
            }

            .legal-card {
                padding: 25px 20px;
                border-radius: 18px;
            }

            .toc {
                grid-template-columns: 1fr;
            }

            .cta {
                padding: 52px 0;
            }

            .cta h2 {
                font-size: 27px;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
     <main>
        <section class="hero contact-hero">
            <div class="container">
                <div class="hero-copy">
                    <span class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        MedExHub support
                    </span>

                    <h1>How can we help?</h1>

                    <p>
                        Contact the MedExHub team about your account, registration email,
                        subscription, payment, technical issue or examination resources.
                    </p>

                    <div class="contact-hero-actions">
                        <a class="btn btn-primary" href="#contact-form">Send an enquiry</a>
                        <a class="btn btn-secondary" href="/faq">View help &amp; FAQs</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-page">
            <div class="container">
                <div class="contact-summary-grid">
                    <article class="summary-card">
                        <div class="summary-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6h16v12H4V6Zm0 1 8 6 8-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h2>Email our team</h2>
                        <p>For account, subscription, payment and general support enquiries.</p>
                        <a href="mailto:enquiries@medexhub.com">enquiries@medexhub.com</a>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 21s7-5.1 7-12A7 7 0 1 0 5 9c0 6.9 7 12 7 12Zm0-9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h2>Postal address</h2>
                        <p>4 Red Penda Court<br>Norman Gardens QLD 4701<br>Australia</p>
                    </article>

                    <article class="summary-card">
                        <div class="summary-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 20h16M6 20V8l6-4 6 4v12M9 11h6M9 15h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h2>Company details</h2>
                        <p>MEDEXHUB PTY. LTD.</p>
                        <a href="#company-details">ACN 603 739 902</a>
                    </article>
                </div>

                <div class="contact-layout">
                    <section class="form-card" id="contact-form" style="padding: 28px;">
                        <div class="form-heading">
                            <span class="eyebrow">
                                <span class="eyebrow-dot"></span>
                                Contact form
                            </span>
                            <h2>Send us a message</h2>
                            <p>
                                Include the email address linked to your MedExHub account and
                                enough detail for us to understand the issue. Do not include
                                passwords, complete card details or identifiable patient information.
                            </p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success" role="status">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-error" role="alert">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M12 8v5M12 17h.01M10.3 4.7 2.8 18a2 2 0 0 0 1.74 3h14.92a2 2 0 0 0 1.74-3L13.7 4.7a2 2 0 0 0-3.4 0Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div>
                                    <strong>Please correct the following:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('sendcontactmessage') }}">
                            @csrf
                            <div class="honeypot" aria-hidden="true">
                                <label for="website">Website</label>
                                <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                            </div>
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label" for="name">Full name <span class="required" aria-hidden="true">*</span></label>
                                    <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" maxlength="120" autocomplete="name" required>
                                    @error('name')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email address <span class="required" aria-hidden="true">*</span></label>
                                    <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" maxlength="190" autocomplete="email" required>
                                    <span class="field-help">Use the email linked to your account where possible.</span>
                                    @error('email')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="category">Enquiry type <span class="required" aria-hidden="true">*</span></label>
                                    <select class="form-control" id="category" name="category" required>
                                        <option value="">Select an enquiry type</option>
                                        <option value="account" @selected(old('category') === 'account')>Account or login</option>
                                        <option value="registration" @selected(old('category') === 'registration')>Registration email</option>
                                        <option value="subscription" @selected(old('category') === 'subscription')>Subscription or access</option>
                                        <option value="payment" @selected(old('category') === 'payment')>Payment, invoice or refund</option>
                                        <option value="technical" @selected(old('category') === 'technical')>Technical problem</option>
                                        <option value="content" @selected(old('category') === 'content')>Question or content feedback</option>
                                        <option value="privacy" @selected(old('category') === 'privacy')>Privacy request</option>
                                        <option value="other" @selected(old('category') === 'other')>Other enquiry</option>
                                    </select>
                                    @error('category')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="reference">Reference number</label>
                                    <input class="form-control" id="reference" name="reference" type="text" value="{{ old('reference') }}" maxlength="100"placeholder="Invoice or transaction ID, if relevant">
                                    @error('reference')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group full">
                                    <label class="form-label" for="subject">Subject <span class="required" aria-hidden="true">*</span></label>
                                    <input class="form-control" id="subject" name="subject" type="text" value="{{ old('subject') }}" maxlength="160" placeholder="Briefly describe your enquiry" required>
                                    @error('subject')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group full">
                                    <label class="form-label" for="message">Message <span class="required" aria-hidden="true">*</span></label>
                                    <textarea class="form-control" id="message" name="message" maxlength="5000" placeholder="Tell us what happened, which exam or subscription is affected, and any troubleshooting you have already tried." required>{{ old('message') }}</textarea>
                                    <span class="field-help">Please do not include passwords, complete payment card details or patient-identifying information.</span>
                                    @error('message')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group full">
                                    <div class="checkbox-row">
                                        <input id="privacy_acknowledgement" name="privacy_acknowledgement" type="checkbox" value="1" @checked(old('privacy_acknowledgement')) required>
                                        <label for="privacy_acknowledgement">
                                            I understand that MedExHub will use the information in this form to respond to my enquiry in accordance with the
                                            <a href="/privacy">Privacy Policy</a>.
                                        </label>
                                    </div>
                                    @error('privacy_acknowledgement')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group full form-actions">
                                    <p>Fields marked with an asterisk are required.</p>
                                    <button class="btn btn-primary submit-btn" type="submit">Send message</button>
                                </div>
                            </div>
                        </form>

                        <div class="privacy-note">
                            <strong>Privacy reminder:</strong> This form is for MedExHub product and account support.
                            Do not use it for clinical advice or to transmit patient records. Read our
                            <a href="/privacy">Privacy Policy</a> and
                            <a href="/disclaimer">Disclaimer</a>.
                        </div>
                    </section>

                    <aside class="support-stack">
                        <section class="support-card registration-note" style="padding: 28px;">
                            <h2>Registration email missing?</h2>
                            <p>
                                Check your spam or junk folder first. If the email has not arrived,
                                contact us using the same email address you used during registration.
                            </p>
                            <div class="quick-links">
                                <a class="quick-link" href="mailto:enquiries@medexhub.com?subject=Registration%20email%20not%20received">
                                    Email registration support
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </section>

                        <section class="support-card" id="company-details" style="padding: 28px;">
                            <h2>Contact details</h2>
                            <p>Company and support information for MedExHub.</p>

                            <div class="support-list">
                                <div class="support-item">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4 6h16v12H4V6Zm0 1 8 6 8-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div>
                                        <strong>Email</strong>
                                        <a href="mailto:enquiries@medexhub.com">enquiries@medexhub.com</a>
                                    </div>
                                </div>

                                <div class="support-item">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M12 21s7-5.1 7-12A7 7 0 1 0 5 9c0 6.9 7 12 7 12Zm0-9a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div>
                                        <strong>Address</strong>
                                        <span>4 Red Penda Court<br>Norman Gardens QLD 4701<br>Australia</span>
                                    </div>
                                </div>

                                <div class="support-item">
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="M4 20h16M6 20V8l6-4 6 4v12M9 11h6M9 15h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <div>
                                        <strong>Legal entity</strong>
                                        <span>MEDEXHUB PTY. LTD.<br>ACN 603 739 902</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="support-card" style="padding: 28px;">
                            <h2>Helpful resources</h2>
                            <p>These pages may answer common questions before you contact support.</p>

                            <div class="quick-links">
                                <a class="quick-link" href="/faq">
                                    Help and FAQs
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a class="quick-link" href="/terms">
                                    Terms and conditions
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <a class="quick-link" href="/privacy">
                                    Privacy Policy
                                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                        <path d="m9 5 7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </section>

       
    </main>









@include('frontend.footer')
@include('frontend.index_footer')