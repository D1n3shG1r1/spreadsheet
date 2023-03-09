<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class DropDownTreeLocal extends Base
{
    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.data.min.js',
            '/static/lib/kendo-ui/js/kendo.treeview.min.js',
            '/static/lib/kendo-ui/js/kendo.popup.min.js',
            '/static/lib/kendo-ui/js/kendo.dropdowntree.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\DropDownTreeLocal::deal('.$param.'); ?>';
    }


    public static function deal($data, $name='ddt',$value=null,$options=[])
    {
        $dataSource = new \Kendo\Data\DataSource();
        $dataSource->data($data);

        $ui = new \Kendo\UI\DropDownTree($name);
        $ui->dataSource($dataSource);
        $ui->filter('startswith');

        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}