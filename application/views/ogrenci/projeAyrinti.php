<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Proje &nbsp; Ayrıntı &#160;- <a class="btn btn-default btn-sm" type="button" href="<?php echo base_url('Ogrenci/home/projeGuncelle'); ?>">Proje Güncelle</a></p>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
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
                        <table class="table table-condensed">
                            <tbody>
                                <tr>
                                    <?php $info=$this->session->userdata('info'); ?>
                                    <th>Ogrenci Adı</th>
                                    <td><?php echo $info->adiSoyadi ?></td>

                                </tr>
                                <tr>
                                    <th>Proje Adı</th>
                                    <td><?php echo $inf->projeAdi ?></td>

                                </tr>
                                <tr>
                                    <th>Proje Adı(ing)</th>
                                    <td><?php echo $inf->projeName ?></td>
                                </tr>
                                <tr>
                                    <th>Puan</th>
                                    <td>
                                        <?php
                                    if ($inf->projeYayinla)
                                        echo $inf->puan;
                                    else
                                        echo "Not Girişi Yapılmadı."
                                    ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Proje Açıklaması</th>
                                    <td><?php echo $inf->projeAciklama ?></td>
                                </tr>
                                <tr>
                                    <th>Proje Açıklaması(ing)</th>
                                    <td><?php echo $inf->projeDetail ?></td>
                                </tr>
                                <tr>
                                    <th>Afiş</th>
                                    <td><a style="color:black" href="<?php echo base_url('Ogrenci/Home/projeAfisindir') ?>"><i class="far fa-file-image fa-2x"></i><span> İndir</span></a></td>
                                </tr>
                                <tr>
                                    <th>Dosya</th>
                                    <td><a style="color:black" href="<?php echo base_url('Ogrenci/Home/projeDosyaindir') ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                                </tr>
                                <tr>
                                    <th>Danışman</th>
                                    <td><?php echo $inf->adiSoyadi ?></td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if($inf->videoURL != ""){ ?>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Video</h3>
                    </div>
                    <div class="box-body">
                        <?php echo $inf->videoURL ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <?php } ?>
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
<script>
    var z = document.getElementById('iframeID');
    function myFunction(x) {
        if (x.matches) { // If media query matches
            z.style.height = "200px";
            z.style.width = "250px";
        } else {
            z.style.height = "400px";
            z.style.width = "600px";
        }
    }
    var x = window.matchMedia("(max-width: 700px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes
</script>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
