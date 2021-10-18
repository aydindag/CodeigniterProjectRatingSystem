<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="mesajBaslik">
            Ana Sayfa
            <small>Başlıca Görmeniz Gerekenler</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('Akademisyen/akademisyenPaneli') ?>"><i class="fa fa-dashboard"></i> Ana sayfa</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $tProje ?></h3>

                        <p>Eklenen Toplam Proje</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo base_url('Akademisyen/akademisyenPaneli/digerProjeler') ?>" class="small-box-footer">Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $bProje ?></h3>

                        <p>Size Ait Projeler</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo base_url('Akademisyen/akademisyenPaneli/panelProjeListesi') ?>" class="small-box-footer">Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $ogrencilerim ?></h3>

                        <p>Öğrenci Sayınız</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo base_url('akademisyen/ogrencilerim') ?>" class="small-box-footer">Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $notVerilmeyenProje; ?></h3>

                        <p>Not vermediğiniz Proje Sayisi</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo base_url('Akademisyen/akademisyenPaneli/digerProjeler') ?>" class="small-box-footer">Daha Fazla Bilgi <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>   
                    
           
        
        
        

        