{core\App::$breadcrumbs->addItem(['text' => 'Добавить атрибут'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/admin/attribute/create">
        <div class="form-group">
            <label for="firstname">Название:</label>
            <input type="text" name="name" id="name" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Сохранить">
        </div>
    </form>
</div>