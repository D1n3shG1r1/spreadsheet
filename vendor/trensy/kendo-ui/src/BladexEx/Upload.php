<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class Upload extends Base
{

    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.upload.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\Upload::deal('.$param.'); ?>';
    }

    /**
     * @param string $name
     * @param string $value
     * @param array $options
     */
    public static function deal($name='files[]',$initialFiles=[],$options=[])
    {
        $ui = new \Kendo\UI\Upload($name);
        if($initialFiles) $ui->files($initialFiles);
        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}