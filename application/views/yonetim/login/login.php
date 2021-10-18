<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Giriş Yap</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>plugins/iCheck/square/blue.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        @media screen and (max-height: 575px) {

            #rc-imageselect,
            .g-recaptcha {
                transform: scale(0.77);
                -webkit-transform: scale(0.77);
                transform-origin: 0 0;
                -webkit-transform-origin: 0 0;
            }
        }

    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="margin-top:-22px;">
        <div class="login-logo">
            <a href="<?php echo base_url("login") ?>"><b>Senior Project</b> Sistemi</a>            
        </div>
        <!-- /.login-logo -->
        <?php echo $this->session->flashdata('emailGonderildi'); ?>
        <?php echo $this->session->flashdata('ekleBasari'); ?>
        <div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Dikkat!</h4>
            Sifrenizi öğrenmek için şifremi unuttum kısmına girip (ogrno@ogrenci.karabuk.edu.tr) yazarak şifrenizi öğrenebilirsiniz.
            Şifre emailinizde spama düşebilir ordan kontrol ediniz. Eğer gönderilmediyse danışmanınza başvurunuz.
        </div>
        <?php echo $this->session->flashdata('hata'); ?>
        <?php if(validation_errors()) {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.validation_errors().'</div>';
    }
    ?>
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#settings" data-toggle="tab">Akademisyen</a></li>
                <li><a href="#pp" data-toggle="tab">Öğrenci</a></li>
                <li><a href="#proje" data-toggle="tab">Proje Arama</a></li>
            </ul>
            <!-- flash message here -->
            <div class="tab-content">
                <!-- Akademisyen Login -->
                <div class="active tab-pane" class="tab-pane" id="settings">
                    <div class="login-box-body">
                        <p class="login-box-msg">Bilgilerinizi Giriniz</p>
                        <form action="<?php echo base_url("yonetim/login"); ?>" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="kadi" class="form-control" placeholder="Sicil No">
                                <input type="hidden" value="akd" name="kim">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="sifre" class="form-control" placeholder="Şifre">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <div style="margin-top:5px;" class="g-recaptcha" data-sitekey="6Le7iAAVAAAAAF_iUVJoWJUZLapETuAOO3YRc1XR"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        </label>

                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Giriş Yap</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                        <a href="<?php echo base_url("sifremiUnuttum") ?>">Şifremi Unuttum</a><br>
                        <a href="<?php echo base_url("yonetim/iletisim") ?>">İletişim</a>
                    </div>
                </div>
                <div class="tab-pane" class="tab-pane" id="pp">
                    <!-- Öğrenci Login -->
                    <div class="login-box-body">
                        <p class="login-box-msg">Bilgilerinizi Giriniz</p>
                       <p>
                        <br>
                        <form action="<?php echo base_url("Yonetim/login") ?>" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="kadi" class="form-control" placeholder="Öğrenci No">
                                <input type="hidden" value="ogr" name="kim">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="sifre" class="form-control" placeholder="Şifre">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <div style="margin-top:5px;" class="g-recaptcha" data-sitekey="6Le7iAAVAAAAAF_iUVJoWJUZLapETuAOO3YRc1XR"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        </label>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Giriş Yap</button>
                                </div>

                            </div>
                        </form>
                        <a href="<?php echo base_url("sifremiUnuttum") ?>">Şifremi Unuttum</a><br>
                        <a href="<?php echo base_url("yonetim/iletisim") ?>">İletişim</a>
                    </div>
                </div>

                <!-- /.tab-pane -->
                <div class="tab-pane" id="proje">
                    <!-- Proje Arama -->
                    <div class="login-box-body">
                        <p class="login-box-msg">Bilgilerinizi Giriniz</p>
                        <p>
                        </p>
                        <form action="<?php echo base_url("Yonetim/projeAra") ?>" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="ogrNo" class="form-control" placeholder="Öğrenci Numarası">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <div style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;" class="g-recaptcha" data-sitekey="6Le7iAAVAAAAAF_iUVJoWJUZLapETuAOO3YRc1XR"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        </label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Giriş Yap</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <?php
        $url = prep_url('linkedin.com/in/fikriulas');        
        $url2 = prep_url('https://www.linkedin.com/in/ayd%C4%B1n-da%C4%9F-649a04118/');

        ?>
        <div style="margin:0px;padding: 5px;" class="text-center">            
            <p><b>Developed</b> By <a href="<?php echo $url2; ?>">Aydın DAĞ<small style="font-size:10px;"> 2020</small></a> - <a href="<?php echo $url; ?>">Fikri Ulas<small style="font-size:10px;"> 2019</small></a> </p>
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/AdminPanel/'); ?>plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

    </script>

</body>

</html>
