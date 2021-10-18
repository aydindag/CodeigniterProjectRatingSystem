<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div>
            <br>
        </div>
        <h1 style="float:left;">
            <p>Proje &nbsp; Ayrıntı</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Proje Ayrıntı</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->session->flashdata('ekleBasari'); ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Proje Ayrıntı</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body no-padding">
                        <form method="post" role="form" action="<?php echo base_url('Akademisyen/akademisyenPaneli/panelnot/'); echo ''.$info->projeKodu.'/0' ?>">
                            <table class="table table-condensed">
                                <tbody>
                                <tr>
                                    <th>Proje Adı</th>
                                    <td>
                                        <?php echo $info->projeAdi; ?>
                                    </td>

                                </tr>
                                <tr>
                                    <th>Puan</th>
                                    <td>
                                        <?php
                                        if($info->puan=="")
                                            echo "Not girişi <b>yapılmamış</b>";
                                        else
                                            echo $info->puan;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Proje Açıklaması</th>
                                    <td>
                                        <?php echo $info->projeAciklama ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Afiş</th>
                                    <td><a style="color:black" href="<?php echo base_url('yonetimPaneli/projeAfisindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-image fa-2x"></i><span> İndir</span></a></td>
                                </tr>
                                <tr>
                                    <th>Dosya</th>
                                    <td><a style="color:black" href="<?php echo base_url('yonetimPaneli/projeDosyaindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                                </tr>
                                <tr>
                                    <th>Danışman</th>

                                    <td>
                                        <?php echo $info->adiSoyadi ?>
                                    </td>
                                </tr>

                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Öğrenciler</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive p-2">
                        <table class="table table-hover">
                            <tbody>

                            <tr>
                                <th>İsim</th>
                                <th>Not</th>
                                <th>Numara</th>

                            </tr>
                            <?php if($inf){ ?>
                                <?php foreach ($inf as $inf) { ?>
                                    <tr>
                                        <td><?php echo $inf->adiSoyadi ?></td>
                                        <td><?php echo $inf->puan ?></td>
                                        <td><?php echo $inf->ogrNo ?></td>

                                    </tr>
                                <?php } ?>
                            <?php }else{
                                echo "Projeye Dahil Olan Bir Öğrenci Yok";
                            }?>
                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- Default box -->

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Akademisyen</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                <i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                                <i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body table-responsive p-2">
                        <table class="table table-hover">
                            <tbody>

                            <tr>
                                <th>isim</th>
                                <th>Not</th>
                                <th>Kod</th>

                            </tr>
                            <?php if($inf2) { ?>
                                <?php foreach ($inf2 as $inf2) { ?>
                                    <tr>
                                        <td><?php echo $inf2->adiSoyadi ?></td>
                                        <td><?php echo $inf2->notu ?></td>
                                        <td><?php echo $inf2->hocaID ?></td>

                                    </tr>
                                <?php } ?>
                            <?php }else{ ?>
                                <tr><td>Note has not been entered.</td></tr>
                            <?php } ?>

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');

</script>

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
