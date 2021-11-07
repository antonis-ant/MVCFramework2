<?php
/** @var $model \app\models\User */
?>

<h1>Login</h1>
<?php $form = antonyanant\phpmvc\form\Form::begin('', "post") ?>
    <?php echo $form->inputField($model, 'email') ?>
    <?php echo $form->inputField($model, 'password')->passwordField() ?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php antonyanant\phpmvc\form\Form::end() ?>