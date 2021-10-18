<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2 style="float:left;margin-bottom: 15px;">
            Projelerim &#160; - <a type="button" style="margin-bottom: 1px;margin-left:15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/home/notDokumu'); ?>">Excel Not Dökümü</a> <br>
        </h2>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Projelerim</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->session->flashdata('ekleBasari'); ?>
                <div class="box">
                    <div class="box-header">
                        <span style="float:left;" class="box-title"> </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Proje Adı</th>
                                        <th>Proje Kodu</th>
                                        <th>Not</th>
                                        <th>Verilen Not</th>
                                        <th>Proje Ayrıntı</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($bilgi){ ?>
                                    <?php foreach($bilgi as $bilgi){ ?>
                                    <tr>
                                        <td>
                                            <?php echo $bilgi->projeAdi ?>
                                        </td>
                                        <td>
                                            <?php echo $bilgi->projeKodu ?>
                                        </td>
                                        <td><?php
                                                if($bilgi->puan==null)
                                                    echo "Not Girilmemiş";
                                                else
                                                    echo $bilgi->puan;
                                                ?>
                                        </td>
                                        <td width="150px">
                                            <form role="form" method="post" action="<?php echo base_url('Akademisyen/akademisyenPaneli/panelnot/'); echo ''.$bilgi->projeKodu.'/1' ?>" enctype="multipart/form-data">
                                                <div class="input-group input-group">
                                                    <?php
                                                        $kontrol = $this->session->userdata('info');
                                                        $this->load->model('akdmodel');
                                                        $inf3 = $this->akdmodel->hocanınVerdigiPuan($bilgi->projeKodu,$kontrol->hocaID);
                                                        ?>
                                                    <input id="inputnot" name="not" value="<?php if(isset($inf3->notu)){ echo $inf3->notu;}?>" type="text" class="form-control">
                                                    <span class="input-group-btn">
                                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                                        <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-sign-in-alt"></i></button>
                                                    </span>
                                                </div>
                                            </form>
                                        </td>
                                        <td align="center">
                                            <a href="<?php echo base_url('akademisyen/pproje/'); echo ''.$bilgi->projeKodu.'' ?>">
                                                <button type="button" class="btn   btn-default "><i class="fas fa-external-link-square-alt fa-2x"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php }else{
                                    echo "<td>Gösterilecek Kayıt Bulunamadı</td>";
                                }?>
                                </tbody>
                            </table>
                        </div>
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
                <a onclick="return confirmDel();" href="<?php echo base_url('yonetimPaneli/veriSil/');echo ''.$bilgi->ID.'/'.'ogrenci'  ?>">
                    <button type="button" width="10px;" class="btn btn-danger" data-toggle="modal">
                        Sil
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
<script>
    $('#example1').DataTable({
        responsive: true
    });

</script>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
