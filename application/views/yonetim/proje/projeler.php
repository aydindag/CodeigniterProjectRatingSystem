<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div>

        </div>
        <h1 style="float:left;">
            <p>Diğer Projeler &#160;</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Diğer Projeler</li>
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
                        <h3 class="box-title"></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <table class="table table-striped">
                        <tbody><tr>
                            <th >Kodu</th>
                            <th>Akademisyen Adı</th>
                            <th>Projeleri</th>
                        </tr>
                        <?php foreach ($info as $info){ ?>
                            <tr>
                                <td><?php echo $info->hocaID ?></td>
                                <td><?php echo $info->adiSoyadi ?></td>
                                <td>
                                    <a href="<?php echo base_url('yonetimPaneli/akademisyenProjeleri/'); echo ''.$info->hocaID.'' ?>">
                                        <button type="button" class="btn   btn-default "><i class="fas fa-external-link-square-alt fa-2x"></i></button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody></table>
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
