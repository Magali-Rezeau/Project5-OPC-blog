        <div class="header-content">
            <div class="header-content-text">
                <h1>S'inscrire</h1>
                <br>
                <p>Pour vous inscrire, merci de remplir <span class="catch">le formulaire</span> ci-dessous.</p>
                <br>
                <p>Déjà inscrit ?</p>
                <button class="btn"><a href="../public/index.php?page=login">Se connecter</a></button>
            </div>
            <div class="header-content-img-signup">
            </div>
        </div>
    </header>
    <section id="signup" class="signup">
        <div class="signup-content">
            <form action="../public/index.php?page=signup" method="POST" id="signup-form" name="signup-form" class="signup-content-form">
                <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
                    <span class="errors"><?= isset($errorPseudo) ? $errorPseudo : '' ?></span>
                    <?= $form->text('username', 'Pseudo') ?>
                </div>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                    <?= $form->password('password', 'Mot de passe') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->password('confirm_password', 'Confirmer votre mot de passe') ?>
                </div>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                    <?= $form->email('email', 'Email') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->email('confirm_email', 'Confirmer votre email') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->submit('submit', 'S\'inscrire') ?>
                </div>
            </form>
            <div class="signup-content-redir">
                <p>Déjà inscrit ?</p>
                <button class="btn"><a href="../public/index.php?page=login">Se connecter</a></button>
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div> 
    </section>
