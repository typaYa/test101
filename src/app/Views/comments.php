<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Коментарии</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<style>
    .comment{
        position: relative;
        padding: 5px 10px;
        border: 1px solid #c7c7c7;
        border-radius: 10px;
    }
    .text {
        word-break: break-word;
    }
    #delete{
        color: red;
    }

</style>
<body>
<div class="container" id="container">
    <h1 style="">Коментарии</h1>
    <div class="mb-3">
        <label for="sort">Сортировать по:</label>
        <select id="sort" class="form-control" style="max-width: 300px;">
            <option value="id_asc" <?= $sort == 'id_asc' ? 'selected' : '' ?>>ID по возрастанию</option>
            <option value="id_desc" <?= $sort == 'id_desc' ? 'selected' : '' ?>>ID по убыванию</option>
            <option value="date_asc" <?= $sort == 'date_asc' ? 'selected' : '' ?>>Дата по возрастанию</option>
            <option value="date_desc" <?= $sort == 'date_desc' ? 'selected' : '' ?>>Дата по убыванию</option>
        </select>
    </div>
    <div class="comments-list">
        <?php if (!empty($comments) && is_array($comments)): ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment mb-3">
                    <a href="<?= site_url('/comments/show/'.$comment['id']) ?>"><h4><?= esc($comment['name']) ?></h4></a>
                    <p class="text"><?= esc($comment['text']) ?></p>
                    <small><?= esc($comment['date']) ?> id:<?php echo $comment['id'];?></small>
                    <div>
                        <a href="/comments/edit/<?= esc($comment['id']) ?>">Править</a>
                        <a href="/comments/delete/<?= esc($comment['id']) ?>" id="delete">Удалить</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Нет комментариев</p>
        <?php endif; ?>
    </div>
        <?= $pager->links() ?>

    <h2>Добавление коментария</h2>
    <?= form_open('comments/new') ?>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= old('email', $data['name'] ?? ''); ?>">
        </div>
        <div class="form-group">
            <label for="text">Текст:</label>
            <textarea class="form-control" name="text" id="text"><?= old('text', $data['text'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label>
            <input type="date" class="form-control" name="date" id="date" value="<?= old('date', $data['date'] ?? ''); ?>">
        </div>
        <?php if (session()->has('errors')){ ?>
            <ul>
                <?php foreach (session('errors') as $error){ ?>
                    <li><?= $error ?></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <button type="submit" class="btn btn-primary">Добавить</button>
    <?= form_close()?>
</div>
<script>
    $(document).ready(function(){
        $('form').on('submit', function(event){
            event.preventDefault();
            var formData = {
                email: $('#email').val(),
                text: $('#text').val(),
                date: $('#date').val()
            };

            $.post('/comments/new', formData, function(response){

                $("#container").html(response);

            });
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('body').on('click', 'a#delete', function(event){
            event.preventDefault();
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response){
                    $("#container").html(response);
                },
                error: function(xhr, status, error){
                    console.log("Ошибка удаления: " + error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#sort').on('change', function(){
            var sort = $(this).val();
            window.location.href = '<?= site_url('comments') ?>?sort=' + sort;
        });
    });
</script>
</body>
</html>
