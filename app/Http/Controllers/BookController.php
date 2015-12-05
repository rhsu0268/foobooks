<?php

// namespace: All controller need to set namespace
// need to use global controllers
// if we use the App namespace, go into app folder
// prevents us from name conflicts - knows that it is defined within the namespace
// set namespace for BookController
namespace App\Http\Controllers;

// use it for a particular class that we are extending
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {

        $books = \App\Book::where('user_id', '=', \Auth::id())->orderBy('id', 'DESC')->get();

        //dump($books->toArray());

        return view('books.index')->with('books', $books);
    }

    /**
    * Responds to requests to GET /books/edit/{$id}
    */
    public function getEdit($id = null) {

        $book = \App\Book::find($id);

        $authorModel = new \App\Author();

        $authors_for_dropdown = $authorModel->getAuthorsForDropdown();

        //dump($authors_for_dropdown);

        if (is_null($book))
        {
            \Session::flash('flash_message', 'Book not found.');
            //return redirect('\books');
        }

        return view('books.edit')->with(['book'=>$book, 'authors_for_dropdown'=>$authors_for_dropdown]);

    }


    /**
     * Responds to requests to POST /books/edit
     */
    public function postEdit(Request $request)
    {
        // validation

        // get the book from the database
        $book = \App\Book::find($request->id);

        $book->title = $request->title;
        $book->author_id = $request->author;
        $book->cover = $request->cover;
        $book->published = $request->published;
        $book->purchase_link = $request->purchase_link;

        $book->save();

        \Session::flash('flash_message', 'Your book was updated.');
        return redirect('\books/edit/' . $request->id);

        //return "Your book was updated!";

    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($title = null) {
        //return 'Show book: '.$title;

        // resources/views/books/show.blade.php
        return view('books.show')->with('title', $title);
    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        //return 'Form to create a new book';

        $authorModel = new \App\Author();
        $authors_for_dropdown = $authorModel->getAuthorsForDropdown();

        return view('books.create')->with('authors_for_dropdown', $authors_for_dropdown);
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate(Request $request) {

        // validation

        $this->validate(
            $request,
            [
                'title' => 'required|min:5',
                'cover' => 'required|url',
                'published' => 'required|min:4'
            ]
        );

        // Code here to enter into the database
        // new Book object
        // mass-assignment
        $book = new \App\Book();
        $book->title = $request->title;
        //$book->author = $request->author;
        $book->author_id = $request->author;
        $book->cover = $request->cover;
        $book->published = $request->published;
        $book->purchase_link = $request->purchase_link;

        $book->save();

        // Confirm book was entered:

        //return 'Process adding new book' . $request->input('title');

        \Session::flash('flash_message', 'Your book was added!');

        return redirect('/books');
    }


}
