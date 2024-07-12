
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Коментарии</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="container">
<div class="comments-list">
    <h1>Изменение коментария</h1>
    <?= form_open('comments/update/'.$comment['id']) ?>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" id="email" value="<?= old('email', $comment['name'] ?? ''); ?>">
    </div>
    <div class="form-group">
        <label for="text">Текст:</label>
        <textarea class="form-control" name="text" id="text"><?= old('text', $comment['text'] ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label for="date">Дата:</label>
        <input type="date" class="form-control" name="date" id="date" value="<?= old('date', $comment['date'] ?? ''); ?>">
    </div>
    <?php if (session()->has('errors')){ ?>
        <ul>
            <?php foreach (session('errors') as $error){ ?>
                <li><?= $error ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <?= form_close()?>
</div>
</div>
</body>
