<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Proje Ara</title>
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
        @media screen and (max-height: 575px){
            #rc-imageselect, .g-recaptcha {transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;}
        }
    </style>
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <?php echo $this->session->flashdata('ekleBasari'); ?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <a type="button" href="<?php echo base_url('yonetim') ?>" class="btn btn-block btn-default">Giriş Ekranı</a>
        <hr>
        <?php if($proje){ ?>
        <table class="table table-condensed table-striped table-hover">
            <tbody>
            <tr>
                <th>Proje Kodu</th>
                <td><?php echo $proje->projeKodu ?></td>
            </tr>
            <tr>
                <th>Proje Adı</th>
                <td><?php echo $proje->projeAdi; ?></td>
            </tr>
            <tr>
                <th>Danışman</th>
                <?php if($hoca){ ?>
                <td><?php echo $hoca->adiSoyadi; ?></td>
                <?php }else{
                    echo "Danışman eklenmemiş";
                } ?>
            </tr>
            </tbody>
        </table>
        <hr>
        <table class="table table-condensed table-striped table-hover">
            <tbody>
            <?php foreach ($ogrenci as $ogrenci){ ?>
            <tr>
                <th>Öğrenci Adı</th>
                <td><?php echo $ogrenci->adiSoyadi; ?></td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
        <?php }else{
            echo "Sisteme Ekli Projeniz Bulunmamaktadır.";
        } ?>




        <a href="<?php echo base_url("yonetim/iletisim") ?>">İletişim</a><br>
    </div>
    <!-- /.login-box-body -->
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
