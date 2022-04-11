<?php if (! empty($books) && is_array($books)): ?>

    <table class="table table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <a href="<?= '/books/' . $book['_id'] ?>">
                            <?= esc($book['title']) ?>
                        </a>
                    </td>
                    <td><?= esc($book['author']) ?></td>
                    <td><?= round(esc($book['pagesRead']) / esc($book['pages']) * 100, 2) ?>%</td>
                    <td>
                        <a class="btn btn-primary" href="<?= '/books/edit/' . $book['_id'] ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= '/books/delete/' . $book['_id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
    </table>

<?php else: ?>
    <h2>You don't have any books yet!</h3>
<?php endif ?>

<a href="books/create">
    <button class="btn btn-primary mt-4">Add a book</button>
</a>
