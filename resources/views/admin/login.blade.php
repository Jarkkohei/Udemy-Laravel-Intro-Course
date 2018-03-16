@extends('layouts.master')

@section('content')
<style>
    .input-group label {
        text-align: left;
    }
</style>

@if(count($errors) > 0)
    <section class="info-box fail">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
    </section>
@endif

@if(Session::has('fail'))
    <section class="info-box fail">
       {{ Sessio::get('fail') }}
    </section>
@endif

<form action="{{ route('admin.login') }}" method="POST">
    <div class="input-group">
        <label for="name">Your Name:</label>
        <input type="text" name="name" id="name" placeholder="Your name">

        <label for="password">Your Password: </label>
        <input type="password" name="password" id="password" placeholder="Your password">
    </div>
    <button type="submit">Login</button>
<input type="hidden" name="_token" value="{{ Session::token() }}">
</form>
@endsection