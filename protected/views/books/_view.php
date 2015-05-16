<?php
/* @var $this BooksController */
/* @var $data Books */
?>

<div class="view">

    <a href="/books/view/<?= $data->id; ?>"><img height="120" src="/upload/images/<?= $data->poster_path ?>" alt=""/></a>

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br/>

    <b>Authors:</b>
    <? foreach ($data->booksAuthors as $val): ?>
        <p><?= $val->author->first_name . ' ' . $val->author->last_name; ?></p>
    <? endforeach; ?>

    <b>Categories:</b>
    <? foreach ($data->booksCategories as $val): ?>
        <p><?= $val->category->title; ?></p>
    <? endforeach; ?>

</div>