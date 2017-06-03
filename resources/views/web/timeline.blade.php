@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Parents</div>

            <div class="panel-body">
                @foreach($term->parents as $parent)
                	<a href="/timeline/{{ $parent->slug }}">{{ $parent->name }}</a> | 
                @endforeach

                <form action="/timeline/{{ $term->slug }}/relation" method="POST">
            		{{ csrf_field() }}
            		<div class="form-group">
            			<label for="parent_id">Parent</label>
            			<select name="parent_id" class="form-control input-sm">
            				@foreach($terms as $terml)
            					<option value="{{ $terml->id }}">{{ $terml->name }}</option>
            				@endforeach
            			</select>
            		</div>
            		<div class="form-group">
            			<button type="submit" class="btn btn-xs btn-primary">Add parent</button>
            		</div>
            	</form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Children</div>

            <div class="panel-body">
                @foreach($term->children as $child)
                	<a href="/timeline/{{ $child->slug }}">{{ $child->name }}</a> | 
                @endforeach

                <form action="/timeline/{{ $term->slug }}/relation" method="POST">
            		{{ csrf_field() }}
            		<div class="form-group">
            			<label for="child_id">Child</label>
            			<select name="child_id" class="form-control input-sm">
            				@foreach($terms as $terml)
            					<option value="{{ $terml->id }}">{{ $terml->name }}</option>
            				@endforeach
            			</select>
            		</div>
            		<div class="form-group">
            			<button type="submit" class="btn btn-xs btn-primary">Add parent</button>
            		</div>
            	</form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">Add Date</div>

            <div class="panel-body">

                <form action="/timeline/{{ $term->slug }}/date" method="POST">
            		{{ csrf_field() }}
            		<div class="form-group">
            			<label for="id">Date</label>
            			<select name="id" class="form-control input-sm">
            				@foreach($dates as $date)
            					<option value="{{ $date->id }}">{{ $date->name.' '.$date->start_date }}</option>
            				@endforeach
            			</select>
            		</div>
            		<div class="form-group">
            			<button type="submit" class="btn btn-xs btn-primary">Add date</button>
            		</div>
            	</form>
            </div>
        </div>
    </div>
</div>


        <h1>{{ $term->name }}</h1>
        <h4>{{ $term->description }}</h4>

<ul class="timeline">
<?php $classeven = 1; ?>
	@foreach($term->dates as $date)
		<li class="<?php if($classeven == 1) { echo 'timeline-inverted'; $classeven = 0; } else { $classeven = 1; } ?>">
	        <div class="timeline-badge">
	          <a><i class="fa fa-circle" id=""></i></a>
	        </div>
	        <div class="timeline-panel">
	            <div class="timeline-heading">
	                <h4>{{ $date->name }} <a class="btn btn-xs btn-primary tr_post" data-form={{ $date->id }}>Add more</a></h4>
	            </div>
	            
	            @foreach($date->posts as $post)
                    <div class="timeline-body">
                        <p>
                        <span class="badge pull-right">{{ $post->user->name }}</span>
                        <strong>{{ $post->name }}</strong><br />
                        {{ $post->description }}</p>
                    </div>
	            @endforeach
                <div class="timeline-form tr_form_{{ $date->id }}" style="display: none;">
                    <form action="/timeline/{{ $term->slug }}/date/{{ $date->id }}/post" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control input-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-xs btn-primary">Add post</button>
                        </div>
                    </form>
                </div>
	            <div class="timeline-footer">
	                <p>
                    Terms: 
                    @foreach($date->terms as $dateterm)
                        <a href="/timeline/{{ $dateterm->slug }}">{{ $dateterm->name }}</a>, 
                    @endforeach
                    </p>
                    <p>{{ $date->start_date }}</p>
	            </div>
	        </div>
	    </li>
	@endforeach
</ul>

@endsection
