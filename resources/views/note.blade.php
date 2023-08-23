<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    .long-string-column {
    max-width: 200px;
   
    word-break: break-word;
    
}


</style>
</head>
<body style="background:#F2F6FA">
    <div class="container ">
        <div class="row mt-5 justify-content-center">
           <div class="col-6">
            <form>
                <input type="text" style="width: 70%" class="form-control" style="display: inline">
                <button style="display: inline">search</button>
            </form>
           </div>
        </div>
        <div class="row mt-2 justify-content-end">
            <div class="col-auto">
                <a href="/note/create" class="btn btn-primary">add new note</a>
            </div>
        </div>
    </div>
<div class="container mt-1 border" style="border-radius: 30px">
    <table class="table">
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
                if (xhr.status === 401) {
                    localStorage.removeItem('token');                 
                    window.location.href = '/login';
                } else {
                    console.log('Error');
                }
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
                if (xhr.status === 401) {
                    localStorage.removeItem('token');                  
                    window.location.href = '/login'; 
                } else {
                    console.log('Error');
                    
                }
            }
        });
    }
   
    
    });
</script>
</body>
</html>