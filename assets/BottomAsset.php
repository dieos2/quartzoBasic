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
class BottomAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $jsOptions = [
    'position' => \yii\web\View::POS_END
    ];
    public $css = [
        
	'js/select2/select2-bootstrap.css',
	'js/select2/select2.css',
	'js/selectboxit/jquery.selectBoxIt.css',
	'js/daterangepicker/daterangepicker-bs3.css',
	'js/icheck/skins/minimal/_all.css',
	'js/icheck/skins/square/_all.css',
	'js/icheck/skins/flat/_all.css',
	'js/icheck/skins/futurico/futurico.css',
	'js/icheck/skins/polaris/polaris.css',
        'js/jvectormap/jquery-jvectormap-1.2.2.css',
	'js/rickshaw/rickshaw.min.css'
    ];
    public $js = [

        'js/gsap/main-gsap.js',
        'js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js',
        'js/bootstrap.js',
         'js/joinable.js',
        'js/resizeable.js',
         'js/neon-api.js',
        
         'js/jquery.dataTables.min.js',
        'js/datatables/TableTools.min.js',
        'js/dataTables.bootstrap.js',
        'js/datatables/jquery.dataTables.columnFilter.js',
        'js/datatables/lodash.min.js',
       
        'js/select2/select2.min.js',
        'js/bootstrap-tagsinput.min.js',
        'js/typeahead.min.js',
        'js/selectboxit/jquery.selectBoxIt.min.js',
        'js/bootstrap-datepicker.js',
        'js/bootstrap-timepicker.min.js',
        'js/bootstrap-colorpicker.min.js',
        'js/daterangepicker/moment.min.js',
        'js/daterangepicker/daterangepicker.js',
        'js/jquery.multi-select.js',
        'js/icheck/icheck.min.js',
        
       
       
        'js/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'js/jvectormap/jquery-jvectormap-europe-merc-en.js',
        'js/jquery.sparkline.min.js',
        'js/rickshaw/vendor/d3.v3.js',
        'js/rickshaw/rickshaw.min.js',
        'js/raphael-min.js',
        'js/morris.min.js',
        'js/toastr.js',
        'js/neon-chat.js',
        'js/neon-custom.js',
        'js/neon-demo.js'
       
    ];

    
   

}
