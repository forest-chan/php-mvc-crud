<div class="d-flex justify-content-center align-items-center container">
    <div class="row">
        <div class="container">
            <?php if (isset($errors)) { ?>
                <?php foreach ($errors as $error) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="text-center">
                            <strong><?= $error; ?></strong>
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</div>
<div class="container py-5 h-100">
    <div class="d-flex justify-content-center align-items-center container ">
        <div class="row">
            <form action="" method="POST" class="form-control">
                <div class="form-group">
                    <div class="mb-4">
                        <input type="hidden">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="hidden" name="id" value="<?= $user['id']; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="email" name="email" placeholder="Enter new email" value="<?= $user['email']; ?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="text" name="name" placeholder="Enter new name" value="<?= $user['name']; ?>" required class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Enter new password" class="form-control" id="exampleInputPassword1">
                        <div id="emailHelp" class="form-text">If the password is empty, the old one will be used</div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center container">
                        <button type="submit" name="update" required class="btn btn-outline-dark">Edit</button>
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center container">
                        <p>Missclick? -
                            <a href="">Refresh</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>