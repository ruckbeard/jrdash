<div class="row">
    <div class=".col-md-6">
        <div id="login_form_error" class="alert alert-danger" role="alert"></div>
        <form id="login_form" class="form-horizontal" role="form" metho="post" action="<?= site_url('api/login') ?>">
            <div class="col-lg-2 text-right">
                
            </div>
            <div id="register_spacer" class="col-lg-10">
                <h3>Login</h3>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="pasw">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="rmbr"> Remember me
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Sign in</button>
                    <a class="btn btn-default" href="<?=site_url('home/register')?>" role="button">Register</a>
                </div>
            </div>
        </form>  
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $('#login_form_error').hide();
        $('#login_form').submit(function(event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();

            $.post(url, postData, function(o) {
                if (o.result === 1) {
                    window.location.href = '<?= site_url('dashboard') ?>';
                } else {
                    $("#login_form_error").show();
                    var output = '<ul>';
                    output += '<li>Your login information was incorrect.</li>';
                    output += '</ul>';
                    $("#login_form_error").html(output)
                }
            }, 'json');
        });
    });
</script>