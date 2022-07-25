<ul class="nav justify-content-end">
    <li class="nav-item">
        <a class="nav-link disabled"><?= $currentUser['email'] ?></a>
    </li>
    <li class="nav-item">
        <a class="btn btn-outline-dark" aria-current="page" href="/users/myprofile">My profile</a>
    </li>
    <li class="nav-item">
        <a class="btn btn-outline-dark disabled" aria-current="page" href="/courses">My courses</a>
    </li>
    <?php if ($adminState) : ?>
        <li class="nav-item">
            <a class="btn btn-outline-dark" aria-current="page" href="/users/create">Create user</a>
        </li>
    <?php endif; ?>
    <li class="nav-item">
        <a class="btn btn-outline-dark" aria-current="page" href="/users/logout">Logout</a>
    </li>
</ul>
<div class="d-flex justify-content-center align-items-center container">
    <table class="table table-light table-striped">
        <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Email</th>
                <th scope="col">Name</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)) : ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="uid"><?= $user['id'] ?></td>
                        <td class="email"><?= $user['email'] ?></td>
                        <td class="name"><?= $user['name'] ?></td>
                        <?php if ($adminState) : ?>
                            <td>
                                <a href="<?= "/users/{$user['id']}/delete" ?>" class="btn btn-outline-dark" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                <a href="<?= "/users/{$user['id']}" ?>" class="btn btn-outline-dark">View<a>
                            </td>
                        <?php else : ?>
                            <td>
                                <a href="<?= "/users/{$user['id']}" ?>" class="btn btn-outline-dark">View<a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($currentPage > 1) : ?>
            <li class="page-item">
                <a href="<?= '?page=' . $currentPage - 1; ?>" class="page-link">Previous</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= '?page=1' ?>">1</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled" style="display:none">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item disabled" style="display:none">
                <a class="page-link" href="">1</a>
            </li>
        <?php endif; ?>
        <li class="page-item active" aria-current="page"><a class="page-link" href=""><?= $currentPage; ?></a></li>
        <?php if ($currentPage < $countOfPages) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= '?page=' . $countOfPages ?>"><?= $countOfPages ?></a>
            </li>
            <li class="page-item">
                <a href="<?= '?page=' . $currentPage + 1 ?>" class="page-link">Next</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled" style="display:none">
                <a class="page-link" href=""><?= $countOfPages ?></a>
            </li>
            <li class="page-item disabled " style="display:none">
                <a class="page-link">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>