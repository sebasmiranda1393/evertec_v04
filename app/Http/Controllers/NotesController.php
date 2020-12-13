<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        $notes = Note::all();
//var_dump($notes);
        return view('notes.index', compact('notes'));
    }

    public function destroy($id)
    {
        Note::findOrFail($id)->delete();

        return redirect()->back();
    }
}
