<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function books() {
        return $this->belongsToMany('\App\Book')->withTimestamps();
    }

    public function getTagsForCheckboxes() {

    // get all tags
    $tags = $this->orderBy('name','ASC')->get();

    // create an array
    $tagsForCheckboxes = [];

    foreach($tags as $tag) {
        $tagsForCheckboxes[$tag['id']] = $tag->name;
    }

    return $tagsForCheckboxes;

}
}
