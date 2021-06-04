<?php
$session = \Config\Services::session();
?>
<!--Login Form with validation throughout the fields-->
<div class="container">
    <h1>Log In</h1>
    <form action="/user/login" method="post">
        <div class="form-group">
            <label for="number" class="form-label">Phone Number</label>
            <?php if (isset($validation)): ?>
                <div class="text-danger">
                    <?= $validation->getError('number') ?>
                </div>
            <?php endif; ?>
            <input type="text" class="form-control" name="number" id="number" value="<?= old('number') ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <?php if (isset($validation)): ?>
                <div class="text-danger">
                    <?= $validation->getError('password'); ?>
                </div>
            <?php endif; ?>
            <input type="password" class="form-control" name="password" id="password" value="">
            <div class="text-danger">
                <?= $session->getFlashData('password'); ?>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    <?= $session->getFlashData('number'); ?>
</div>

