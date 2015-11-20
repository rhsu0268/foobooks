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

class PracticeController extends Controller {

    function getExample10()
    {




        /*
        $book = \App\Book::with('author')->orderBy('id', 'DESC')->first();

        dump($book->toArray());

        echo $book->title;

        echo $book->author->first_name;
        */

        
        return 'Example 10';
    }

    function getExample9()
    {
        $author = new \App\Author;
        $author->first_name = 'J.K';
        $author->last_name = 'Rowling';
        $author->bio_url = 'https://en.wikipedia.org/wiki/J._K._Rowling';
        $author->birth_year = '1965';
        $author->save();
        dump($author->toArray());

        $book = new \App\Book;
        $book->title = "Harry Potter and the Philosopher's Stone";
        $book->published = 1997;
        $book->cover = 'http://prodimage.images-bn.com/pimages/9781582348254_p0_v1_s118x184.jpg';
        $book->purchase_link = 'http://www.barnesandnoble.com/w/harrius-potter-et-philosophi-lapis-j-k-rowling/1102662272?ean=9781582348254';
        $book->author()->associate($author); # <--- Associate the author with this book
        $book->save();
        dump($book->toArray());
        return 'Added new book ';
    }

    function getExample8()
    {

        // Query Responsibility

        // talk to Model - going to store
        // get a bunch of data
        // in my collection (use throughout application)

        $books = \App\Book::orderBy('id', 'DESC')->get();

        // constantly going back
        /*
        $books = \App\Book::orderBy('id', 'DESC')->get();
        $first =  \App\Book::orderBy('id', 'ASC')->first();
        $last =  \App\Book::orderBy('id', 'DESC')->first();
        dump($books);
        dump($first);
        dump($last);
        */

        $first = $books->first();
        $last = $books->last();

        dump($books);
        dump($first);
        dump($last);

        //dump($books->title);

        //echo $books;

        /*
        foreach($books as $book)
        {
            echo $book['title'];
            echo $book->title;


        }
        */

        //dump($books->last());

        //return view('books.index')->with('books', $books)
    }


    function getExample7()
    {
        $book = new \App\Book();
        $results = $book->where('published', '<', 1950)->first();

        echo $results->title;
        /*
        foreach ($results as $result)
        {
            echo $result->title.'<br>';
        }
        */
    }
    function getExample6()
    {
        $book = new \App\Book();

        $book_to_update = $book->find(1);

        $book_to_update->title = 'Green Eggs and Ham';

        $book_to_update->save();
    }

    function getExample5()
    {

        $book = new \App\Book();

        $harry_potter = $book->find(6);

        $harry_potter->delete();


    }

    function getExample4()
    {

        $book = new \App\Book();

        $book->title = 'Harry Potter';
        $book->author = 'J.k Rowling';

        $book->save();


        return 'Example 4';
    }

    function getExample3()
    {
        $book = new \App\Book();

        foreach( $book->all() as $book)
        {
            echo $book->title;
        }

        return 'Example 3';
    }
    function getExample2()
    {

        // SELECT * FROM books

        $books = \DB::table('books')->get();

        foreach ($books as $book)
        {
            echo $book->title.'<br>';
        }

        return 'Example 2';
    }

    function getExample1()
    {
        // Use the QueryBuilder to insert a new row into the books table
        // i.e. create a new book
        \DB::table('books')->insert([
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'published' => 1925,
            'cover' => 'http://img2.imagesbn.com/p/9780743273565_p0_v4_s114x166.JPG',
            'purchase_link' => 'http://www.barnesandnoble.com/w/the-great-gatsby-francis-scott-fitzgerald/1116668135?ean=9780743273565',
        ]);

        return "Example 1";
    }

}
