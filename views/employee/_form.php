<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sector;
use app\models\AuthItem;
use app\models\DepartmentStructure;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
        'enableClientValidation'=>false
    ]); ?>
    <?php
        if(!empty($model->errors))
            var_dump($model->errors);
    ?>
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="row">
            <div class="col-lg-4">
                <!-- Original image -->
                <?= $form->field($model, 'photo')->fileInput(['accept' => 'image/*']) ?>
            </div>
            <div class="col-lg-4">
                <?=Html::img($model->getThumbUploadUrl('photo', 'preview'), ['class' => 'img-thumbnail']) ?>
            </div>
            <div class="col-lg-4">
                <!-- Thumb 2 (preview profile) -->
                <?= $form->field($model,'photo_del')->checkBox(['class'=>'span-1']); ?>

            </div>
        </div>
    </div>

    <?= $form->field($model, 'sector_id')->dropDownList($items_sector,$params_sector);?>

    <?=$form->field($model, 'department_id')->dropDownList($items_department,$params_department);?>

    <?php
    $roles = AuthItem::find()->where('type = 1')->all();
    $items = ArrayHelper::map($roles, 'name', 'name');
    $params = [
        'prompt' => 'Выберите роль...'
    ];
    ?>
    <?= $form->field($model, 'role')->dropDownList($items,$params);?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'new_pass')->textInput(['maxlength' => true]);?>

    <?= $form->field($model, 'status')->checkbox([
        'label' => 'Сотрудник работает?',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Обновить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
