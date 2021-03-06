<?php echo CHtml::errorSummary($model); ?>
<?php

Yii::import('zii.widgets.grid.CDataColumn');

class ModelColumn extends CDataColumn
{
    public function renderDataCellContent($row, $data)
    {
        return parent::renderDataCellContent($row, $data);
    }
}

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'ajaxUpdate' => false,
    'filter' => $model,
    'columns' => [
        ['name' => 'id', 'value' => '$data->id'],
        ['name' => 'brand_id', 'value' => '$data->brand_id', 'filter' => $helper->getAvailableBrands()],
        ['header' => 'Country', 'value' => '$data->brand->country'],
        ['name' => 'model', 'value' => '$data->model', 'filter' => $helper->getAvailableModels(), 'class' => 'ModelColumn'],
        ['name' => 'maxSpeed', 'value' => '$data->maxSpeed'],
        [
            'header' => 'Is fast',
            'value' => function ($data) {
                return $data->maxSpeed > 250 ? 'yes' : '';
            },
        ],
        [
            'class' => 'CButtonColumn',
            'template' => '{update}',
            'buttons' => [
                'update' => [
                    'url' => 'Yii::app()->createUrl("car/edit", array("id" => $data->id))',
                    'options' => ['title' => "Update car"]
                ],
            ],
        ],
    ]
)); ?>
<?php
$js = <<<"HEREDOC"
$(function () {
    $('table.items tbody tr td:nth-child(2)').each(function (k, v) {
        var selected = $(v).html();
        var html$ = $('select[name="Car[brand_id]"]')
            .clone()
            .attr('name', '')
            .attr('class', 'gridEdit')
            ;
        html$.find('option[value="'+selected+'"]').attr('selected', true);
        $(v).html(html$);
    });
});
HEREDOC;
Yii::app()->clientScript->registerScript('edit', $js, CClientScript::POS_END);
?>