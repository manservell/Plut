<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sector;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentStructure */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="department-structure-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'structure_category')->textInput(['maxlength' => true]) ?>

     <?php
    $sectors = Sector::find()->all();
    // формируем массив, с ключем равным полю 'id' и значением равным полю 'name'
    $items = ArrayHelper::map($sectors,'id','sector');
    $params = [
        'prompt' => 'Выберите сектор...'
    ];
    echo $form->field($model, 'structure_category')->dropDownList($items,$params);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
