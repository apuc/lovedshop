<div class="h1">{$h1}</div>

<a href="/admin/category/create" class="btn btn-dark">Create</a>
<a href="/admin/category/download" class="btn btn-dark">Загрузить из 1с</a>
{core\GridView::widget()->setParams($model, $options)->run()}
{*{core\Pagination::widget()->setParams(5)->run()}*}
