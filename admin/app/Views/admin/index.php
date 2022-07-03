<?= $this->extend('admin/includes/index'); ?>
<?= $this->section('page-content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='jumbotron'>
            <img src='https://cdn-icons-png.flaticon.com/512/149/149071.png' height='60'>
             <h1>Welcome to <?php  $session = session(); echo $session->get('username') ?></h1>
             <h4>Email: <?php  $session = session(); echo $session->get('email') ?></h4>
            <a href="<?= base_url()?>/dashboard/logout">Logout</a>
            </div>
        </div>

    </div>
</div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection('page-content'); ?>