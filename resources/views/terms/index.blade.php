@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add">Add new</button>
<h1>Terms</h1>
<table class="table table-striped">
	<tr>
		<th width="20">ID</th>
		<th>Name</th>
		<th>Description</th>
		<th>Dates</th>
        <th>Children</th>
        <th>Parents</th>
		<th></th>
	</tr>
    @foreach ($terms as $term)
    <tr>
    	<td>{{ $term->id }}</td>
    	<td>
    		<strong>{{ $term->name }}</strong><br />
    		<small><a href="/timeline/{{ $term->slug }}">{{ $term->slug }}</a></small>
    	</td>
    	<td>{{ $term->description }}</td>
        <td>{{ count($term->dates) }}</td>
        <td>{{ count($term->children) }}</td>
        <td>{{ count($term->parents) }}</td>
    	<td></td>
        
    </tr>
    @endforeach
</table>

	{{ $terms->links() }}


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{ url('terms') }}" method="POST">
            {{ csrf_field() }}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add new</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input name="name" id="name" type="text" class="form-control input-lg" value="{{ old('name') }}" required> 
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" required>{{ old('description') }}</textarea>
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