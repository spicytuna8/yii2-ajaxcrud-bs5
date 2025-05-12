<?php

namespace spicytuna8\ajaxcrud;

class BootstrapHelper
{

    /**
     * @return string
     */
    public static function getBsVersion()
    {
        return substr(isset(\Yii::$app->params['bsVersion'])?\Yii::$app->params['bsVersion']:'4', 0, 1);
    }

}