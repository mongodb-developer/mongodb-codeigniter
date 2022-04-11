<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="<?= '/books/edit/' . $book['_id'] ?>" method="post" autocomplete="off">
    <?= csrf_field() ?>

    <div class="form-floating mb-3">
        <input value="<?= $book['title'] ?>" class="form-control" type="text" name="title" placeholder="Title" required>
        <label for="title">Title</label>
    </div>

    <div class="form-floating mb-3">
        <input value="<?= $book['author'] ?>" class="form-control" type="text" name="author" placeholder="Author" required>
        <label for="author">Author</label>
    </div>

    <div class="form-floating mb-3">
        <input value="<?= $book['pagesRead'] ?>" class="form-control" type="number" name="pagesRead" value="0" required>
        <label for="pagesRead">Read Pages</label>
    </div>

    <button class="btn btn-primary" name="submit">Edit Book</button>
</form>
 