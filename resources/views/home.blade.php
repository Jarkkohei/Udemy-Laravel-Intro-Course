@extends('layouts.master')

@section('content')
    
    <div class="centered">
  
        <div class="centered">
            @foreach($actions as $action)
                <a href="{{ route('niceaction', ['action' => lcfirst($action->name)]) }}">{{ $action->name }}</a>
            @endforeach
           
            <br><br>

            @if (count($errors) > 0)
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('add_action') }}" method="POST">
                
                <label for="name">Name of action: </label>
                <input type="text" name="name" id="name">

                <label for="niceness">Niceness</label>
                <input type="number" name="niceness" id="niceness">

                <button type="submit">Create a nice action!</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
            
        </div>
    </div>
@endsection