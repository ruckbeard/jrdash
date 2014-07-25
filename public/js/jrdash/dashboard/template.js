var Template = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Template Created');
        /* To initialize BS3 tooltips set this below */
    };

    //--------------------------------------------------------------------------

    this.todo = function(obj) {
        var output = '';
        var completed = obj.completed > 0 ? 0 : 1;
        var completed_text = obj.completed > 0 ? " todo_completed" : "";
        var completed_icon = obj.completed > 0 ? " glyphicon-check" : " glyphicon-unchecked";
        var completed_tooltip = obj.completed > 0 ? "Uncomplete" : "Complete";
        output += '<td class="todo_text' + completed_text + '">' + obj.content + '</td>';
        output += '<td class="table_buttons"><a data-id="' + obj.todo_id + '" data-completed="' + completed + '" class="glyphicon' + completed_icon + ' btn btn-default btn-xs todo_update" href="api/update_todo" title="' + completed_tooltip + '"></a></td>';
        output += '<td class="table_buttons"><button class="glyphicon glyphicon-remove btn btn-danger btn-xs" data-toggle="popover" title="Are you sure you want to delete this?" data-content="<button type=\'button\' type=\'button\' data-id=\'' + obj.todo_id + '\' data-url=\'api/delete_todo\' id=\'todo_delete\' class=\'btn btn-danger btn-xs btn-block\'>Yes</button><button type=\'button\' class=\'btn btn-default btn-xs btn-block\'>Cancel</button>"></button></a></td>';
        return output;
    };

    //--------------------------------------------------------------------------

    this.note = function(obj) {
        var output = '';
        output += '<td><span id="note_title_' + obj.note_id + '" class="note_title"><a data-id="' + obj.note_id + '" class="note_content_toggle" href="#"><strong>' + obj.title + '</strong></a></span>';
        output += '<span class="note_content" id="note_content_' + obj.note_id + '">' + obj.content + '</span></td>';
        output += '<td class="table_buttons"><a data-url="api/get_note/' + obj.note_id + '" data-id="' + obj.note_id + '" class="glyphicon glyphicon-pencil btn btn-default btn-xs note_edit" href="#" data-toggle="modal" data-toggle="tooltip" data-target="#myModal" data-placement="bottom" title="Edit"></a></td>';
        output += '<td class="table_buttons"><button class="glyphicon glyphicon-remove btn btn-danger btn-xs" data-toggle="popover" title="Are you sure you want to delete this?" data-content="<button type=\'button\' type=\'button\' data-id=\'' + obj.note_id + '\' data-url=\'api/delete_note\' id=\'note_delete\' class=\'btn btn-danger btn-xs btn-block\'>Yes</button><button type=\'button\' class=\'btn btn-default btn-xs btn-block\'>Cancel</button>"></button></td>';
        return output;
    };


    //--------------------------------------------------------------------------

    this.__construct();
};