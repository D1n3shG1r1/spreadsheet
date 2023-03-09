<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class AutoCompleteLocal extends Base
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
            '/static/lib/kendo-ui/js/kendo.popup.min.js',
            '/static/lib/kendo-ui/js/kendo.list.min.js',
            '/static/lib/kendo-ui/js/kendo.fx.min.js',
            '/static/lib/kendo-ui/js/kendo.userevents.min.js',
            '/static/lib/kendo-ui/js/kendo.draganddrop.min.js',
            '/static/lib/kendo-ui/js/kendo.mobile.scroller.min.js',
            '/static/lib/kendo-ui/js/kendo.virtuallist.min.js',
            '/static/lib/kendo-ui/js/kendo.autocomplete.min.js'
        ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\AutoCompleteLocal::deal('.$param.'); ?>';
    }

    public static function deal($data, $name='autoComplete',$value='',$options=[])
    {
        $dataSource = new \Kendo\Data\DataSource();
        $dataSource->data($data);

        $ui = new \Kendo\UI\AutoComplete($name);
        $ui->dataSource($dataSource)->value($value);
        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}