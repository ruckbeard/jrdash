var Dashboard = function() {
    
    var self = this;
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Dashboard Created');
        template = new Template();
        event = new Event();
        result = new Result();
        load_todo();
    };

    //--------------------------------------------------------------------------

    var load_todo = function() {
        $.get('api/get_todo', function(o) {           
            var output = '';
            for (var i = 0; i < o.length; i++)
            {
                output += template.todo(o[i]);
            }
            
            $("#list_todo").html(output);
        }, 'json');
    };

    //--------------------------------------------------------------------------
    
    var load_note = function() {
        
    };

    //--------------------------------------------------------------------------


    this.__construct();
};