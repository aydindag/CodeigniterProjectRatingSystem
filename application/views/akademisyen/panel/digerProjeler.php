<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h2 style="float:left;">
            <p>Projeler &#160;</p>
        </h2>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active"><a href="/Akademisyen/akademisyenPaneli/digerProjeler">Diğer Projeler</a></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if(validation_errors()) {
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.validation_errors().'</div>';
                }
                ?>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box box-primary">
                    <?php $kontrol = $this->session->userdata('info'); ?>
                    <div class="box-header with-border">
                        <?php if($proje){ ?>
                        <h3 class="box-title"><?php echo $proje[0]->adiSoyadi ?> </h3>
                        <?php } ?>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 10px">Kod</th>
                                <?php if($proje[0]->hocaID==$kontrol->hocaID){ ?>
                                <th>Not</th>
                                <?php } ?>
                                <th>Proje Adı</th>
                                <th>Ayrıntı</th>
                            </tr>
                            <?php if($proje){ ?>
                            <?php foreach ($proje as $proje){ ?>
                            <?php
                                $durumOgren = $this->db->query("SELECT durum FROM proje WHERE projeKodu='" . $proje->projeKodu . "'");
                                $durumSonucu = $durumOgren->row()->durum;
                            ?>
                            <?php if($kontrol->hocaID != $proje->hocaID){ ?>
                            <?php if($durumSonucu=="Evet"){ ?>
                            <tr>
                                <td><?php echo $proje->projeKodu ?></td>
                                <?php if($proje->hocaID==$kontrol->hocaID){ ?> <td>
                                    <?php
                                            echo $proje->puan;
                                            ?>
                                    </td>
                                    <?php } ?>
                                    <td><?php echo $proje->projeAdi ?></td>
                                    <td>
                                        <a href="<?php echo base_url('akademisyen/pproje/'); echo ''.$proje->projeKodu.'' ?>">
                                            <button type="button" class="btn   btn-default "><i class="fas fa-external-link-square-alt fa-2x"></i></button>
                                        </a>
                                    </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            <?php if($kontrol->hocaID == $proje->hocaID){ ?>
                            <tr>
                                <td><?php echo $proje->projeKodu ?></td>
                                <?php if($proje->hocaID==$kontrol->hocaID){ ?> <td>
                                    <?php
                                            echo $proje->puan;
                                            ?>
                                    </td>
                                    <?php } ?>
                                    <td><?php echo $proje->projeAdi ?></td>
                                    <td>
                                        <a href="<?php echo base_url('akademisyen/pproje/'); echo ''.$proje->projeKodu.'' ?>">
                                            <button type="button" class="btn   btn-default "><i class="fas fa-external-link-square-alt fa-2x"></i></button>
                                        </a>
                                    </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            <?php }else {
                            echo "<p>Gösterilecek Kayıt Bulunamadı</p>";
                            }
                        ?>
                        </tbody>
                    </table>
                    <!-- /.box-header -->
                    <!-- form start -->

                </div>


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
