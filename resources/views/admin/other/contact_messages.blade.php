@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/modal.css') }}">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/font-awesome.min.css">
@endsection

@section('content')
    <div class="container">
        <section class="list">
            @if(count($contact_messages) == 0)
                No Messages
            @endif
            @foreach($contact_messages as $contact_message)
                <article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
                    <div class="message-info">
                        <h3>{{ $contact_message->subject }}</h3>
                        <span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
                    </div>
                    <div class="edit">
                        <nav>
                            <ul>
                                <li><a href="#">Show Message</a></li>
                                <li><a href="#" class="danger">Delete</a></li>
                            </ul>
                        </nav>
                    </div>
                </article>
            @endforeach
        </section>

        <!-- If more than one page of results -->
        @if($contact_messages->lastPage() > 1)
            <section class="pagination">
                <!-- If not on first page -->
                @if($contact_messages->currentPage() != 1)
                    <a href="{{ $categories->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
                @endif
                <!-- If not on last page -->
                @if($contact_messages->currentPage() != $contact_messages-lastPage())
                    <a href="{{ $contact_messages->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
                @endif
            </section>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        var token = "{{ Session::token() }}";
    </script>
    <script src="{{ URL::asset('js/modal.js') }}"></script>
    <script src="{{ URL::asset('js/contact_messages.js') }}"></script>
@endsection