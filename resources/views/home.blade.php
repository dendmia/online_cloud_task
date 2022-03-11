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



                    @if ($is_autorized)
                        <form action="/process" enctype="multipart/form-data" method="POST">
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
