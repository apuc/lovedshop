{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/category/create">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required="required"/>
            <label for="firstname">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required="required"/>
            <label for="firstname">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required="required"/>
            <label for="firstname">Status:</label>
            <input type="text" name="status" id="status" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>