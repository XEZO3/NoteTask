<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .login-form input{
            border-radius: 30px;
            height: 3rem;
        }
        .login-form button{
            width: 100%;
            border-radius: 30px;
            height: 3rem;
        }
        
    </style>
</head>
<body style="background:#F2F6FA">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <div class="container mt-5 pt-5">
        <div class="row align-items-center d-flex justify-content-center" style="flex-direction:column;min-height: 65vh;">
            <div class="col-7 border " style="border-radius: 30px;">
                <h1 style="text-align: center">Sign In</h1>
                <form class="login-form" id="login-form" style="max-width: 30rem;margin:auto;">
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">Email address</label>
                      <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                      
                    </div>
                    <div id="login-message-email" style="color: red;font-size:18px">

                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Password</label>
                      <input type="password" class="form-control" id="password">
                    </div>
                    <div id="login-message-password" style="color: red;font-size:18px">

                    </div>
                    <p>have an account? <a href="/register" style="text-decoration: none">create account</a></p>
                    <button type="submit" class="btn btn-primary mb-4">Submit</button>
                  </form>
                  
            </div>
        </div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var csrfToken  = "{{csrf_token()}}"
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
        $('#login-form').submit(function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: "/api/login",
                 // Replace with your login route URL
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    // Handle successful login
                    $('#login-message').text('Login successful. Redirecting...');
                    localStorage.setItem("token", response.token);
                    window.location.href = '/'; // Redirect to homepage or desired route
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.errors || 'Login failed';
                    
                    $('#login-message-email').text(errorMessage.email.join(', '));
                    $('#login-message-password').text(errorMessage.password.join(', '));
                }
            });
        });
    });
</script>
</body>
</html>