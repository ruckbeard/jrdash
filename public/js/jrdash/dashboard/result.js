var Result = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Result created');
    };

    //--------------------------------------------------------------------------

    this.success = function(msg) {
        var dom = $("#success");
        dom.show();
        if (typeof msg === 'undefined')
        {
            dom.html('Success');
        }
        dom.html(msg);

        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    };

    //--------------------------------------------------------------------------


    this.error = function(msg) {
        var dom = $("#error");
        dom.show();
        if (typeof msg === 'undefined')
        {
            dom.html('Error');
        }
        if (typeof msg === 'object')
        {
            var output = '<ul>';
            for (var key in msg)
            {
                output += '<li>' + msg[key] + '</li>';
            }
            ;
            output += '</ul>';
            dom.html(output);
        } else {
            dom.html(msg);
        }

        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    };

    //--------------------------------------------------------------------------



    this.__construct();
};