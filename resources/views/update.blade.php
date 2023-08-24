@extends('_layout')
@section('content')
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
                  <input type="text" class="form-control" disabled id="title">
                  
                </div>
                <div id="update-message-title" style="color: red;font-size:18px">

                </div>
                <div class="mb-3">
                  <label class="form-label">the note</label>
                  <textarea  id="note" disabled class="form-control" style="border-radius: 30px;min-height:300px;max-height:300px"></textarea>
                </div>
                <div id="update-message-note" style="color: red;font-size:18px">

                </div>
                <button type="button" id="edit" class="btn btn-primary mb-4" style="font-size:20px">edit</button>
                <button type="button" id="cancel" style="display: none" class="btn btn-danger mb-4" style="font-size:20px">cancel</button>
                <button type="submit" id="save" style="display: none" class="btn btn-primary mb-4" style="font-size:20px">save</button>

              </form>
              
        </div>
    </div>
    
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const title = document.getElementById("title");
    const note = document.getElementById("note");
    const edit = document.getElementById("edit");
    const cancel = document.getElementById("cancel");
    const save = document.getElementById("save");
      
    edit.addEventListener("click", function () {
        title.disabled = false;
        note.disabled = false;
        cancel.style.display = "block";
        edit.style.display = "none";
        save.style.display="block" 
    });

    cancel.addEventListener("click", function () {
        title.disabled = true;
        note.disabled = true;
        cancel.style.display = "none";
        edit.style.display = "block";
        save.style.display="none" 
    });
});




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
                    
                    type: 'put',
                    data: {
                        title: title,
                        note: note
                    },
                    success: function(response) {
    
                        window.location.href = '/'; 
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
                
                    console.log('Error');
                    
              
            }
        });
        });
    </script>
@endsection