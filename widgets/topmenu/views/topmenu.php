<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

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
                ['label' => 'Сотрудники', 'url' => ['/employee/'], 'visible' => \Yii::$app->user->can('employee_index') ],
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
                ['label' => 'Виды работ', 'url' => ['/worktypes/']],
                ['label' => 'Контроль доступа', 'url' => ['/rbac/'], 'visible' => \Yii::$app->user->can('employee_index')]
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