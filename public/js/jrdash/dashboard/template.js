var Template = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Template Created');
    };

    //--------------------------------------------------------------------------

    this.todo = function(obj) {
        var output = '';
        if (obj.completed == 1) {
            output += '<tr class="todo_completed" id="todo_' + obj.todo_id + '">';
            output += '<td class="todo_text">' + obj.content + '</td>';
            output += '<td><a data-id="' + obj.todo_id + '" data-completed="0" class="glyphicon glyphicon-check btn btn-default btn-xs todo_update" href="api/update_todo"></a></td>';
        } else {
            output += '<tr id="todo_' + obj.todo_id + '">';
            output += '<td class="todo_text">' + obj.content + '</td>';
            output += '<td><a data-id="' + obj.todo_id + '" data-completed="1" class="glyphicon glyphicon-unchecked btn btn-default btn-xs todo_update" href="api/update_todo"></a></td>';
        }
        output += '<td><a data-id="' + obj.todo_id + '" class="glyphicon glyphicon-remove btn btn-default btn-xs todo_delete" href="api/delete_todo/"></a></td>';
        output += '</tr>';
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