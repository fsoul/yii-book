<?php
/* @var $this BooksController */
/* @var $model Books */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'books-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'Poster:'); ?>
        <?php echo $form->fileField($model, 'poster_path', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'poster_path'); ?>
    </div>

    <br>
    <div class="row h">
        <?php echo $form->labelEx($model, 'Authors:'); ?>
        <?php echo $form->checkBoxList($model, 'authors', $model->authors); ?>
    </div>

    <div class="row h">
        <?php echo $form->labelEx($model, 'Categories:'); ?>
        <?php echo $form->checkBoxList($model, 'cat_title', $model->cat_title); ?>
    </div>
    <br>
    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-primary')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->