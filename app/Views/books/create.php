<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/books/create" method="post">
    <?= csrf_field() ?>

    <div class="mt-3">
        <label class="form-label" for="title">Title</label>
        <input class="form-control" type="input" name="title" />
    </div>

    <div class="mt-3">
        <label class="form-label" for="author">Author</label>
        <input class="form-control" type="input" name="author" />
    </div>

    <div class="mt-3">
        <label class="form-label" for="pages">Pages</label>
        <input class="form-control" type="number" name="pages" />
    </div>

    <input class="btn btn-success mt-4" type="submit" name="submit" value="Add Book" />
</form>
