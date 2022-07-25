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
                        <input type="email" name="email" placeholder="Enter email" required value="<?php if (isset($form['email'])) echo $form['email']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="text" name="name" placeholder="Enter name" required value="<?php if (isset($form['name'])) echo $form['name']; ?>" class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="mb-4">
                        <input type="password" name="password" placeholder="Enter password" required class="form-control" id="exampleInputPassword1">
                    </div>
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" name="isAdmin" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Should be an admin?</label>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-center align-items-center container">
                        <button type="submit" name="submit" required class="btn btn-outline-dark">Create</button>
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