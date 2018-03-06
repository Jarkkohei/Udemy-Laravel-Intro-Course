@extends('layouts.master')

@section('content')
    
    <div class="centered">
        <!--
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
        Eaque qui libero ab temporibus minus ex tempore similique ullam ipsam cumque, 
        officia dolor impedit? Nemo dignissimos neque nostrum sapiente? 
        Harum veniam quasi quia id, sequi voluptas fugit accusantium temporibus recusandae. 
        Quos asperiores voluptatibus illo deleniti voluptatum laborum eaque dolorum quaerat. 
        Magnam nulla suscipit, iure minima consectetur molestias sit non odio sed rerum facere 
        rem quibusdam animi asperiores voluptatem numquam maxime ut culpa commodi. 
        Minus est iusto sapiente optio, veritatis possimus accusantium consequuntur 
        vel maiores ducimus quia esse reprehenderit. 
        Omnis ea dolor maiores quam? Quisquam, non ex porro, 
        cupiditate dolore aut atque fugiat obcaecati illum repellat officia quod nobis optio corrupti 
        cumque natus sequi libero quae minus. 
        Natus, corrupti amet corporis inventore molestias exercitationem nemo dolorem ratione sunt, 
        soluta quam vitae ab hic, doloremque qui mollitia optio ea tenetur eius nam dolore facere. 
        Voluptatibus distinctio sit repudiandae, officia minima ratione vitae facere quia, ad itaque beatae, error ipsum. 
        Nemo blanditiis corrupti iste. Sit omnis similique quaerat maxime nihil eligendi obcaecati nesciunt 
        natus vitae odit perspiciatis ratione a assumenda dolorum aliquam, eveniet facilis labore adipisci voluptate. 
        Debitis, culpa commodi autem nisi eaque quibusdam facere, atque ratione eius 
        nostrum doloremque ullam recusandae esse similique.</p>

        <ul>
            <?php /*
            @for($i = 0; $i < 5; $i++)
                @if($i % 2 === 0)
                <li>Iteration {{ $i + 1 }}</li>
                @endif
            @endfor
            */ ?>
        </ul>
        -->


        <div class="centered">
            <a href="{{ route('greet') }}">Greet</a>
            <a href="{{ route('hug') }}">Hug</a>
            <a href="{{ route('kiss') }}">Kiss</a>
            <br><br>
            <form action="{{ route('benice') }}" method="POST">
                <label for="select-action">I want to...</label>
                <select id="select-action" name="action">
                    <option value="greet">Greet</option>
                    <option value="hug">Hug</option>
                    <option value="kiss">Kiss</option>
                </select>
                <input type="text" name="name">
                <button type="submit">Do a nice action!</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </div>
@endsection