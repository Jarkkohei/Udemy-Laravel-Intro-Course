@extends('layouts.master')

@section('content')
<style>
    .input-group label {
        text-align: left;
    }
</style>
<form action="" method="POST">
    <div class="input-group">
        <label for="name">Your Name:</label>
        <input type="text" name="name" id="name" placeholder="Your name">

        <label for="password">Your Password: </label>
        <input type="password" name="password" id="password" placeholder="Your password">
    </div>
    <button type="submit">Login</button>
</form>
@endsection