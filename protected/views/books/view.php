<?php
/* @var $this BooksController */
/* @var $model Books */

$this->breadcrumbs = array(
    'Books' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Books', 'url' => array('index')),
    array('label' => 'Create Books', 'url' => array('create')),
    array('label' => 'Update Books', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Books', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

    <img class="pull-left book-view-img main-books" src="/upload/images/<?= $model->poster_path; ?>"/>

    <div class="pull-left ">
        <h1><?= $model->title; ?></h1>
        <? foreach ($model->booksAuthors as $val): ?>
        <p><?= $val->author->first_name . ' ' . $val->author->last_name; ?></p>
        <? endforeach; ?>
        <? foreach ($model->booksCategories as $val): ?>
        <p class="label"><?= $val->category->title; ?></p>
        <? endforeach; ?>
    </div>