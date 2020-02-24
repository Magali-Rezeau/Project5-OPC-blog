        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="errors">
                        <?= $this->session->show('error_login') ?>
                    </span>
                </div>
                <h1>Se connecter</h1>
                <br>
                <p>Pour vous connecter, merci de remplir <span class="catch">le formulaire</span> ci-dessous.</p>
                <br>
                <p>Pas encore inscrit ?</p>
                <button class="btn"><a href="../public/index.php?page=signup">S'inscrire</a></button>                
            </div>
            <div class="header-content-img-login">
            </div>
        </div>
    </header>

    <section id="login" class="login">
        <div class="login-content">
            <form action="../public/index.php?page=login" method="POST" id="login-form" name="login-form" class="login-content-form">
                <span class="errors">
                    <?= isset($errors['pseudo']) ? $errors['pseudo'] : '' ?>
                </span>
                <div class="login-content-form-item">
                    <?= $form->text('pseudo', 'Pseudo','','required') ?>
                </div>
                <span class="errors">
                    <?= isset($errors['password']) ? $errors['password'] : '' ?>
                </span>
                <div class="login-content-form-item">
                    <?= $form->password('password', 'Mot de passe','','required') ?>
                </div>
                <div class="login-content-form-item">
                    <?= $form->submit('submit', 'Se connecter') ?>
                </div>
            </form>
            <div class="login-content-redir">
                <p>Pas encore inscrit ?</p>
                <button class="btn"><a href="../public/index.php?page=signup">S'inscrire</a></button>
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
    