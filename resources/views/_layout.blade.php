<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
  <nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" style="margin-left:17px " href="#">User Nots</a>
    <a onclick="logout()" style="float: right;margin-right:12px;color:white" href="#"><i style="font-size: 30px"  class="material-symbols-outlined">
        logout
    </i></a>

  </nav>
  @yield('content')


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    function logout(){
      localStorage.removeItem('token');
      window.location.href = '/login';
}
    $(document).ajaxError(function (event, xhr, options, exc) {
    if (xhr.status === 401) {
      alert("unauthrized")
        // Remove token from localStorage
        localStorage.removeItem('token');
        
        // Redirect to the login page or perform other necessary actions
        window.location.href = '/login';
    }
});

  
function checkToken(){
  if(localStorage.getItem('token')==null){
    window.location.href = '/login';
  }
}
checkToken()

    </script>  
</body>
</html>