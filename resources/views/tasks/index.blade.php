@extends('tasks.layout')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $(document).ready(function () {
        // var loading = alertify.alert("", "Please Wait").set('frameless', true).set('closable', false).set({ transition: 'zoom' });
        // loading.set('resizable', true).resizeTo('80%', '20%');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        //SAVE TASK (JS)
        $("#saveTask").click(function () {
            alertify.set('notifier', 'position', 'top-center');
            var taskName = $("#taskName").val();

            //alert(taskName);
            if (taskName == "") {
                alertify.error('Please enter your task');
            }
            else {
                alertify.confirm('Confirmation', 'Add task?', function (e) {
                    
                    addTask(taskName);
                }, function () { });
            }
        });


        // FUNCTION TO CROSS OUT COMPLETED TASK(ONCLICK)
        $("tr").on("click", "td", function () {
        $(this).toggleClass("completed");
        });
        

    });

    
    //SAVE FUNCTION FOR TASK
    function addTask(taskName) {
        var loadingNotifier = alertify.notify('Loading..', 'success');
        alertify.set('notifier', 'position', 'top-center');
    
        //$.post("{{route('tasks.store')}}",
        $.post("/api/tasks/store/",
            {
                
                taskName: taskName
            },
            function (response) {
                //alert(response);
                if (response.replace(/\"/g, "") == "saved") {
                    alertify.notify('Task saved', 'success', 2, function () { window.location.reload(true); });
                    loadingNotifier.dismiss();
                }
                if (response.replace(/\"/g, "") == "error") {
                    alertify.error('Error', 5);
                    loadingNotifier.dismiss();
                }

            });
    }


    function ConfirmDeleteData(id){
       alertify.confirm('Confirmation', 'Delete task?', function () { deleteTask(id); }
            , function () { });
    }

  
    function deleteTask(id) {
        // var loading = alertify.alert("", "Please Wait").set('frameless', true).set('closable', false).set({ transition: 'zoom' });
        // loading.set('resizable', true).resizeTo('30%', '20%');
        $.post("api/tasks/destroy/"+id, {},
            function (response, status) {
                alertify.set('notifier', 'position', 'top-center');
                if (status == "success") {
                    switch (response.replace(/\"/g, "")) {
                        case "error":
                            alertify.error("Ralat.", 5);
                            break;
                        case "norecord":
                            alertify.error("Tidak ada rekod.", 5);
                            break;
                        case "deleted":
                            var notification = alertify.success("Task deleted.", 2);
                            notification.ondismiss = function () { location.reload(true); };
                            break;
                    }
                    // loading.close();
                }
            });
    }
</script>


@section('content')
<div class="container-fluid">

    <div class="title"> 
        <h1>TO DO LIST</h1>
    </div>
    <br>

    <!-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{route('tasks.create')}}">CREATE NEW</a>
            </div>
        </div>
    </div> -->

    <div class="taskListContainer">
        <br>
        <div class="input-group mb-3">
        <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Add New Task" aria-describedby="basic-addon2">
            <div class="input-group-append input-group-lg">
                <button class="btn btn-outline-secondary addbtn" id="saveTask" name="saveTask" class="btn btn-primary"><i class="fas fa-plus"></i></button>
            </div>
        </div>


        <h6 style="font-style: italic; color:white">Click Task if completed</h6>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="taskList">
                <tr>
                    <th style="display:none">No</th>
                    
                    <th style="width:90%">Task Description</th>
                    <th style="width:5%"></th>
                    <th style="width:5%"></th>
                </tr>

                @foreach ($tasks as $task)
                <tr>
                    <td style="display:none">{{++$i}}</td>
                    <td>{{$task->taskName}}</td>
                    <td><a class="btn btn-primary" href="{{route('tasks.edit',$task->id)}}"><i class='far fa-edit'></i></a></td>
                    <td>@csrf
                        <button type="submit" class="btn btn-danger" onclick="ConfirmDeleteData({{$task->id}});"><i class="fas fa-times" ></i></button>     
                    </td>
                </tr>
                @endforeach
            </table>
           
        </div>
        
    </div>
    <br><br>
</div>


@endsection
