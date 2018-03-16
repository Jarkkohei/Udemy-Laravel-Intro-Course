<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\AuthorLog;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuoteController extends Controller {


    public function getIndex($author = null) 
    {
        if(!is_null($author)) {
            $quote_author = Author::where('name', $author)->first();

            if($quote_author) {
                $quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
            }
            
        } else {
            $quotes =  Quote::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('index', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request)
    {
        $this->validate($request, [
            'author' => 'required|max:60|alpha',
            'quote' => 'required|max:500',
            'email' => 'required|email'      
        ]);

        $authorText = ucfirst($request['author']);
        $authorEmail = $request['email'];
        $quoteText = $request['quote'];

        //  Search for the author.
        $author = Author::where('name', $authorText)->first();

        //  If author not found, create new author.
        if(!$author) {
            $author = new Author();
            $author->name = $authorText;
            $author->email = $authorEmail;
            $author->save();
        }

        //  Create new Quote.
        $quote = new Quote();
        //  Update the Quote.
        $quote->quote = $quoteText;
        //  Save the Authors Quotes.
        $author->quotes()->save($quote);

        //  Fire the loggin event and pass the author for it.
        Event::fire(new QuoteCreated($author));

        return redirect()->route('index')->with([
            'success' => 'Quote saved!'
        ]);
    }

    public function getDeleteQuote($quote_id)
    {
        //  Optional usage: $quote = Quote::where('id', $quote_id)->first();
        $quote = Quote::find($quote_id);

        $author_deleted = false;
        
        //  If the author only has one Quote -> delete also the Author.
        if(count($quote->author->quotes) === 1) {
            $quote->author->delete();
            $author_deleted = true;
        }

        $quote->delete();

        $msg = $author_deleted ? 'Quote and Author deleted!' : 'Quote deleted!';
        return redirect()->route('index')->with(['success' => $msg]);
    }

    public function getMailCallback($author_name) 
    {
        $author_log = new AuthorLog();
        $author_log->author = $author_name;
        $author_log->save();
        return view('email.callback', ['author' => $author_name]);
    }
}