<?php
/** @var $model \app\models\User */
?>

<h1>Register</h1>

<?php $form = tonyanant\phpmvc\form\Form::begin('', "post") ?>
    <!-- Firstname & lastname fields -->
    <div class="row">
        <div class="col">
            <?php echo $form->inputField($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->inputField($model, 'lastname') ?>
        </div>
    </div>

    <?php echo $form->inputField($model, 'email') ?>

    <!-- Password & confirm password fields -->
    <div class="row">
        <div class="col">
            <?php echo $form->inputField($model, 'password')->passwordField() ?>
        </div>
        <div class="col">
            <?php echo $form->inputField($model, 'confirmPassword')->passwordField() ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php tonyanant\phpmvc\form\Form::end() ?>