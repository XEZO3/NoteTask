@extends('_layout')
@section('content')
<style>
    .long-string-column {
    max-width: 200px;
    word-break: break-word;
}

/* Adjust the minimum width for mobile devices */
@media (max-width: 576px) {
    .long-string-column {
        min-width: 100px; /* Set your desired minimum width */
    }
}
   
.filter-form input{
            border-radius: 0.25rem;
           
        }

        .note-container{
            overflow-y:scroll 
        }
        </style>


    <div class="container ">
        <div class="row mt-5 justify-content-center">
           <div class="col-4" style="margin-right:-20px ">
            <form id="filter-form" class="filter-form" method="get">
                <input type="text" id="search" class="form-control"  placeholder="search your notes">
                <div id="search-message-note" style="color: red;font-size:18px">

                </div>
           
           </div>
           <div class="col-auto" style="margin-right:-20px ">
            <button class="btn btn-primary">Search</button>
           </div>
           <div class="col-auto">
            <button type="reset" onclick="getdata()" style="color:red" class="btn">clear</button>
           </div>
        </form>
        </div>
       
    </div>
<div class="container mt-4 bg-white note-container" style="max-height: 68vh" >
    <div class="table-responsive">
    <table class="table table-hover  bg-white" >
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Note</th>
            <th scope="col">Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody id="tableBody">
           
        </tbody>
      </table>
    </div>
</div>
<div class="container">
    <div class="row mt-4 justify-content-end">
        <div class="col-auto">
            <a href="/note/create" class="btn btn-primary">Add new note</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    function tablebody(data){
        var tableBody = $('#tableBody');
                tableBody.empty();
        $.each(data['result'], function (index, item) {
                    var datef = item.updated_at
                    const date = new Date(datef);
                    const options = { year: 'numeric', month: 'long', day: 'numeric' };
                    const formattedDate = date.toLocaleDateString('en-US', options);
                    var row = $('<tr>');
                    row.append($('<td>').text(index+1));
                    row.append($('<td>').text(item.title));
                    row.append($('<td class="long-string-column">').text(item.note));
                    row.append($('<td>').text(formattedDate));
                    row.append($('<td>').html("<a id='delete' class='btn btn-danger' data-index="+item.id+">delete</a> <a class='btn btn-primary' href='/note/update/"+item.id+"'>update</a>"));
                    tableBody.append(row);
                });
    }
    $(document).ready(function () {
       
        $(document).on('click', '#delete', function () {
            var id = $(this).data('index');
            $.ajax({
            url: '/api/note/delete/'+id,
            method: 'delete',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (data) {
               getdata()
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("error")
            }
        });
        });
      getdata();
      function getdata(){  
        $.ajax({
            url: '/api/note/getall',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (data) {
                
                    
               
                tablebody(data)
                
            },
            error: function (xhr, textStatus, errorThrown) {
                
            }
        });
    }
    window.getdata = getdata;

    
        $('#filter-form').submit(function(e) {
                e.preventDefault();
    
                var search = $('#search').val();
               
    
                $.ajax({
                    url: "/api/note/getall",
                     // Replace with your login route URL
                    type: 'get',
                    data: {
                        search: search,
                       
                    },
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    },
                    dataType: 'json',
                    success: function(response) {
                     
                        tablebody(response)
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseJSON.errors;

                        $('#search-message-note').text(errorMessage.note.join(', '));
                    }
                });
            });
    
    });
</script>
@endsection