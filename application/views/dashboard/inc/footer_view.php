</div><!--end wrapper-->

<div id="footer">
    <div class="container">
        &copy; <?= date('Y') ?>
    </div>
</div>

<script src="<?= base_url() ?>public/js/jquery.js"></script>
<script src="<?= base_url() ?>public/js/bootstrap.js"></script>
<script src="<?= base_url() ?>public/js/jrdash/dashboard/result.js"></script>
<script src="<?= base_url() ?>public/js/jrdash/dashboard/event.js"></script>
<script src="<?= base_url() ?>public/js/jrdash/dashboard/template.js"></script>
<script src="<?= base_url() ?>public/js/jrdash/dashboard.js"></script>
<script>
    //Init the Dashboard Application
    var dashboard = new Dashboard();
    $(function() {
        $('body').popover({
            selector: '[data-toggle="popover"]',
            trigger: 'focus',
            html: true, 
            placement: 'top'
        });
    });
</script>
</body>
</html>