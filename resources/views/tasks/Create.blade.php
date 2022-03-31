@extends('tasks.layout')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Task</h2>
        </div>
        <div class="pull-right">
           <a class="btn btn-primary" href="{{route('tasks.index')}}">Back</a>
        </div>

        
    </div>
</div>

<form action="{{route('tasks.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="">
            <div class="form-group">
                <strong>Task Description:</strong>
                <input type="type" name="taskName" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="">
            <button type="submit" class="btn btn-primary">Submit</button>


        </div>
    </div>
</form>
@endsection