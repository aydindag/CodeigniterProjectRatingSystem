<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Öğrenci | Kayıt Ol</title>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Hoşgeldiniz</b></a>
        </div>

        <?php if(validation_errors()) {
        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.validation_errors().'</div>';
        }
        ?>
        <div class="register-box-body">

            <p class="login-box-msg">Kayıt Olun</p>
            <form action="<?php echo base_url('yonetim/registerOgr'); ?>" method="post">

                <div class="form-group has-feedback">
                    <input name="adiSoyadi" type="text" value="<?php echo set_value('adiSoyadi'); ?>" class="form-control" placeholder="Full name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="email" type="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="kullaniciAdi" type="text" value="<?php echo set_value('kullaniciAdi'); ?>" class="form-control" placeholder="User name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="ogrNo" type="number" size="13" value="<?php echo set_value('ogrNo'); ?>" class="form-control" placeholder="Student Number">
                    <span class="glyphicon glyphicon-sort-by-order form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <select name="sube" class="form-control">
                        <option selected value="secilmedi" ><span>Şube Seçiniz</span></option>
                        <option value="1.Öğretim ing">1.Öğretim %100</option>
                        <option value="1.Öğretim">1.Öğretim</option>
                        <option value="2.Öğretim ing">2.Öğretim %100</option>
                        <option value="2.Öğretim">2.Öğretim</option>
                    </select>
                </div>
                <div class="form-group has-feedback">
                    <select name="danismanid" class="form-control">
                    <option selected value="secilmedi" ><span>Danışmanınızı girin</span></option>
                    <?php foreach($bilgi as $bilgi){ ?>                    
                    <option value="<?php echo $bilgi->hocaID ?>"><?php echo $bilgi->adiSoyadi ?></option>
                    <?php } ?>                
                  </select>
                </div>
                <div class="form-group has-feedback">
                    <input name="sifre" type="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <small>- Şifreniz en az 6 karakten oluşmalı.</small>
                    <br>
                    <small>- Şifrenizde en az bir harf bir rakam bulunmalı.</small>
                </div>
                <div class="form-group has-feedback">
                    <input name="sifre2" type="password" class="form-control" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>             
            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">

                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <a href="<?php echo base_url("yonetim/ogrenciindex") ?>" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

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
