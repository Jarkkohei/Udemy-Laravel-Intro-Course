<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller {


    public function getIndex() 
    {
        $quotes =  Quote::all();
        return view('index', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request)
    {
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];

        //  Search for the author.
        $author = Author::where('name', $authorText)->first();

        //  If author not found, create new author.
        if(!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->save();
        }

        //  Create new Quote.
        $quote = new Quote();
        //  Update the Quote.
        $quote->quote = $quoteText;
        //  Save the Authors Quotes.
        $author->quotes()->save($quote);

        return redirect()->route('index')->with([
            'success' => 'Quote saved!'
        ]);
    }
}