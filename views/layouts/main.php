<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Учёт рабочего времени',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/site/index']],
            ['label' => 'О приложении', 'url' => ['/site/about']],
            ['label' => 'Таблицы',  'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Сотрудники', 'url' => ['/employee/']],
                    ['label' => 'Коды работ', 'url' => ['/codeswork/']],
                    ['label' => 'Заказы', 'url' => ['/orders/']],
                    ['label' => 'Проекты', 'url' => ['/project/']],
                ]],
            ['label' => 'Создать', 'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Создать сотрудника', 'url' => ['/employee/create/']],
                    ['label' => 'Создать код работ', 'url' => ['/codeswork/create/']],
                    ['label' => 'Создать заказ', 'url' => ['/orders/create/']],
                    ['label' => 'Создать проект', 'url' => ['/project/create/']],
                ]
            ],
            ['label' => 'Справочники',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    ['label' => 'Категории по структуре отдела', 'url' => ['/departmentstructure/']],
                    ['label' => 'Сектора', 'url' => ['/sector/']],
                    ['label' => 'Категории по проектам', 'url' => ['/projectcategory/']],
                    ['label' => 'Виды работ', 'url' => ['/worktypes/']]
                ]
            ],
            Yii::$app->user->isGuest ? (
            ['label' => 'Войти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Выйти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Pluton <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
