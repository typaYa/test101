<?php

namespace App\Controllers;

class CommentsController extends BaseController
{
    public function comments()
    {
        $model = new \App\Models\CommentsModel();
        $comments = $model->findAll(); // Пагинация по 3 комментария на странице
        $comments = $model->paginate(3);
        $pager = $model->pager;
        $sort = $this->request->getVar('sort') ? $this->request->getVar('sort') : 'id_asc';

        switch ($sort) {
            case 'id_desc':
                $comments = $model->orderBy('id', 'DESC')->paginate(3);
                break;
            case 'date_asc':
                $comments =$model->orderBy('date', 'ASC')->paginate(3);
                break;
            case 'date_desc':
                $comments =$model->orderBy('date', 'DESC')->paginate(3);
                break;
            case 'id_asc':
            default:
            $comments =$model->orderBy('id', 'ASC')->paginate(3);
                break;
        }

        return view('comments', ['comments' => $comments,'pager' => $pager,'sort' => $sort]);
    }
        public function show($id)
        {
            $model = new \App\Models\CommentsModel();
            $comment = $this->getCommentsOr404($id);
            if ($comment === null){
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Коментарий с айди:$id не найден:( ");
            }
            return view('show', ['comment' => $comment]);
        }

    public function new()
    {
        $model = new \App\Models\CommentsModel();
        $data =[
            'name' => $this->request->getPost('email'),
            'text' => $this->request->getPost('text'),
            'date' => $this->request->getPost('date'),
        ];

        $result = $model->insert($data);
        if (!$result){
            return redirect()->
            back()->
            withInput($data)->
            with('errors', $model->errors());

        }else{
            $comments = $model->findAll();
            return redirect()->
            to('/comments')->
            with('success',true)->
            with('data',$data)->with('comments',$comments);
        }

    }
    public function edit($id)
    {
        $model = new \App\Models\CommentsModel();
        $comment = $this->getCommentsOr404($id);

        return view('edit', ['comment' => $comment]);
    }
    public function update($id)
    {
        $model = new \App\Models\CommentsModel();
        $comment =[
            'name' => $this->request->getPost('email'),
            'text' => $this->request->getPost('text'),
            'date' => $this->request->getPost('date'),
        ];
        $result = $model->update($id,$comment);
        if (!$result){
            return redirect()->
            back()->
            withInput($comment)->
            with('errors', $model->errors());

        }else{
            $comments = $model->findAll();
            return redirect()->
            to('/comments')->
            with('success',true)->
            with('comment',$comments);
        }
    }
    public function delete($id)
    {
        $model = new \App\Models\CommentsModel();
        $comment = $this->getCommentsOr404($id);
        if ($model->delete($id)){
            return redirect()->to('/comments')->
            with('success', true);

        }else{
            $comments = $model->findAll();
            return redirect()->
            to('/comments')->
            with('success',true)->with('comments',$comments);
        }
    }
    public function getCommentsOr404($id)
    {
        $model = new \App\Models\CommentsModel();
        $comment = $model->find($id);
        if ($comment === null){
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Коментарий с айди:$id не найден:( ");
        }
        return $comment;

    }
}