@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add">Add new</button>
<h1>Dates</h1>
<table class="table table-striped">
	<tr>
		<th width="20">ID</th>
		<th>Name</th>
		<th>Start Date</th>
		<th>Rank</th>
        <th>active</th>
        <th>Terms</th>
		<th></th>
	</tr>
    @foreach ($dates as $date)
    <tr>
    	<td>{{ $date->id }}</td>
        <td>{{ $date->name }}</td>
        <td>{{ $date->start_date }}</td>
        <td>{{ $date->rank }}</td>
        <td>{{ $date->active }}</td>
        <td>{{ count($date->terms) }}</td>
    	<td></td>
    </tr>
    @endforeach
</table>

	{{ $dates->links() }}


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ url('dates') }}" method="POST">
            {{ csrf_field() }}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" class="form-control" value="{{ old('name') }}" required> 
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input name="start_date" id="start_date" type="date" class="form-control" value="{{ old('start_date') }}" required> 
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
              </div>
        </form>
    </div>
  </div>
</div>

@endsection