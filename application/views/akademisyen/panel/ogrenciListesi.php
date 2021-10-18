<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2 style="float:left;margin-bottom:15px">
            Öğrenci Listesi  &#160; - <a type="button" style="margin-bottom: 1px;margin-left:15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/home/notDokumu'); ?>">Excel Not Dökümü</a> <br>
        </h2>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Öğrenci</li>
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
                            <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Proje Kodu</th>
                    <th>Proje Adı</th>
                    <th>Numara</th>
                    <th>İsim</th>
                    <th>Not</th>
                </tr>
                <?php if($info){ ?>
                <?php foreach ($info as $info){ ?>
                <tr>
                    <td><?php echo $info->projeKodu ?></td>
                    <td>
                        
                        <a href="<?php echo base_url('akademisyen/pproje/'); echo ''.$info->projeKodu.'' ?>"><?php echo $info->projeAdi; ?></a>
                        <?php if($info->projeAdi==""){ ?>
                        <?php echo "Öğrencinin Projesi Yok"; } ?>
                          
                    </td>
                    <td><?php echo $info->ogrNo; ?></td>
                    <td><a href="<?php echo base_url('akademisyen/ogrenci/profil/').''.$info->ogrNo.'' ?>" style="color:black"><?php echo $info->adiSoyadi ?></a></td>
                    <td><?php echo $info->puan; ?></td>
                </tr>
                <?php } ?>
                <?php }else{
                    echo "<tr><td>Gösterilecek Kayıt Bulunamadı.<td></tr>";
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
                    <button type="button" width="10px;" class="btn btn-danger" data-toggle="modal" >
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
    $('#example1').DataTable( {
        responsive: true
    } );
</script>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
