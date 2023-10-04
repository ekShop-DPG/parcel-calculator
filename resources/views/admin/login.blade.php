<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login Page</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('') }}/assets/front/custom.css">
</head>
<body>
    <div class="login_wrap">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-lg-4">
                    <div class="form_container">
                        @if (Session::has('error'))
                        <p class=" alert alert-danger">{{ Session::get('error') }}</p>
                        @endif
                        <form action="{{ route('admin.login') }}" method="post">
                            @csrf
                            <h2>Admin Login</h2>
                            <div class="mb-3">
                              <label for="exampleInputEmail1" class="form-label">User Name</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" name="username">
                              @if ($errors->has('username'))
                              <span class="text-danger">{{ $errors->first('username') }}</span>
                              @endif
                            </div>
                            <div class="mb-3">
                              <label for="exampleInputPassword1" class="form-label">Password</label>
                              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                              @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>