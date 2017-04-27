<?php
namespace app\widgets\topmenu;

use yii\base\Widget;

class TopmenuWidget extends Widget
{

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('topmenu');
    }
}