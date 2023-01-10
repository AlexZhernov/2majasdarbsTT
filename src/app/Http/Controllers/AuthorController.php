<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function __construct()
    {
     $this->middleware('auth');
    }
    
    // display all authors
    public function list()
    {
        $items = Author::orderBy('name', 'asc')->get();
        return view(
            'author.list',
            [
                'title' => 'Autori',
                'items' => $items
            ]
        );
    }

    public function create()
    {
        return view(
            'author.form',
            [
                'title' => 'Pievienot autoru',
                'author' => new Author()
            ]
        );
    }


    public function put(Request $request)
    {
        $author = new Author();
        $this->saveAuthorData($author, $request);
        return redirect('/authors');
    }

    public function patch(Author $author, Request $request)
    {
        $this->saveAuthorData($author, $request);
        return redirect('/authors');
    }

    private function saveAuthorData(Author $author, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
        $author->name = $validatedData['name'];
        $author->save();
    }

    public function update(Author $author)
    {
        return view(
            'author.form',
            [
                'title' => 'Rediģēt autoru',
                'author' => $author
            ]
        );
    }



    public function delete(Author $author)
    {
        $author->delete();
        return redirect('/authors');
    }



}