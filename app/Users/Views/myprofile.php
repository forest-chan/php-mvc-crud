<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center text-dark" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <form enctype="multipart/form-data" action="" method="post">
                            <?php if (file_exists('./avatars/' . $user['avatar'])) : ?>
                                <div class="logo">
                                    <input name="avatar" type="file" id="input_id" hidden>
                                    <label for="input_id">
                                        <img src="<?= '/avatars/' . $user['avatar'] ?>" alt="Avatar" class="img-fluid my-3" style="width: 90px;" />
                                    </label>
                                </div>
                            <?php else : ?>
                                <div class="logo">
                                    <input name="avatar" type="file" id="input_id" hidden>
                                    <label for="input_id">
                                        <img src="<?= '/avatars/default.png'; ?>" alt="Avatar" class="img-fluid my-3" style="width: 90px;" />
                                    </label>
                                </div>
                            <?php endif; ?>
                            <div class="mb-1">
                                <button type="submit" name="submit" class="btn btn-outline-dark" style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 80%">
                                    Edit my avatar
                                </button>
                            </div>
                            <div class="mb-1">
                                <a href="<?= "/users/{$user['id']}/edit"; ?>" class="btn btn-outline-dark" style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 80%">
                                    Edit my info
                                </a>
                            </div>
                            <div class="mb-1">
                                <a href="<?= '/users' ?>" class="btn btn-outline-dark" style="--bs-btn-padding-y: .50rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem; width: 80%">Go back</a>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-6">
                            <h6>Information</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-4">
                                    <h6>Email</h6>
                                    <p class="text-dark"><?= $user['email'] ?></p>
                                </div>
                                <div class="col-6 mb-4">
                                    <h6>Name</h6>
                                    <p class="text-dark"><?= $user['name'] ?></p>
                                </div>
                                <div class="col-6 mb-4">
                                    <h6>My role</h6>
                                    <?php if ($adminState) : ?>
                                        <p class="text-dark">I'm an admin</p>
                                    <?php  else : ?>
                                        <p class="text-dark">I'm regular user</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>