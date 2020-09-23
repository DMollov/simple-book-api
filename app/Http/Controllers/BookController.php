<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Resources\Book as BookResource;
use App\Notifications\NewBook;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::with('author')->paginate());
    }


    /**
     * [Create a new book.]
     * @bodyParam  title string required The name of the book.
     * @bodyParam  description string required The description of the book.
     * @bodyParam  author_id integer required The user which is adding the book.
     * @bodyParam  cover required Cover photo of the book.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'author_id' => 'exists:users,id',
            'cover' => 'required|image'
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $coverPath = Storage::url($request->cover->store('public/images'));
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => $request->author_id,
            'cover' => $coverPath,
        ]);

        return $book;
    }
}
