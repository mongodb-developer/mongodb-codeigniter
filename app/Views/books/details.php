<h2><?= esc($book['title']) ?></h2>
<div class="mt-4">
    <p>Author: <?= esc($book['author']) ?></p>
    <p>Pages: <?= esc($book['pages']) ?></p>
    <p>Pages read: <?= esc($book['pagesRead']) ?></p>

    <p id="reading-progress">Your reading progress:</p>
    <div class="progress">
        <div
            class="progress-bar"
            role="progressbar"
            style="width: <?= $book['progress'] ?>%"
            aria-valuenow="<?= $book['progress'] ?>"
            aria-valuemin="0"
            aria-valuemax="100"
            aria-labelledby="reading-progress"
        ><?= $book['progress'] ?>%</div>
    </div>

    <a href=".." class="btn btn-link mt-3">Go back</a>
</div>