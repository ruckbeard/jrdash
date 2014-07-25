var Dashboard = function() {

    var self = this;
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Dashboard Created');
        template = new Template();
        event = new Event();
        result = new Result();
        load_todo();
        load_note();
    };

    //--------------------------------------------------------------------------

    var load_todo = function() {
        $.get('api/get_todo', function(o) {
            var output = '';
            for (var i = 0; i < o.length; i++)
            {
                output += '<tr id="todo_' + o[i].todo_id + '">';
                output += template.todo(o[i]);
                output += '</tr>';
            }
            $("#list_todo").html(output);
        }, 'json');
    };

    //--------------------------------------------------------------------------

    var load_note = function() {
        $.get('api/get_note', function(o) {
            var output = '';
            for (var i = 0; i < o.length; i++)
            {
                output += '<tr id="note_' + o[i].note_id + '">';
                output += template.note(o[i]);
                output += '</tr>';
            }
            $("#list_note").html(output);
        }, 'json');
    };

    //--------------------------------------------------------------------------


    this.__construct();
};