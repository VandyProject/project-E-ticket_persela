<html>
    <head>
        <title>Scan Tiket | Loket | E-Ticbat</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="theme-color" content="#d4000e">
        <meta name="msapplication-navbutton-color" content="#d4000e">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="#d4000e">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="icon" href="<?= base_url() ?>assets/admin/images/persibat.png" type="image/x-icon" sizes="32x32">
        <link href="<?= base_url() ?>assets/assets/css/bootstrap.css" rel="stylesheet" />
        <script src="<?= base_url() ?>assets/assets/js/jquery-1.10.2.js"></script>
        <script src="<?= base_url() ?>assets/assets/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="col-lg-3 col-md-3 hidden-sm col-xs-12"></div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <br/><h2>Scan Tiket Loket</h2><form class="form-horizontal" method="post" action="<?= site_url() ?>panpel/loket/cek">
                <input style="height: 50px" class="form-control" type="text" name="id" id="id" autofocus="" onchange="this.form.submit()">
            <noscript><input type="submit" name="submit" id="submit"></noscript>
        </form>
        <?php echo $this->session->flashdata('message'); ?>
        </div>
        <div class="col-lg-3 col-md-3 hidden-sm col-xs-12"></div>
    </body>
</html>