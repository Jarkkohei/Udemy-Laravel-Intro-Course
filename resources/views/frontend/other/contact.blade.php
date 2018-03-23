@extends('layouts.master')

@section('title')
    Contact
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/form.css') }}">
@endsection

@section('content')
    @include('includes.info-box')
    <form action="{{ route('contact.send') }}" method="post" id="contact-form">
        <div class="input-group">
            <label for="name">Your Name: </label>
            <input type="text" name="name" id="name" {{ $errors->has('name') ? 'class=has-error' : '' }} value="{{ Request::old('name') }}">
        </div>
        <div class="input-group">
            <label for="email">Your E-mail: </label>
            <input type="text" name="email" id="email" {{ $errors->has('email') ? 'class=has-error' : '' }} value="{{ Request::old('email') }}">
        </div>
        <div class="input-group">
            <label for="subject">Subject: </label>
            <input type="text" name="subject" id="subject" {{ $errors->has('subject') ? 'class=has-error' : '' }} value="{{ Request::old('subject') }}">
        </div>
        <div class="input-group">
            <label for="message">Your Message: </label>
            <textarea name="message" id="message" rows="10" {{ $errors->has('message') ? 'class=has-error' : '' }} >{{ Request::old('message') }}</textarea>
        </div>
        <button type="submit" class="btn">Submit Message</button>
        <input type="hidden" value="{{ Session::token() }}" name="_token">
    </form>
@endsection