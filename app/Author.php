<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

    public function book()
    {
        return $this->hasMany('\App\Book');
    }

    public function getAuthorsForDropdown()
    {
        $authors = \App\Author::orderby('last_name', 'ASC')->get();

        $authors_for_dropdown = [];
        foreach($authors as $author)
        {
            $authors_for_dropdown[$author->id] = $author->last_name . ', ' . $author->first_name;
        }

        return $authors_for_dropdown;
    }
}
