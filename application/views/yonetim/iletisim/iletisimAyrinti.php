<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Mesaj Ayrıntı &#160;</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Mesajlar</li>
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
                                <th>Gönderen</th>
                                <td><?php echo $info->adiSoyadi ?></td>

                            </tr>
                            <tr>
                                <th>E-Mail</th>
                                <td><?php echo $inf->email ?></td>

                            </tr>
                            <tr>
                                <th>Danışman</th>
                                <td><?php echo $inf->baslik ?></td>
                            </tr>
                            <tr>
                                <th>İçerik</th>
                                <td><?php echo $inf->icerik ?></td>
                            </tr>
                            <tr>
                                <th>İp Adres</th>
                                <td><?php echo $inf->ipAdress ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
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
