@extends('tasks.layout')

@section('content')

<div class="container-fluid">
    <div class="title"> 
        <h1>TO DO LIST</h1>    
    </div>
    <br>
    <div class="taskEditContainer" style="";>
        <div class="row">
            <div class="col-lg-12">
                <div style="color:white;border-bottom:1px solid white">
                    <h2>Edit Task</h2>
                </div>
                <br>
            </div>
        </div>


        <form action="{{route('tasks.update',$task->id)}}"method="POST">


            @csrf

            @method('PUT')

            <div class="row">
                <div class="form-group">
                    <strong style="color:white">Task Name:</strong>
                   
                    <input type="text" name="taskName" value="{{$task->taskName}}" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="">
                    <button type="submit" id="updateTask" name="updateTask" class="btn btn-primary">Update</button>
                    <a class="btn btn-primary" href="{{route('tasks.index')}}">Back</a>

                </div>
                <div class="">
                    <br>
                   
                    <br>
                </div>
            </div>
            <br>
        </form>

    </div>
</div>

@endsection
