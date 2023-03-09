<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class DropDownTreeRemote extends Base
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
        return $str.'<?php \Trensy\KendoUI\BladexEx\DropDownTreeRemote::deal('.$param.'); ?>';
    }

    /**
     *
     * @param $url
     * @param string $name
     * @param array $options
     * @param string $type
     * @param null $parameterMap
     */
    public static function deal($url, $name='ddt',$value="", $idField='id',$hasChildrenField='hasChildren',$options=[],$type="POST", $parameterMap=null)
    {
        $transport = new \Kendo\Data\DataSourceTransport();
        $read = new \Kendo\Data\DataSourceTransportRead();

        $read->url($url)->contentType('application/json')->type($type);

        if(!$parameterMap){
            $parameterMap = "function (data){ var idata = kendo.stringify(data); return idata;}";
        }
        $transport->read($read)->parameterMap($parameterMap);

        $model = new \Kendo\Data\HierarchicalDataSourceSchemaModel();
        $model->id($idField)
            ->hasChildren($hasChildrenField);

        $schema = new \Kendo\Data\HierarchicalDataSourceSchema();
        $schema->model($model);

        $dataSource = new \Kendo\Data\HierarchicalDataSource();
        $dataSource->transport($transport)
            ->schema($schema);

        $ui = new \Kendo\UI\DropDownTree($name);
        $ui->dataSource($dataSource)->value($value);
        $ui->ignoreCase(false);
        $ui->filter('contains');
        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}