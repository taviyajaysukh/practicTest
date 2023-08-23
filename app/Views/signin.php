<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container p-3">
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                    <?php if(isset($validation)):?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                    <?php endif;?>
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h4>Login Form</h4>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <?php
                if(session()->get("success")){
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->get("success") ?>
                        </div>
                        <?php
                }
                if(session()->get("error")){
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->get("error") ?>
                        </div>
                        <?php
                }
                ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                            <img src="<?=base_url()?>img/login.png"
                                    alt="avatar" class="img-fluid" style="width: 300px;height:200px;">
                                    <a href="/signup">Signup</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form class="row g-3 p-3" action="<?php echo base_url(); ?>userlogin" method="post">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Password</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <button class="btn btn-success" type="submit">Login</button>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </form>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>
</html>