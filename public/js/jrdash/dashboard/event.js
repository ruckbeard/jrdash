var Event = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Event Created');
        template = new Template();
        result = new Result();
        create_todo();
        create_note();
        update_todo();
        update_note();
        delete_todo();
        delete_note();
    };

    //--------------------------------------------------------------------------

    var create_todo = function() {
        $("#create_todo").submit(function(evt) {
            evt.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('test');
                    var output = template.todo(o.data[0]);
                    $("#list_todo").append(output);
                } else {
                    result.error(o.error);
                }
            }, 'json');
        });
    };

    //--------------------------------------------------------------------------

    var create_note = function() {
        $("#create_note").submit(function(evt) {
            console.log('create_note clicked');
            return false;
        });
    };

    //--------------------------------------------------------------------------


    var update_todo = function() {
        $("body").on('click', '.todo_update', function(e) {
            e.preventDefault();

            var self = $(this);
            var url = self.attr('href');
            var todo_id = self.attr('data-id');
            var completed = self.attr('data-completed');
            var postData = {
                'todo_id': todo_id,
                'completed': completed
            };

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    result.success('Saved');
                    if (completed == 1) {
                        $("#todo_" + todo_id).addClass('todo_completed');
                        self.removeClass('glyphicon-unchecked');
                        self.addClass('glyphicon-check');
                        self.attr('data-completed', 0);
                    } else {
                        $("#todo_" + todo_id).removeClass('todo_completed');
                        self.removeClass('glyphicon-check');
                        self.addClass('glyphicon-unchecked');
                        self.attr('data-completed', 1);
                    }
                } else {
                    result.error('Nothing Updated');
                }
            }, 'json');
        });

    };

    //--------------------------------------------------------------------------

    var update_note = function() {

    };

    //--------------------------------------------------------------------------

    var delete_todo = function() {
        $("body").on("click", ".todo_delete", function(e) {
            e.preventDefault();

            var self = $(this);
            var todo_id = self.attr('data-id');
            var url = $(this).attr('href');
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

    };

    //--------------------------------------------------------------------------

    this.__construct();
};