
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Коментарии</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<style>
    .comment{
        position: relative;
        padding: 5px 10px;
        border: 1px solid #c7c7c7;
        border-radius: 10px;
    }
</style>
<div class="container">
    <div class="comments-list">
        <h1>Коментарий</h1>
                <div class="comment mb-3">
                    <h4><?= esc($comment['name']) ?></h4>
                    <p><?= esc($comment['text']) ?></p>
                    <small><?= esc($comment['date']) ?> id: <?= esc($comment['id']) ?></small>
                </div>
    </div>
</div>
</body>