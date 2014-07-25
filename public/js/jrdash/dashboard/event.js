var Event = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Event Created');
        template = new Template();
        result = new Result();
        create_todo();
        create_note();
        update_todo();
        update_note_display();
        update_note();
        delete_todo();
        delete_note();
        toggle_note_content();
    };

    //--------------------------------------------------------------------------

    var create_todo = function() {
        $("#create_todo").submit(function(evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Todo created successfuly.');
                    $("#todo_create_content").val('');
                    var output = template.todo(o.data);
                    $("#list_todo tbody").append(output);
                } else {
                    result.error(o.error);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------

    var create_note = function() {
        $("#create_note").submit(function(evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Note created successfuly.');
                    $("#note_create_title").val('');
                    $("#note_create_content").val('');
                    var output = template.note(o.data);
                    $("#list_note tbody").append(output);
                } else {
                    result.error(o.error);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------


    var update_todo = function() {
        $("body").on('click', '.todo_update', function(e) {
            e.preventDefault();

            var self = $(this);
            var url = self.attr('href');
            var todo_id = self.attr('data-id');
            var content = $("#todo_" + todo_id).text();
            var completed = self.attr('data-completed');
            var postData = {
                'todo_id': todo_id,
                'content': content,
                'completed': completed
            };

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Saved');
                    var output = template.todo(o.data);
                    $("#todo_" + todo_id).html(output);
                } else {
                    result.error('Nothing Updated');
                }
            }, 'json');
        });

    };

    //--------------------------------------------------------------------------

    var update_note_display = function() {
        $("body").on("click", ".note_edit", function(e) {
            e.preventDefault();

            var self = $(this);
            var id = self.data('id');
            var title = $("#note_title_" + id).text();
            var content = $("#note_content_" + id).text();
            $("#note_edit_title").val(title);
            $("#note_edit_content").val(content);
            $("#note_edit_id").val(id);
        });
    };

    //--------------------------------------------------------------------------

    var update_note = function() {

        $("#edit_note").submit(function(evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Note successfully edited');
                    var output = template.note(o.data);
                    $("#note_" + o.data.note_id).html(output);
                    $('#myModal').modal('toggle');
                } else {
                    result.error(o.error);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------

    var delete_todo = function() {
        $("body").on("click", "#todo_delete", function(e) {
            e.preventDefault();

            var self = $(this);
            var todo_id = self.data('id');
            var url = self.data('url');
            var postData = {
                'todo_id': todo_id
            };

            $.post(url, postData, function(o) {
                if (o.result === 1)
                {
                    result.success('Item Deleted.');
                    $("#todo_" + todo_id).remove();
                } else {
                    result.error(o.msg);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------

    var delete_note = function() {
        $("body").on("click", "#note_delete", function(e) {
            e.preventDefault();

            var self = $(this);
            var note_id = self.data('id');
            var url = self.data('url');
            var postData = {
                'note_id': note_id
            };

            $.post(url, postData, function(o) {
                if (o.result === 1)
                {
                    result.success('Item Deleted.');
                    $("#note_" + note_id).remove();
                } else {
                    result.error(o.msg);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------

    var toggle_note_content = function() {
        $("body").on("click", ".note_content_toggle", function(e) {
            e.preventDefault();

            var self = $(this);
            var note_id = self.attr('data-id');
            if ($("#note_content_" + note_id).is(":hidden")) {
                $("#note_content_" + note_id).slideDown("slow");
            } else {
                $("#note_content_" + note_id).slideUp("slow");
            }
        });
    };

    //--------------------------------------------------------------------------

    this.__construct();
};