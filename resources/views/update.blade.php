<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .update-form input{
            border-radius: 30px;
            height: 3rem;
        }
        .update-form button{
            width: 100%;
            border-radius: 30px;
            height: 3rem;
        }
        
    </style>
</head>
<body style="background:#F2F6FA">
    <div class="container ">
        
        <div class="row mt-5 justify-content-start">
            <div class="col-auto">
                <a href="/" class="btn btn-primary"><-back</a>
            </div>
        </div>
    </div>
    <div class="container ">
    <div class="row align-items-center d-flex justify-content-center" style="flex-direction:column;min-height: 65vh;">
        <div class="col-7 border " style="border-radius: 30px;">
            <h1 style="text-align: center">update Note</h1>
            <form class="update-form" id="update-form" style="max-width: 30rem;margin:auto;">
                <div class="mb-3">
                  <label  class="form-label">title</label>
                  <input type="text" class="form-control" id="title" aria-describedby="emailHelp">
                  
                </div>
                <div id="update-message-title" style="color: red;font-size:18px">

                </div>
                <div class="mb-3">
                  <label class="form-label">the note</label>
                  <textarea  id="note" class="form-control" style="border-radius: 30px;min-height:300px;max-height:300px"></textarea>
                </div>
                <div id="update-message-note" style="color: red;font-size:18px">

                </div>
                <button type="submit" class="btn btn-primary mb-4" style="font-size:20px">update</button>
              </form>
              
        </div>
    </div>
    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var csrfToken  = "{{csrf_token()}}"
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        });
            $('#update-form').submit(function(e) {
                e.preventDefault();
    
                var title = $('#title').val();
                var note = $('#note').val();
    
                $.ajax({
                    url: "/api/note/update/{{$id}}",
                     // Replace with your login route URL
                    type: 'put',
                    data: {
                        title: title,
                        note: note
                    },
                    success: function(response) {
                        // Handle successful login
                       // $('#update-message').text('Login successful. Redirecting...');
                        window.location.href = '/'; // Redirect to homepage or desired route
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.errors || 'add note faild';
                        
                        $('#update-message-title').text(errorMessage.title.join(', '));
                        $('#update-message-note').text(errorMessage.note.join(', '));
                    }
                });
            });
            $.ajax({
            url: '/api/note/getbyid/{{$id}}',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (data) {
                document.getElementById('title').value = data['result']['title'];
                document.getElementById('note').value = data['result']['note'];
                
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status === 401) {
                    localStorage.removeItem('token');                  
                    window.location.href = '/login'; 
                } else {
                    console.log('Error');
                    
                }
            }
        });
        });
    </script>
</body>
</html>