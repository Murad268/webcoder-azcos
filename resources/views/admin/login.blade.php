<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Admin Login</title>
    <style>
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper form {
            width: 400px;
        }
    </style>
</head>

<body>
    <div class="wrapper" style="width: 400px;">
        <form method="POST" action="{{ route('admin.auth.login') }}">
            @csrf
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="form2Example1" name="email" class="form-control" value="{{ old('email') }}" />
                <label class="form-label" for="form2Example1">Email address</label>
                @if ($errors->has('email'))
                <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="form2Example2" name="password" class="form-control" />
                <label class="form-label" for="form2Example2">Password</label>
                @if ($errors->has('password'))
                <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="form2Example31" {{ old('remember') ? 'checked' : '' }} />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>
            </div>
            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
        </form>
    </div>
</body>

</html>
