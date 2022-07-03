<?= $this->extend('auth/includes/index'); ?>

<?= $this->section('content'); ?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Forgot Password</h1>
                                    </div>
                                    <?php 
            if(isset($validation)): ?>
            <div class="alert alert-danger">
            <?= $validation->listErrors()?>
            </div>
            <?php endif;?>
            
            
        <?php if(session()->getTempdata('error')):?>
	<div class='alert alert-danger'><?= session()->getTempdata('error');?></div>
	<?php endif;?>
        
        <?php if(session()->getTempdata('success')):?>
	<div class='alert alert-success'><?= session()->getTempdata('success');?></div>
	<?php endif;?>
                                    <form action="/login/forgot_password" method="post">
                                        <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp" name="email"
                                                placeholder="Enter Email Address" value="<?= set_value('email') ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url() ?>/">Login</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url() ?>/register">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
<?= $this->endSection('content'); ?>
