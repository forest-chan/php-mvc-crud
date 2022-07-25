<div class="d-flex justify-content-center align-items-center container">
    <div class="row">
        <div class="container">
            <?php if (isset($errors)) : ?>
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="text-center">
                            <strong><?= $error; ?></strong>
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php endforeach;
            endif;
            ?>
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
                        <input type="email" name="email" required placeholder="Enter email" value="<?php if (isset($user['email'])) echo $user['email']; ?>" class="form-control" id="inputUserName" aria-labelledby="emailnotification">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="password" name="password" required placeholder="Enter password" class="form-control" id="inputPassword" aria-labelledby="passwordnotification">
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center container">
                        <input type="submit" name="signIn" value="Sign in" class="btn btn-outline-dark">
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center container">
                        <p>Not registered yet? -
                            <a href="<?= '/register' ?>">Sign up</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>