<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HeadAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = [
    'position' => \yii\web\View::POS_HEAD
    ];

    public $css = [
    'js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css',
    'css/font-icons/entypo/css/entypo.css',
    'http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic',
    'css/bootstrap.css',
    'css/neon-core.css',
    'css/neon-theme.css',
    'css/neon-forms.css',
    'css/custom.css',
    ];

    public $js = [
    'js/jquery-1.11.0.min.js'
    ];
}
