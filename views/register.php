<h1>Register</h1>

<?php $form = app\core\form\Form::begin('', "post") ?>
    <!-- Firstname & lastname fields -->
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'firstname') ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'lastname') ?>
        </div>
    </div>

    <?php echo $form->field($model, 'email') ?>

    <!-- Password & confirm password fields -->
    <div class="row">
        <div class="col">
            <?php echo $form->field($model, 'password')->passwordField() ?>
        </div>
        <div class="col">
            <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php app\core\form\Form::end() ?>