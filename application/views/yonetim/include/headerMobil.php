<!doctype html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bitirme Projesi Puanlama Sistemi</title>
        <!-- toggle -->
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
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

            @media (min-width: 600px) {
                #secContent {

                    padding: 35px 75px 35px 75px;
                }
            }

            @media (max-width: 600px) {
                #projeKodu {
                    width: 5%;
                }

                #projenot {
                    width: 90%;
                }

                #projeAdi {
                    width: 5%;
                }

                #inputnot {
                    width: 55px;
                }
            }            

        </style>

    </head>
</head>

<body>
    <section id="secContent" class="content">
        <div>
            <p>Hoşgeldiniz,
                <?php $kontrol = $this->session->userdata('info');
                    echo $kontrol->adiSoyadi;
                ?>
                <?php
                $kontrol = $this->session->userdata('info');
                $result = $this->db->select('*')
                    ->from('mesaj')
                    ->where('gelenID',$kontrol->ID)
                    ->where('okundu',"false")
                    ->get()
                    ->result();
                ?>
            </p>
            <?php if(count($result)!=0){ ?>
            <p style="margin-top:-20px;"><a href="<?php echo base_url('mesaj/gelenKutusu') ?>"><small><?php echo count($result);?> Adet Okunmamış Mesajınız Var</small></a></p>
            <?php } ?>
        </div>
        <!-- Dropdown Menu
        <div class="btn-group" style="margin-bottom: 15px">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menü
            </button>
            <div class="dropdown-menu">
                <a type="button" class="dropdown-item" href="<?php echo base_url('Akademisyen/home'); ?>">Ana Sayfa</a>
                <a type="button" class="dropdown-item" href="<?php echo base_url('Akademisyen/home/projelerim'); ?>">Öğrencilerim</a>
                <a type="button" class="dropdown-item" href="<?php echo base_url('akademisyen/projeler/'); echo ''.$kontrol->hocaID.'' ?>">Projelerim</a>
                <a type="button" class="dropdown-item" href="<?php echo base_url('Akademisyen/home/projeEkle'); ?>">Proje Ekle</a>
            </div>
        </div>
        -->
        <a type="button" style="margin-bottom: 15px;" class="btn btn-primary" href="<?php echo base_url('Akademisyen/home'); ?>">Akademisyen Projeleri</a>
        <a type="button" style="margin-bottom: 15px;" class="btn btn-primary" href="<?php echo base_url('Akademisyen/home/degerlendirme'); ?>">Toplu Değerlendirme</a>
        <a type="button" style="margin-bottom: 15px;" class="btn btn-primary" href="<?php echo base_url('akademisyen/projeler/'); echo ''.$kontrol->hocaID.'' ?>">Projelerim</a>    
        <a type="button" style="margin-bottom: 15px;" class="btn btn-primary" href="<?php echo base_url('Akademisyen/home/projelerim'); ?>">Öğrencilerim</a> 
        <a type="button" style="margin-bottom: 15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/akademisyenPaneli'); ?>">Panel</a>
        <a type="button" style="float:right;margin-bottom: 15px;" class="btn btn-danger" href="<?php echo base_url('yonetim/cikis'); ?>">Çıkış Yap</a>
