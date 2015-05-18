<?php
/* @var $this BooksController */
/* @var $data Books */
?>

<div class="view well">

    <a class="pull-left main-books" href="/books/view/<?= $data->id; ?>"><img  src="/upload/images/<?= $data->poster_path ?>"
                                                 alt=""/></a>

    <div class="pull-left">
        <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
        <?php echo CHtml::encode($data->title); ?>
        <br/>

        <b>Authors:</b>
        <? foreach ($data->booksAuthors as $val): ?>
            <p class="books-authors"><?= $val->author->first_name . ' ' . $val->author->last_name; ?></p>
        <? endforeach; ?>

        <b>Categories:</b>
        <? foreach ($data->booksCategories as $val): ?>
            <span class="label"><?= $val->category->title; ?></span>
        <? endforeach; ?>
    </div>
    <div class="clearfix"></div>
</div>
