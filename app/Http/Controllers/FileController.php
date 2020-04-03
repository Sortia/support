<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function get(Message $message)
    {
        return Storage::download($message->file);
    }
}
