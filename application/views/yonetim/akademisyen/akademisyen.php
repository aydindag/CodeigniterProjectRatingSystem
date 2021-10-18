<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            Akademisyen Listesi - &#160;
        </h1>
        <a href="<?php echo base_url('yonetimPaneli/akademisyenEkle') ?>"><button style="width:auto;" type="button" class="btn btn-block btn-default btn-sm">Akademisyen Ekle</button></a>
        <?php echo $this->session->flashdata('ekleBasari'); ?>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Akademisyen</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <span style="float:left;" class="box-title">Akademisyen Listesi </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad Soyad</th>
                                    <th>Kullanici Adi</th>
                                    <th>E-Mail</th>
                                    <th>Ünvan</th>
                                    <th>Güncelle</th>
                                    <th>Sil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($bilgi as $bilgi){ ?>
                                <tr>
                                    <td>
                                        <?php echo $bilgi->ID ?>
                                    </td>
                                    <td>
                                        <?php echo $bilgi->adiSoyadi ?>
                                    </td>
                                    <td>
                                        <?php echo $bilgi->kullaniciAdi ?>
                                    </td>
                                    <td>
                                        <?php echo $bilgi->email ?>
                                    </td>
                                    <td>
                                        <?php echo $bilgi->unvan ?>
                                    </td>
                                    <td align="center">
                                        <a href="<?php echo base_url('yonetimPaneli/akademisyenGuncelle/'); echo ''.$bilgi->ID.'/'  ?>">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-fw fa-upload"></i></button>
                                        </a>
                                    </td>
                                    <td align="center">
                                        <a onclick="return confirmDel();" href="<?php echo base_url('yonetimPaneli/veriSil/');echo ''.$bilgi->ID.'/'.'akademisyen'  ?>">
                <button type="button" width="10px;" class="btn btn-danger" data-toggle="modal" >
                <i class="fa fa-fw fa-trash"></i>
                </button>
                </a>

                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Ad Soyad</th>
                                    <th>Kullanici Adi</th>
                                    <th>E-Mail</th>
                                    <th>Ünvan</th>
                                    <th>Güncelle</th>
                                    <th>Sil</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
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
<div class="modal modal-danger fade" id="modal-danger" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Uyarı!</h4>
            </div>
            <div class="modal-body">
                <p>Veri silinecek, Emin misiniz?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Kapat</button>
                <a href="<?php echo base_url('yonetimPaneli/veriSil/');echo ''.$bilgi->ID.'/'.'akademisyen'  ?>">
                <button type="button" width="10px;" class="btn btn-danger" data-toggle="modal" >
                <i class="fa fa-fw fa-trash"></i>
                </button>
                </a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script language="javascript">
    function confirmDel() {
        var agree = confirm("Bu içeriği silmek istediğinizden emin misiniz?");
        if (agree) {
            return true;
        } else {
            return false;
        }
    }

</script>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
