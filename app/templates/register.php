<div class="form-box">
    <div class="box-logo">
        <img src="img/logo.svg" alt="Logo"/>
    </div>
    <form method="post">
        <div class="form-field">
            <?php if ($reg_success ?? false): ?>
                <div class="reg-success">
                    <h1>Registration Successful</h1>
                    <a href="?action=login">Now you can Log in !</a>
                </div>
            <?php else: ?>
                <div class="input-field">
                    <label><span>Email:</span>
                        <input type="email" name="email" placeholder="example@example.com"
                               value="<?= $_POST['email'] ?? '' ?>"/>
                        <span class="field-error"><?= $errors['email'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-field">
                    <label><span>First name:</span>
                        <input type="text" name="name" placeholder="First name" value="<?= $_POST['name'] ?? '' ?>"/>
                        <span class="field-error"><?= $errors['name'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-field">
                    <label><span>Last name:</span>
                        <input type="text" name="last_name" placeholder="Last name"
                               value="<?= $_POST['last_name'] ?? '' ?>"/>
                        <span class="field-error"><?= $errors['last_name'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-field">
                    <label><span>Phone number:</span>
                        <input type="tel" name="phone" placeholder="3706XXXXXXX" value="<?= $_POST['phone'] ?? '' ?>"/>
                        <span class="field-error"><?= $errors['phone'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-field">
                    <label><span>Password:</span>
                        <input type="password" name="password" placeholder="Password"/>
                        <span class="field-error"><?= $errors['password'] ?? $errors['password_confirm'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-field">
                    <label><span>Password confirm:</span>
                        <input type="password" name="password_confirm" placeholder="Password confirm"/>
                        <span class="field-error"><?= $errors['password_confirm'] ?? '' ?></span>
                    </label>
                </div>
                <div class="input-button">
                    <button name="submit">Register</button>
                </div>
            <?php endif; ?>
        </div>
    </form>
</div>