<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Sector;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'empl')->textInput()->hint('Введите Фамилию') ?>
<?= $form->field($model, 'empl')->textInput()->hint('Введите имя') ?>
<?= $form->field($model, 'empl')->textInput()->hint('Введите отчество') ?>

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
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>





<div class="department-structure-form">



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


</div>
