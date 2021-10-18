<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1 style="float:left;">
            <p>Projeler &#160;</p>
        </h1>
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
                    <div class="box-header with-border">
                        <?php if($proje){ ?>
                            <h3 class="box-title"><?php echo $proje[0]->adiSoyadi ?></h3>
                        <?php }else {
                        }
                        ?>
                    </div>
                    <table class="table table-striped">
                        <tbody><tr>
                            <th style="width: 10px">Kod</th>
                            <th>Not</th>
                            <th >Proje Adı</th>
                            <th>Ayrıntı</th>
                        </tr>
                        <?php if($proje){ ?>
                            <?php foreach ($proje as $proje){ ?>
                                <tr>
                                    <td><?php echo $proje->projeKodu ?></td>
                                    <td>
                                        <?php
                                        echo $proje->puan;
                                        ?>
                                    </td>
                                    <td><?php echo $proje->projeAdi ?></td>
                                    <td>
                                        <a href="<?php echo base_url('yonetimPaneli/projeAyrinti/'); echo ''.$proje->projeKodu.'' ?>">
                                            <button type="button" class="btn   btn-default "><i class="fas fa-external-link-square-alt fa-2x"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else {
                            echo "<p>Gösterilecek Kayıt Bulunamadı</p>";
                        }
                        ?>
                        </tbody></table>
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
