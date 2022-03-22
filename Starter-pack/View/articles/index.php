<?php require 'View/includes/header.php'?>

<?php // Use any data loaded in the controller here ?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li><?= $article->title ?> (<?= /*$article->formatPublishDate()*/ "date goes here"?>)</li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>