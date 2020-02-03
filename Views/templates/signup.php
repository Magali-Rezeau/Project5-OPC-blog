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
                    <span class="errors"><?= isset($errors['pseudo']) ? $errors['pseudo'] : '' ?></span>
                    <span class="errors"><?= isset($error_pseudoDB) ? $error_pseudoDB : '' ?></span>
                    <?= $form->text('pseudo', 'Pseudo','', 'required') ?>
                </div>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                    <span class="errors"><?= isset($error_emailDB) ? $error_emailDB : '' ?></span>
                    <?= $form->email('email', 'Email','', 'required') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->email('confirm_email', 'Confirmer votre email','', 'required') ?>
                </div>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                    <?= $form->password('password', 'Mot de passe','', 'required') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->password('confirm_password', 'Confirmer votre mot de passe','', 'required') ?>
                </div>
               
                <div class="signup-content-form-item">
                    <?php if(isset($succes)) {
                    echo '<button class="btn"><a href="../public/index.php?page=login">Se connecter</a></button>';
                    } else {
                        echo $form->submit('submit', 'S\'inscrire');
                    }
                ?>
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
