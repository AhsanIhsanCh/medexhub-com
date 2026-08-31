<!doctype html>
  <html lang="zxx" class="page-login-7">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Sign in to your MedExHub account.">
  <title>Sign In | MedExHub</title>
  <link rel="stylesheet" href="../theme_files/css/style_v1.css"/>
  <link rel="stylesheet" href="../theme_files/css/style_common.css"/>
</head>
<body>
@include('frontend.header')
@include('messages')
  <main>
    <section class="page-hero" aria-labelledby="page-title">
      <div class="hero-content">
        <span class="hero-kicker">Secure account access</span>
        <h1 id="page-title">Register AA</h1>
        <nav class="breadcrumbs" aria-label="Breadcrumb">
          <a href="#">Home</a>
          <span aria-hidden="true">›</span>
          <span>Register</span>
        </nav>
      </div>
    </section>
    <section class="signin-section" id="signin" aria-labelledby="signin-title">
      <div class="signin-card">
        <div class="signin-heading">
          <div class="signin-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M15 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
              <circle cx="8.5" cy="7" r="4"></circle>
              <path d="M18 8l4 4-4 4"></path>
              <path d="M22 12h-8"></path>
            </svg>
          </div>
          <h2 id="signin-title">Register</h2>
          <p class="signin-subtitle">Enter your account details to continue to MedExHub.</p>
        </div>
          <form class="signin-form" action="{{ route('registerRequest') }}" method="post">
            @csrf
          <div class="form-field">
            <label for="email">First Name :</label>
            <div class="input-shell">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"></path>
            </svg>
               <input type="text" name="u_fname" value="{{ old('username') }}" autocomplete="First Name" placeholder="First Name"  required/>
            </div>
          </div>
          <div class="form-field">
            <label for="email">Last Name :</label>
            <div class="input-shell">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="8" r="4"></circle>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"></path>
            </svg>
               <input type="text" name="u_lname" value="{{ old('username') }}" autocomplete="Last Name" placeholder="Last Name"  required/>
            </div>
          </div>
          <div class="form-field">
            <label for="email">Email address</label>
            <div class="input-shell">
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M3 5.5h18v13H3z"></path>
                <path d="m4 7 8 6 8-6"></path>
              </svg>
               <input type="email" name="email" value="{{ old('username') }}" autocomplete="email" placeholder="name@example.com"  required/>
            </div>
          </div>
            <div class="form-field">
                <label for="password">Password</label>
                <div class="input-shell">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="4" y="10" width="16" height="10" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>
                <input  type="password" name="password" autocomplete="password"  placeholder="Password" required/>
                </div>
            </div>
            <div class="form-field">
                <label for="password">Confirm Password</label>
                <div class="input-shell">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="4" y="10" width="16" height="10" rx="2"></rect>
                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                </svg>
                <input  type="password" name="password_confirmation" autocomplete="password_confirmation"  placeholder="Confirm Password" required/>
                </div>
            </div>
          <button class="button button-primary submit-button" type="submit">Register</button>
        </form>
      </div>
    </section>
  </main>
@include('frontend.footer')
</body>
</html>

