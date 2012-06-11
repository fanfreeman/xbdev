<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'notifications-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'notification_id'); ?>
		<?php echo $form->textField($model,'notification_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'notification_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resource_id'); ?>
		<?php echo $form->textField($model,'resource_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'resource_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resource_type'); ?>
		<?php echo $form->textField($model,'resource_type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'resource_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_read'); ?>
		<?php echo $form->textField($model,'is_read'); ?>
		<?php echo $form->error($model,'is_read'); ?>
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