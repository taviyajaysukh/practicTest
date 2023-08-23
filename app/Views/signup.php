<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container p-3">
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
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
                    <?php if(isset($validation)):?>
                    <div class="alert alert-warning">
                        <?= $validation->listErrors() ?>
                    </div>
                    <?php endif;?>
                        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h4>Signup Form</h4>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="<?=base_url()?>img/register.jpg"
                                    alt="avatar" class="img-fluid" style="width: 550px;height:350px;">
                                    <a href="/signin">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form class="row g-3 p-3" action="<?php echo base_url(); ?>userStore" method="post"
                            enctype="multipart/form-data">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Profile Picture</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="file" name="profile_picture" id="profile_picture"
                                                class="form-control" aria-label="file example" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="full_name" name="full_name"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Gender</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                                            <label class="form-check-label" for="gender">
                                                Male
                                            </label>
                                            <input class="form-check-input" type="radio" name="gender" id="gender" value="famale">
                                            <label class="form-check-label" for="gender">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
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
                                            <p class="mb-0">City</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="city" id="city" class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">State</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="state" id="state" class="form-control"
                                                placeholder="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Username</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" id="username" class="form-control"
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
                                            <p class="mb-0">Status</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <select class="form-select" name="status" id="status"
                                                aria-label="Default select example">
                                                <option>Select status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Suspend</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="address" name="address"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                        <button class="btn btn-success" type="submit">Save</button>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>
</html>