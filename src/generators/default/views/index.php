<?php

use spicytuna8\ajaxcrud\BootstrapHelper;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

$iconsEngine = (int)BootstrapHelper::getBsVersion() > 4 ? 'fas fa-' : 'glyphicon glyphicon-';

echo "<?php\n";
?>
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap5\Modal;
use kartik\grid\GridView;
use spicytuna8\ajaxcrud\CrudAsset;
use spicytuna8\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
    <div id="ajaxCrudDatatable">
        <?="<?="?>GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="<?= $iconsEngine ?>plus"></i>New', ['create'],
                    ['role'=>'modal-remote','title'=> 'Create new <?= Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>','class'=>'btn btn-success']).
                    Html::a('<i class="<?= $iconsEngine ?>repeat me-0"></i>', [''], ['data-pjax'=>1, 'class'=>'btn btn-outline-secondary', 'title'=>'Reset Grid']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],
            'bordered' => false,   
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'responsiveWrap' => false,
            'panelHeadingTemplate' => "{title}",
            'panel' => [
                'type' => '', // 'primary'
                'heading' => Html::tag('h3', '<i class="<?= $iconsEngine ?>bookmark"></i> <?= Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>', ['class' => 'float-start m-0']).
                    Html::tag('div', '{summary}', ['class' => 'float-end']),                
                //'before' => '<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="<?= $iconsEngine ?>trash"></i>&nbsp; Delete All',
                                ["bulkdelete"] ,
                                [
                                    "class"=>"btn btn-sm btn-danger",
                                    'role'=>'modal-remote-bulk',
                                    'data-confirm'=>false,
                                    'data-method'=>false,// for overide yii data api
                                    'data-request-method'=>'post',
                                    'data-confirm-title'=>'Are you sure?',
                                    'data-confirm-message'=>'Are you sure want to delete this item'
                                ]),
                        ]).
                        Html::tag('span', '{summary}', ['class' => 'float-end']).
                        '<div class="clearfix"></div>',
            ]
        ])<?="?>\n"?>
    </div>
</div>

<?="<?php "?>
Modal::begin([
   "options" => [
        "id"=>"ajaxCrudModal",
        "tabindex" => false, // important for Select2 to work properly
        'class' => 'modal modal-blur fade show', // Add the 'fade' class for transition effects
        'aria-modal' => true,
        'role' => 'dialog',        
    ],
   "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])
<?="?><?php"?> Modal::end();<?="?>"?>