<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $allowedFields = ['name', 'text', 'date'];
    protected $validationRules=[
      'name'=>'valid_email|required',
        'text'=>'required',
    ];
    protected $validationMessages=[
        'name'=>[
            'valid_email'=>'Введите корректный email',
            'required'=>'Заполните email'
        ],
        'text'=>[
            'required'=>'Заполните текст'
        ],
        'date'=>[
                'required'=>'Заполните дату',
            ]
    ];
    protected $useTimestamps = false;
}
