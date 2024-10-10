<!DOCTYPE html>
<html lang="en">


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Lupa Password E-Ticbat | Electronic Ticketing Persibat</title>

  <!-- Favicons-->
  <link rel="icon" href="<?= base_url() ?>assets/main/images/persibat.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="<?= base_url() ?>assets/admin/images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="<?= base_url() ?>assets/admin/images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="<?= base_url() ?>assets/admin/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?= base_url() ?>assets/admin/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?= base_url() ?>assets/admin/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="<?= base_url() ?>assets/admin/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="<?= base_url() ?>assets/admin/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="red darken-1">
  <!-- Start Page Loading -->
  <!-- <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div> -->
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
        <form class="login-form" method="POST" action="<?= site_url() ?>login/kirimreset">
        <div class="row">
          <div class="input-field col s12 center">
            <img src="<?= base_url() ?>assets/admin/images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login">
            <p class="center login-form-text">Lupa Password E-Ticbat</p>
          </div>
        </div>
            
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" type="email" name="email">
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
              <button type="submit" class="btn waves-effect red darken-1 col s12">Kirim</button>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m12 l6">
              <p class="margin right-align medium-small"><a href="<?= site_url() ?>login">Login E-Ticbat</a></p>
          </div>          
        </div>

      </form>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/materialize.js"></script>
  <!--prism-->
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="<?= base_url() ?>assets/admin/js/plugins.js"></script>

  <?php echo $this->session->flashdata('message'); ?>
  
</body>

</html>