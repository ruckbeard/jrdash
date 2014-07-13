<div clas="row">
    <div class="col-md-4" id="dashboard-side">
        <form id="create_todo" method="post" action="<?= base_url() ?>api/create_todo" _lpchecked="1">
            <div class="input-group">
                <input type="text" class="form-control" name="content">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Create">
                </span>
            </div><!-- /input-group -->
        </form>
        <div id="list_todo"></div>
    </div>
    <div class="col-md-8" id="dashboard-main">
        <form id="create_note" method="post" action="<?= base_url() ?>api/create_note">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Text input">
                <textarea class="form-control" placeholder="Text input"></textarea>
                <button type="submit" class="btn btn-default">Create</button>
            </div>
        </form>
    </div>
</div>

Dashboard