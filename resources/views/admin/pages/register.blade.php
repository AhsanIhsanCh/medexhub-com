<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="../packages/SBAdmin/css/sb_admin_pro.css" rel="stylesheet">
        <script src="../packages/icon_font/font_awesome/js/pro.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header"><h3 class="text-center font-weight-light my-4">Register New User</h3></div>
                        <div class="card-body">
                            <form action="{{ route('adminRegisterSave') }}" method="post">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="u_fname" value="" placeholder="First Name" />
                                    <label for="FName">First Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="u_lname" value="" placeholder="Last Name" />
                                    <label for="LName">Last Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="email" name="email" value="" placeholder="name@example.com" />
                                    <label for="email">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control"type="password" name="password" placeholder="Password" />
                                    <label for="inputPassword">Password</label>
                                </div>    
                                <div class="form-floating mb-3">
                                    <input class="form-control"type="password" name="password_confirmation" placeholder="Password" />
                                    <label for="inputPassword">Confirm Password</label>
                                </div>    
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <a href="/admin" class="btn btn-success">login</a>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        @if($errors->any())
            <div class="card-footer">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all as $error)

                        <li>{{ $error}}</li>                         
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </body>
</html>
