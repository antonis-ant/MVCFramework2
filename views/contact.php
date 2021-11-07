<?php
/** @var  $this \antonyanant\phpmvc\View */
/** @var  $model \app\models\ContactForm */

$this->title = 'Contact';
?>

<h1>Contact us</h1>

<?php $form = \antonyanant\phpmvc\form\Form::begin('', 'post') ?>
    <?php echo $form->inputField($model, 'subject')?>
    <?php echo $form->inputField($model, 'email')?>
    <?php echo $form->textareaField($model, 'body')?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php $form->end() ?>