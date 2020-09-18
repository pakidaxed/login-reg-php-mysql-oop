<div class="form-box">
    <div class="box-logo">
        <img src="img/logo.svg" alt="Logo"/>
    </div>
    <form action="" method="post">
        <div class="form-field">
            <div class="login-error">
                <?= $errors['login'] ?? '' ?>
            </div>
            <div class="input-field">
                <label><span>Email:</span>
                    <input type="email" name="email" placeholder="example@example.com"
                           value="<?= $_POST['email'] ?? '' ?>"/>
                </label>
            </div>
            <div class="input-field">
                <label><span>Password:</span>
                    <input type="password" name="password" placeholder="Password"/>
                </label>
            </div>
            <div class="input-button">
                <button name="submit">Login</button>
            </div>
        </div>
    </form>
</div>