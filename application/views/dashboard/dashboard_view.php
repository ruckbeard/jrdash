
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Todo</h3>
    </div>
    <div class="panel-body">
        <form id="create_todo" method="post" action="<?= base_url() ?>api/create_todo" _lpchecked="1">
            <div class="input-group">
                <input id="todo_create_content" type="text" class="form-control" name="content" placeholder="Type your todo here.">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Create">
                </span>
            </div><!-- /input-group -->
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="list_todo">
                <tr><td><div id="todo_load" class="ajax_loader"></div></td></tr>
            </table>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Note</h3>
    </div>
    <div class="panel-body">
        <div id="panel panel-default simplePanel dashboard-main">
            <form id="create_note" method="post" action="<?= base_url() ?>api/create_note">
                <div class="form-group">
                    <input id="note_create_title" type="text" class="form-control" placeholder="Type your note title here." name="title">
                </div>
                <div class="form-group">
                    <textarea id="note_create_content" class="form-control note_text_content" placeholder="Type your note content here." name="content"></textarea>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-default">Create</button>
                </div>
        </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="list_note">
                <tr><td><div id="note_load" class="ajax_loader"></div></td></tr>
            </table>
        </div>
    </div>

</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Note</h4>
            </div>
            <div class="modal-body">
                <form id="edit_note" method="post" action="<?= base_url() ?>api/update_note">
                    <div class="form-group">
                        <input id="note_edit_title" type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <textarea id="note_edit_content" class="form-control note_text_content" name="content"></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-default">Edit</button>
                    </div>
                    <input id="note_edit_id" type="hidden" name="note_id">
                </form>
            </div>
        </div>
    </div>
</div>