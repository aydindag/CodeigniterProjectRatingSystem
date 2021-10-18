<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="mesajBaslik">
            Mesaj Oku
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana sayfa</a></li>
            <li class="active">Mesaj Oku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url('Mesaj/mesajPaneli/mesajGonderindex') ?>" class="btn btn-primary btn-block margin-bottom">Mesaj Gönder</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Posta</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="<?php echo base_url('Mesaj/mesajPaneli/gelenKutusu') ?>"><i class="fa fa-inbox"></i> Gelen Kutusu
                                    <span class="label label-primary pull-right"><?php 
                            $kontrol = $this->session->userdata('info');       
                                        $result = $this->db->select('*')
                                             ->from('mesaj')
                                             ->where('gelenID',$kontrol->ID)  
                                             ->where('okundu',"false")
                                             ->get()
                                             ->result();                                          
                            echo count($result);
                            ?></span></a></li>
                            <li><a href="<?php echo base_url('Mesaj/mesajPaneli/mesajGonderindex') ?>"><i class="fa fa-envelope-o"></i> Gönder</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
            <div id="yazdir" class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mesaj Oku</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h3><?php echo $inf->baslik ?></h3>
                            <?php if($kontrol->yetki!=1){ ?>
                            <h5>Gönderen: <b><?php echo $inf2->adiSoyadi ?></b>
                                <span class="mailbox-read-time pull-right"><?php echo $inf->tarih ?></span>
                            </h5>
                            <?php } ?>
                            <?php if($kontrol->yetki==1){ ?>
                            <h5>Gönderen: 
                                <b><a href="<?php echo base_url('akademisyen/ogrenci/profil/').''.$inf2->ogrNo.'' ?>" style="color:blue"><?php echo $inf2->adiSoyadi ?></a>
                                    <span class="mailbox-read-time pull-right"><?php echo $inf->tarih ?></span></b>
                            </h5>
                            <h5>Ögr No: <b><?php echo $inf2->ogrNo ?></b>
                            </h5>
                            <h5>Proje Kodu: <b><?php echo $inf2->projeKodu ?></b>
                            </h5>
                            <h5>Danışman ID: <b><?php echo $inf2->hocaID ?></b>
                            </h5>
                            <?php } ?>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                            <!-- /.btn-group -->
                            <a href="javascript:window.print()" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                <i class="fa fa-print"></i></a>
                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <?php echo $inf->icerik ?>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <a href="<?php echo base_url('Mesaj/mesajPaneli/mesajCevapla/'); echo ''.$inf->ID.'/' ?>" type="button" class="btn btn-default"><i class="fa fa-reply"></i> Cevapla</a>

                        </div>
                        <a href="<?php echo base_url('Mesaj/mesajPaneli/mesajSil/'); echo ''.$inf->ID.'/' ?>" type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Sil</a>
                        <a href="javascript:window.print()" type="button" class="btn btn-default"><i class="fa fa-print"></i> Yazdır</a>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>



<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
