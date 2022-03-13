@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">My Profile</div>
                    <div class="panel-body">
                        <a href="/home"> <- Home </a>
                        <form action="/myprofile/edit" method="post">
                            <label for="first_name">first name</label><br>
                            <input class="input" type="text" name="first_name" value={{$first_name}}><br>
                            <label for="last_name">last name</label><br>
                            <input class="input" type="text" name="last_name" value={{$last_name}}><br>
                            <label for="last_name">email</label><br>
                            <input class="input" type="email" name="email" value={{$email}}><br>
                            <label for="last_name">phone number</label><br>
                            <input class="input" type="text" name="phone_number" value={{$phone_number}}><br>
                            <input class="submit" type="submit" value="Edit">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection