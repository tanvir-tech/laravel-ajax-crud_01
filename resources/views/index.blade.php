<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Ajax practice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('Frontend/bg.css')}}">
    
</head>
<body class="gradient-background">
    





<div class="container p-5">

    <div class="row">
        <div class="col-lg-9">
            
    <h3 class="text-center text-warning">Approve notice</h3>
    <table class="table table-striped">
        <thead class="bg-info text-white">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Department</th>
                <th scope="col">Institute</th>
                <th scope="col">Options</th>
            </tr>
        </thead>
        <tbody>
         
    {{-- @foreach ($notices as $notice)

    <tr>
        <th scope="row">{{$notice['id']}}</th>
        <td>{{$notice['title']}}</td>
        <td>{{$notice['department']}}</td>
        <td>
            <a href="approveNotice/{{$notice['id']}}" class="text-white btn btn-success">Approve</a>
        </td>
        <td>
            <a href="deleteNotice/{{$notice['id']}}" class="text-white btn btn-danger">Delete</a>
        </td>
    </tr>

    @endforeach --}}



        </tbody>
    </table>
        </div>
        <div class="col-lg-3">
            <form>
                @csrf
              <br>
              <h4 id="addHead" class="text-center">Add new Teacher</h4>
              <h4 id="updateHead" class="text-center">Update Teacher</h4>
              <br>
              <input class="form-control mr-sm-2" type="text" placeholder="Name" name="name" id="name">
              <span class="text-danger" id="nameError"></span>
              <br>
              <input class="form-control mr-sm-2" type="text" placeholder="title" name="title" id="title">
              <span class="text-danger" id="titleError"></span>
              <br>
              <input class="form-control mr-sm-2" type="text" placeholder="department" name="department" id="department">
              <span class="text-danger" id="departmentError"></span>
              <br>
              <input class="form-control mr-sm-2" type="text" placeholder="institute" name="institute" id="institute">
              <span class="text-danger" id="instituteError"></span>
              <br>
              <input type="hidden" id="id">
              <button id="addButton" class="btn btn-success" onclick="addData()">Add</button>
              <button id="updateButton" class="btn btn-warning" type="submit" onclick="editData()">Update</button>
              <br>
              <br>
              </form>
        </div>
    </div>



</div>












{{-- jquery cdn  --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- b4 cdn  --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('#addHead').show();
        $('#updateHead').hide();
        $('#addButton').show();
        $('#updateButton').hide();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })


        function alldata(){
            $.ajax({
            type:"GET",
            datatype:'json',
            url:'/teacher/all',
            success: function(response){
                console.log(data);
                var data ="";
                $.each(response,function(key,value){
                    data=data+"<tr>";
                    data=data+"<td>"+value.id+"</td>";
                    data=data+"<td>"+value.name+"</td>";
                    data=data+"<td>"+value.title+"</td>";
                    data=data+"<td>"+value.department+"</td>";
                    data=data+"<td>"+value.institute+"</td>";
                    data=data+"<td>"+"<button class='btn btn-danger'>Delete</button>"
                                    +"<button class='btn btn-info' onclick='editTeacher("+value.id+")'>Edit</button>"
                             +"</td>";
                             
                    data=data+"<tr>";
                })
                $('tbody').html(data);
            }
        })
        }

        alldata();

        function addData(){
            var name = $('#name').val();
            var title = $('#title').val();
            var department = $('#department').val();
            var institute = $('#institute').val();



            $.ajax({
            type:"POST",
            datatype:'json',
            data:{name:name,title:title,department:department,institute:institute},
            url:'/teacher/add',
            success: function(response){
                console.log('add success');
                clearData();
                alldata();
            
            },
            error:function(error){
                $('#nameError').text(error.responseJSON.errors.name);
                $('#titleError').text(error.responseJSON.errors.title);
                $('#departmentError').text(error.responseJSON.errors.department);
                $('#instituteError').text(error.responseJSON.errors.institute);
            }
        })

        }



        
        function clearData(){
            $('#name').val('');
            $('#title').val('');
            $('#department').val('');
            $('#institute').val('');
        }


        function editTeacher(id){
            $.ajax({
            type:"GET",
            datatype:'json',
            url:'/teacher/edit/'+id,
            success: function(response){
                $('#addHead').hide();
                $('#updateHead').show();
                $('#addButton').hide();
                $('#updateButton').show();

                $('#id').val(response.id);
                $('#name').val(response.name);
                $('#title').val(response.title);
                $('#department').val(response.department);
                $('#institute').val(response.institute);
            }
        })
        }

        function editData(){
            var id = $('#id').val();
            var name = $('#name').val();
            var title = $('#title').val();
            var department = $('#department').val();
            var institute = $('#institute').val();
            // console.log(institute);
           
            $.ajax({
            type:"POST",
            datatype:'json',
            data:{name:name,title:title,department:department,institute:institute},
            url:'/teacher/update/'+id,
            success: function(response){
                console.log('edit success');
                clearData();
                alldata();
            
            },
            error:function(error){
                $('#nameError').text(error.responseJSON.errors.name);
                $('#titleError').text(error.responseJSON.errors.title);
                $('#departmentError').text(error.responseJSON.errors.department);
                $('#instituteError').text(error.responseJSON.errors.institute);
            }
        })
        }

        
    </script>
</body>
</html>