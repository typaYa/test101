<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function comments()
    {
        $model = new \App\Models\CommentsModel();
        $data = $model->findAll();
        return view('comments', ['comments' => $data]);
    }
}
