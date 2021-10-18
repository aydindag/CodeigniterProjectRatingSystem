<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hata
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Hata</a></li>
        <li class="active">Proje</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="error-page">
        <h2 class="headline text-red">HATA</h2>

        <div style="margin-left:250px;" class="error-content">
          <h3><i class="fa fa-warning text-red"></i> Eklediğiniz Herhangi Bir Proje Bulunamadı.</h3>

          <p>
            Proje eklemek için lütfen ilgili sayfaya <a href="<?php echo base_url('ogrenci/home/projeEkle') ?>">
                <strong>buraya</strong>
            </a> tıklayarak gidin.            
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
