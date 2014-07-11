<div class="row">
    <div class=".col-md-6">
        <div id="register_form_error" class="alert alert-danger" role="alert"></div>
        <form id="register_form" class="form-horizontal" role="form" metho="post" action="<?= site_url('api/register') ?>">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputUsername3" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputUsername3" placeholder="Username" name="uname">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pasw">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPasswordConfirm3" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPasswordConfirm3" placeholder="Confirm Password" name="paswc">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Register</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="<?=site_url('/')?>" role="button">Back</a>
                </div>
            </div>
        </form>  
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#register_form_error').hide();
        
        $('#register_form').submit(function(event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    window.location.href = '<?= site_url('dashboard') ?>';
                } else {
                    $("#register_form_error").show();
                    var output = '<ul>';
                    for (var key in o.error) 
                    {
                        var value = o.error[key];
                        output += '<li>' + value + '</li>';
                    }
                    output += '</ul>';
                    $("#register_form_error").html(output);
                }
            }, 'json');
        });
    });
</script>