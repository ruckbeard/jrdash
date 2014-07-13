var Template = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Template Created');
    };

    //--------------------------------------------------------------------------

    this.todo = function(obj) {
        var output = '';
        if (obj.completed == 1) {
            output += '<div class="todo_completed" id="todo_' + obj.todo_id + '">';
            output += '<span class="todo_text">' + obj.content + '</span>';
            output += '<a data-id="' + obj.todo_id + '" data-completed="0" class="glyphicon glyphicon-check btn btn-default todo_update" href="api/update_todo"></a>';
        } else {
            output += '<div id="todo_' + obj.todo_id + '">';
            output += '<span>' + obj.content + '</span>';
            output += '<a data-id="' + obj.todo_id + '" data-completed="1" class="glyphicon glyphicon-unchecked btn btn-default todo_update" href="api/update_todo"></a>';
        }
        output += '<a data-id="' + obj.todo_id + '" class="glyphicon glyphicon-remove btn btn-default todo_delete" href="api/delete_todo/"></a>';
        output += '</div>';
        return output;
    };

    //--------------------------------------------------------------------------

    this.note = function(obj) {
        var output = '';
        output += '<div id="note_' + obj.note_id + '">';
        output += '<span>' + obj.title + '</span>';
        output += '<span>' + obj.content + '</span>';
        output += '</div>';
        return output;
    };

    //--------------------------------------------------------------------------

    this.__construct();
};