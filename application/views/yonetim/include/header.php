<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bitirme Projesi Puanlama Sistemi</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/Ionicons/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/select2/dist/css/select2.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice
        {
            background-color: #3c8dbc;
            border-color: #367fa9;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .not {
            visibility: hidden;
        }

        @media print {
            body * {
                visibility: hidden;
            }
            #yazdir * {
                visibility: visible;
            }
            #yazdir {
                position: absolute;
                top: 0px;
                left: 0px;
                width: 1000px;
                height: 1000px;
            }
        }

        .break {
            page-break-before: always;
        }

        /* //// */

        body {
            margin: 0;
            background-color: #f1f1f1;
            font-family: calibri, serif;
        }

        #alertMesaj {
            position: absolute;
            right: 1em;
            margin-top: 15px;
            min-width: 150px;
            font-size: 100%;
            letter-spacing: 1px;
            padding: 0.35em 1em;
            color: #fff;
            border-radius: 30px;
            box-shadow: 0 1px 10px -3px #004e75, 0 1px 5px -3px #004e75;
            animation: panaog 600ms linear;
            z-index: 999;
        }

        .alert-info {
            border: 0.5px solid #00a0f1;
            background-color: #0af;
        }


        /*--------------------------------------------------------------
# Animations
--------------------------------------------------------------*/

        @-webkit-keyframes panaog {
            0% {
                opacity: 0;
                transform: translateY(-100%);
            }
            100% {
                opacity: 1;
                transform: translateY(0%);
            }
        }

        @-moz-keyframes panaog {
            0% {
                opacity: 0;
                transform: translateY(-100%);
            }
            100% {
                opacity: 1;
                transform: translateY(0%);
            }
        }

        @keyframes panaog {
            0% {
                opacity: 0;
                transform: translateY(-100%);
            }
            100% {
                opacity: 1;
                transform: translateY(0%);
            }
        }
        #duyuruTablosu {
            width: 100%;
        }
        #duyuruTablosu th{
            width: 10%;
        }
        #duyuruTablosu td{
            width: 90%;
        }

    </style>

</head>

<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url('') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Ana Sayfa</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-success"><?php
                                $kontrol = $this->session->userdata('info');
                                $result = $this->db->select('*')
                                    ->from('mesaj')
                                    ->where('gelenID',$kontrol->ID)
                                    ->where('okundu',"false")
                                    ->get()
                                    ->result();
                                echo count($result);
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                <?php
                                $kontrol = $this->session->userdata('info');
                                $result = $this->db->select('*')
                                    ->from('mesaj')
                                    ->where('gelenID',$kontrol->ID)
                                    ->where('okundu',"false")
                                    ->get()
                                    ->result();
                                echo count($result);
                                ?> Tane Mesajınız Var</li>
                            <li>
                                <?php
                                $kontrol = $this->session->userdata('info');
                                $result = $this->db->select('*')
                                    ->from('mesaj')
                                    ->where('gelenID',$kontrol->ID)
                                    ->get()
                                    ->result();
                                ?>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php foreach($result as $result){
                                        if($kontrol->yetki==1){
                                            $ogr = $this->db->select('adiSoyadi')
                                                ->from('ogrenci')
                                                ->where('ID',$result->gidenID)
                                                ->get()
                                                ->row();
                                        }
                                        elseif($kontrol->yetki==2)
                                        {
                                            $akd = $this->db->select('adiSoyadi')
                                                ->from('akademisyen')
                                                ->where('ID',$result->gidenID)
                                                ->get()
                                                ->row();
                                        }
                                        ?>
                                        <?php if(!$result->okundu){ ?>
                                            <li>
                                                <!-- start message -->
                                                <a href="<?php echo base_url('mesaj/'); echo ''.$result->ID.'/' ?>">
                                                    <h4 style="margin-left:-5px">
                                                        <?php
                                                        if($kontrol->yetki==1){
                                                            echo $ogr->adiSoyadi;
                                                        }
                                                        elseif($kontrol->yetki==2){
                                                            echo $akd->adiSoyadi;
                                                        }
                                                        ?>
                                                        <small><i class="fa fa-clock-o"></i>
                                                            <?php $tarih= $result->tarih;
                                                            $newdate = date("d-m-Y", strtotime($tarih));
                                                            echo $newdate;
                                                            ?>
                                                        </small>
                                                    </h4>
                                                    <p style="margin-left:-5px">
                                                        <?php echo $result->baslik ?>
                                                    </p>
                                                </a>
                                            </li>
                                        <?php } } ?>
                                    <!-- end message -->
                                </ul>
                            </li>
                            <li class="footer"><a href="<?php echo base_url('mesaj/gelenKutusu') ?>">Tüm Mesajları Gör</a></li>
                        </ul>
                    </li>
                    <!-- Notifications: style can be found in dropdown.less -->
                    <?php
                    $kontrol = $this->session->userdata('info');
                    if($kontrol->yetki==2):?>
                        <?php
                        $duyuru = $this->db->select('ID,duyuruBaslik,tarih')
                            ->from('duyurular')
                            ->get()
                            ->result();
                        $duyuruSayısı = count($duyuru);
                        ?>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"><?php echo $duyuruSayısı; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $duyuruSayısı." Tane Duyuru Var"; ?></li>
                                <?php foreach ($duyuru as $duyuru){ ?>
                                    <li>
                                        <ul class="menu">
                                            <li>
                                                <a href="<?php echo base_url('duyuru/'); echo ''.$duyuru->ID.'' ?>">
                                                    <i class="fa fa-warning text-yellow"></i><?php echo $duyuru->duyuruBaslik; ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <li class="footer"><a href=""></a></li>
                            </ul>
                        </li>
                    <?php endif ?>

                    <?php $info=$this->session->userdata('info'); ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo base_url('assets\upload\profile/').$info->profilFoto ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                  <?php echo $info->adiSoyadi ?>
              </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <p>
                                    <?php echo $info->adiSoyadi ?>
                                    <?php
                                    $kontrol = $this->session->userdata('info');
                                    if($kontrol->yetki==1)
                                        $tabloAdi = "akademisyen";
                                    else if($kontrol->yetki==2)
                                        $tabloAdi = "ogrenci";
                                    else if($kontrol->yetki==0)
                                        $tabloAdi = "yonetim";
                                    $result = $this->db->select('create_at')
                                        ->from($tabloAdi)
                                        ->where('ID',$kontrol->ID)
                                        ->get()
                                        ->row();
                                    $newdate = date("d-m-Y", strtotime($result->create_at));
                                    ?>
                                    <small><?php echo $newdate; ?>'den beri üye</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-2 text-center">

                                    </div>
                                    <div class="col-xs-8 text-center">
                                        <a href="<?php echo base_url('yonetim/iletisim')?>">Yöneticiye Mesaj Gönder</a>
                                    </div>
                                    <div class="col-xs-2 text-center">

                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo base_url('Profil/profilPaneli/index') ?>" class="btn btn-default btn-flat">Profil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo base_url('yonetim/cikis') ?>" class="btn btn-default btn-flat">Çıkış</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button kaldırıldı. -->                    
                </ul>
            </div>
        </nav>
    </header>