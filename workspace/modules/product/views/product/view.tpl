{assign var="url" value="{'/admin/product/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => $url])}
<div class="h1">{$model->name}</div>

<a href="/admin/virtualproductattr/create" class="btn btn-dark">Добавить атрибут</a>
{core\DetailView::widget()->setParams($model, $options)->run()}