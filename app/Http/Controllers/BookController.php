<?php

// namespace: All controller need to set namespace
// need to use global controllers
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BookController extends Controller {

    public function __construct() {
        # Put anything here that should happen before any of the other actions
    }

    /**
    * Responds to requests to GET /books
    */
    public function getIndex() {
        return 'List all the books';
    }

    /**
     * Responds to requests to GET /books/show/{id}
     */
    public function getShow($title) {
        return 'Show book: '.$title;
    }

    /**
     * Responds to requests to GET /books/create
     */
    public function getCreate() {
        //return 'Form to create a new book';

        $view = '<form method="POST" action="/books/create">';
        $view .= csrf_field();
        $view .= '<input type="text" name="title">';
        $view .= '<input type="submit">';
        $view .= '<form>';
        return $view;
    }

    /**
     * Responds to requests to POST /books/create
     */
    public function postCreate() {
        return 'Process adding new book' . $_POST['title'];
    }
}