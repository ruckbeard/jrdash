
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Todo</h3>
    </div>
    <div class="panel-body">
        <form id="create_todo" method="post" action="<?= base_url() ?>api/create_todo" _lpchecked="1">
            <div class="input-group">
                <input type="text" class="form-control" name="content">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Create">
                </span>
            </div><!-- /input-group -->
        </form>
        <div class="table-responsive"><table class="table table-striped table-hover" id="list_todo"></table></div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Note</h3>
    </div>
    <div class="panel-body">
        <div id="panel panel-default simplePanel dashboard-main">
            <form id="create_note" method="post" action="<?= base_url() ?>api/create_note">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Text input">
                    <textarea class="form-control" placeholder="Text input"></textarea>
                    <button type="submit" class="btn btn-default">Create</button>
                </div>
            </form>
        </div>

    </div>
</div>
