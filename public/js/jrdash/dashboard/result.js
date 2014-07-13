var Result = function() {
    //--------------------------------------------------------------------------

    this.__construct = function() {
        console.log('Result created');
    };

    //--------------------------------------------------------------------------

    this.success = function(msg) {
        $("#error").addClass('hide');
        var dom = $("#success");
        dom.show();
        if (typeof msg === 'undefined')
        {
            dom.removeClass("hide");
            dom.html('Success');
        }
        dom.removeClass("hide");
        dom.html(msg);

        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    };

    //--------------------------------------------------------------------------


    this.error = function(msg) {
        $("#success").addClass('hide');
        var dom = $("#error");
        if (typeof msg === 'undefined')
        {
            dom.removeClass("hide");
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
            dom.removeClass('hide');
            dom.html(output);
        } else {
            dom.removeClass("hide");
            dom.html(msg);
        }

        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    };

    //--------------------------------------------------------------------------



    this.__construct();
};