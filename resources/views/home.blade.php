@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="d-flex flex-wrap">
                        @if ($file_names)
                            @foreach ($file_names as $file)
                                <div class="p-3 m-3">
                                    <br><a target="_blank" href="{{ $path }}{{ $file }}">{{ $file }}</a><br>
                                    <embed src="{{ $path . $file }}" height="300px" />
                                    <form action="/rename" method="POST">
                                        <input type="hidden" name="filename" value="{{ $file }}">
                                        <input type="text" name="newfilename">
                                        <input type="submit" value="rename">
                                        {{ csrf_field() }}
                                    </form>
                                    <form action="/delete" method="POST">
                                        <input type="hidden" name="filename" value="{{ $file }}">
                                        <input type="submit" value="delete">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($is_autorized)
                        <form action="/upload" enctype="multipart/form-data" method="POST">
                            <p>
                                <label for="photo">
                                    <input type="file" name="photo" id="photo">
                                </label>
                            </p>
                            <button>Upload</button>
                            {{ csrf_field() }}
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
