@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Job</h1>
            <div class="pull-right">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <form action="/jobs/{{$job->id}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="title"> Title</label>
                        <input type="text" name="title" class="form-control" value="{{$job->title}}">
                    </div>
                    <div class="form-group">
                        <label for="tags[]">Tags</label>
                        <select multiple="multiple" name="tags[]" class="job-tags form-control">
                            @foreach($tags as $tag)
                                <option {{ $job->tags->map(function($tag) {return $tag->id; })->contains($tag->id) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">Description</label>
                        <input type="text" id="summernote" name="description" class="form-control" value="{{$job->description}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="/jobs" class="btn btn-default">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $(".job-tags").select2();
        });

    </script>
@stop