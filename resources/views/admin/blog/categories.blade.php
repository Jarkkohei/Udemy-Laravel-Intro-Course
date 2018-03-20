@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css ">
<link rel="stylesheet" href="{{ URL::asset('css/categories.css') }}">
@endsection

@section('content')
    <div class="container">
        <section id="category-admin">
            <form action="" method="post">
                <div class="input-group">
                    <label for="name">Category name: </label>
                    <input type="text" name="name" id="name">
                    <button type="submit" class="btn">Create Category</button>
                </div>
            </form>
        </section>

        <section class="list">
            @foreach($categories as $category)
                <article>
                    <div class="category-info" data-id="{{ $category->id }}">
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="edit">
                        <nav>
                            <ul>
                                <li class="category-edit"><input type="text"></li>
                                <li><a href="#">Edit</a></li>
                                <li><a href="#" class="danger">Delete</a></li>
                            </ul>
                        </nav>
                    </div>
                </article>
            @endforeach
        </section>

        <!-- If more than one page of results -->
        @if($categories->lastPage() > 1)
            <section class="pagination">
                <!-- If not on first page -->
                @if($categories->currentPage() != 1)
                    <a href="{{ $categories->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
                @endif
                <!-- If not on last page -->
                @if($categories->currentPage() != $categories-lastPage())
                    <a href="{{ $categories->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
                @endif
            </section>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        var token = "{{ Session::token() }}";
    </script>
    <script src="{{ URL::asset('js/categories.js') }}"></script>
@endsection