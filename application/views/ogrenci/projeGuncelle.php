<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Proje &nbsp; Güncelle</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Proje Güncelle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->session->flashdata('ekleBasari'); ?>
                <div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Dikkat!</h4>
                    Dosya yüklerken onay yazısını görene kadar sayfayı kapatmayınız.
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Proje</a></li>
                        <li><a data-toggle="tab" href="#menu1">Afiş Ve Dosya</a></li>
                        <li><a data-toggle="tab" href="#menu2">Video</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <form method="post" role="form" action="<?php echo base_url('Ogrenci/home/projeGuncelleButton'); ?>" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">proje Adı</label>
                                        <input name="projeAdi" required type="text" class="form-control" value="<?php echo $inf->projeAdi ?>" id="exampleInputEmail1" placeholder="proje Adı">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">proje Adı(ing)</label>
                                        <input name="projeAdiing" required type="text" class="form-control" value="<?php echo $inf->projeName ?>" id="exampleInputEmail1" placeholder="proje Adı">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">proje Açıklaması</label>
                                        <textarea placeholder="proje Açıklaması" name="projeAciklama" id="editor1" rows="10" cols="80">
                                    		<?php echo $inf->projeAciklama ?>
                                	</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">proje Açıklaması(ing)</label>
                                        <textarea placeholder="proje Açıklaması" name="projeAciklamaing" id="editor2" rows="10" cols="80">
                                            <?php echo $inf->projeDetail ?>
                                         </textarea>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                            <label for="exampleInputEmail1">Afiş</label>
                                            <?php if($inf->afis!=""){ ?>
                                            <a style="color:black;margin-left:5px;" href="<?php echo base_url('Ogrenci/Home/projeAfisindir') ?>"> <i class="fas fa-download"></i>indir</a>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                            <label for="exampleInputEmail1">Dosya</label>
                                            <?php if($inf->dosya!=""){ ?>
                                            <a style="color:black" href="<?php echo base_url('Ogrenci/Home/projeDosyaindir') ?>"><i class="fas fa-download"></i> İndir</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Proje Kodu</label>
                                        <input name="projeKodu" required type="text" readonly value="<?php echo $inf->projeKodu ?>" class="form-control" id="exampleInputEmail1" placeholder="Proje Kodu">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Danışman</label>
                                        <input name="hocaID" required type="text" readonly class="form-control" id="exampleInputEmail1" value="<?php echo $inf->adiSoyadi ?>">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    </div>
                                    <div class="form-group">

                                        <label for="exampleInputEmail1">Proje Yılı</label>
                                        <input name="yil" required type="text" readonly class="form-control" id="exampleInputEmail1" value="<?php echo date("Y");?>">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    </div>
                                </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <form method="post" role="form" action="<?php echo base_url('Ogrenci/home/afisGuncelle'); ?>" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                        <label for="exampleInputEmail1">Afiş</label>
                                        <?php if($inf->afis!=""){ ?>
                                        <a style="color:black;margin-left:5px;" href="<?php echo base_url('Ogrenci/Home/projeAfisindir') ?>"> <i class="fas fa-download"></i>indir</a>
                                        <?php } ?>
                                        <input class="form-control-file" id="exampleFormControlFile1" type="file" name="userfile" size="20" />
                                        <small>Only gif|jpg|png|pdf and less than 15MB</small>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </form>
                            <form method="post" role="form" action="<?php echo base_url('Ogrenci/home/dosyaGuncelle'); ?>" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                        <label for="exampleInputEmail1">Dosya</label>
                                        <?php if($inf->dosya!=""){ ?>
                                        <a style="color:black" href="<?php echo base_url('Ogrenci/Home/projeDosyaindir') ?>"><i class="fas fa-download"></i> İndir</a>
                                        <?php } ?>
                                        <input class="form-control-file" id="exampleFormControlFile1" type="file" name="userfilea" size="20" />
                                        <small>Only pdf and less than 16MB</small><br><br>
                                        <small>Dosya ismi "projekodu_projeadi.pdf" şeklinde türkçe karakter ve boşluk olmadan yükleyin</small><br>
                                        <small>Pdflerini yüklemede sorun yaşayanlar pdf boyut küçültmeyi deneyebilirler</small><br>
                                        <button ><a href="https://smallpdf.com/tr/compress-pdf" target="_blank">Pdf küçültme</a></button>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <?php if($inf->videoUrl != ""){ ?>
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Video</h3>
                                </div>
                                <div class="box-body">
                                    <?php echo $inf->videoUrl ?>
                                </div>
                            </div>
                            <?php }else{ ?>
                            <div class="box-body">
                                Projenize video Eklenmedi.
                            </div>
                            <?php } ?>
                            <form method="post" role="form" action="<?php echo base_url('Ogrenci/home/video'); ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Video URL</label>
                                        <input name="videoURL" required type="text" class="form-control" value="<?php echo $inf->videoURL ?>" id="exampleInputEmail1" placeholder="Youtube URL">
                                        <small>Video Url bölümüne, videolarınızı upload eder etmez oluşan kısa linki kopyalamayınız.İzlerken oluşan uzun linki kopyalayınız.</small>
                                        <input name="projeKodu" type="hidden" value="<?php echo $inf->projeKodu ?>" class="form-control" id="exampleInputEmail1" placeholder="Proje Kodu">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
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
    CKEDITOR.replace('editor2');

</script>

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
