<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return view('newsFeed', ['newsList' => News::orderBy('created_at', 'DESC')->simplePaginate(5)]);
    }
}
