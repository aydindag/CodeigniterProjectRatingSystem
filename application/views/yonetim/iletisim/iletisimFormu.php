<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>İletişim Formu</title>
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
    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
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
    <?php echo $this->session->flashdata('ekleBasari'); ?>
    <div class="register-box-body">

        <p class="login-box-msg">Lütfen Bilgileri Eksiksiz Doldurun</p>
        <form action="<?php echo base_url('yonetim/iletisim'); ?>" method="post">

            <div class="form-group has-feedback">
                <input name="adiSoyadi" type="text" value="<?php echo set_value('adiSoyadi'); ?>" class="form-control" placeholder="İsim">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="email" type="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="telefon" type="text" value="<?php echo set_value('telefon'); ?>" class="form-control" placeholder="Telefon">
                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                <small id="emailHelp" class="form-text text-muted ml-2">Örn: Başına sıfır(0) koymadan giriniz.</small>
            </div>
            <div class="form-group has-feedback">
                <input name="baslik" type="text" value="<?php echo set_value('baslik'); ?>" class="form-control" placeholder="Başlık">
                <span class="glyphicon glyphicon-home form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <textarea  placeholder="proje Açıklaması" name="icerik" id="editor1" rows="10" cols="80">
                            </textarea>
            </div>
            <div class="form-group has-feedback">
                <div style="margin-bottom:0px;margin-left:9px;" class="g-recaptcha" data-sitekey="6LevZPsUAAAAAHXWzlJ3ue6b3ETig4NV-vjmXINq"></div>
            </div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <div class="row">
                <div class="col-xs-8">

                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Gönder</button>
                </div>
                <!-- /.col -->
            </div>


        </form>

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

<script src="http://w8tcha.github.io/CKEditor-WordCount-Plugin/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    //<![CDATA[

    // Replace the <textarea id="editor"> with an CKEditor
    // instance, using the "WordCount" plugin.
    CKEDITOR.replace( 'editor1',{
        extraPlugins : 'wordcount',
        wordcount : {
            showCharCount : true,
            showWordCount : true,

            // Maximum allowed Word Count
            maxWordCount: 255,

            // Maximum allowed Char Count
            maxCharCount: 255,
        }
    } );

    //]]>
</script>


</body>

</html>
