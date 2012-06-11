<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'follows-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'follower_id'); ?>
		<?php echo $form->textField($model,'follower_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'follower_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'following_id'); ?>
		<?php echo $form->textField($model,'following_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'following_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->