<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div>
            <br>
        </div>
        <h2 style="float:left;">
            <p>Proje &nbsp; Ayrıntı</p>
        </h2>
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
                        <h3 class="box-title">Proje Ayrıntı </h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body no-padding">
                        <?php $kontrol = $this->session->userdata('info'); ?>
                        <form method="post" role="form" action="<?php echo base_url('Akademisyen/akademisyenPaneli/panelnot/'); echo ''.$info->projeKodu.'/0' ?>">
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <th>Proje Kodu</th>
                                        <td>
                                            <?php echo $info->projeKodu; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Proje Adı</th>
                                        <td>
                                            <?php echo $info->projeAdi; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Proje Adı(ing)</th>
                                        <td>
                                            <?php echo $info->projeName; ?>
                                        </td>
                                    </tr>
                                    <?php if($info->hocaID==$kontrol->hocaID){ ?>
                                    <tr>
                                        <th>Puan</th>
                                        <td>
                                            <?php echo $info->puan; ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                    <tr>
                                        <th>Proje Açıklaması</th>
                                        <td>
                                            <?php echo $info->projeAciklama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Proje Açıklaması(ing)</th>
                                        <td>
                                            <?php echo $info->projeDetail ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Afiş</th>
                                        <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeAfisindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-image fa-2x"></i><span> İndir</span></a></td>
                                    </tr>
                                    <tr>
                                        <th>Dosya</th>
                                        <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeDosyaindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                                    </tr>
                                    <tr>
                                        <th>Danışman</th>

                                        <td>
                                            <?php echo $info->adiSoyadi ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Puan Girin</th>
                                        <?php
                                    $kontrol = $this->session->userdata('info');
                                    $this->load->model('akdmodel');
                                    $inf3 = $this->akdmodel->hocanınVerdigiPuan($info->projeKodu,$kontrol->hocaID);
                                    ?>
                                        <td><input type="text" name="not" class="form-control" id="exampleInputPassword1" value="<?php if(isset($inf3->notu)){ echo $inf3->notu;}?>"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button style="float:right;margin-right:15px;margin-bottom:15px;margin-top:10px;" type="submit" class="btn btn-default btn-sm">Not Ver</button>
                        </form>
                    </div>
                </div>
                <?php if($info->videoURL != ""){ ?>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Video</h3>
                    </div>
                    <div class="box-body">
                        <?php echo $info->videoURL ?>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <?php } ?>
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
                                    <?php if($info->hocaID==$kontrol->hocaID){ ?>
                                    <th>Not</th>
                                    <?php } ?>
                                    <th>Numara</th>

                                </tr>
                                <?php if($inf){ ?>
                                <?php foreach ($inf as $inf) { ?>
                                <tr>
                                    <td><a href="<?php echo base_url('akademisyen/ogrenci/profil/').''.$inf->ogrNo.'' ?>" style="color:black"><?php echo $inf->adiSoyadi ?></a></td>
                                    <?php if($info->hocaID==$kontrol->hocaID){ ?>
                                    <td><?php echo $inf->puan ?></td>
                                    <?php } ?>
                                    <td><?php echo $inf->ogrNo ?></td>

                                </tr>
                                <?php } ?>
                                <?php }else{
                                echo "Projeye Dahil Olan Bir Öğrenci Yok";
                            }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- Default box -->
                <?php
                $kontrol = $this->session->userdata('info');
                $hocaID = $kontrol->hocaID;
                if($info->hocaID==$hocaID){
                    ?>
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
                                <tr>
                                    <td>Note has not been entered.</td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <?php } ?>
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
