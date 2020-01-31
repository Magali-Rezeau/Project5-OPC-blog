        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                <br>
                <p>Vous pouvez modifier votre pseudo, votre mot de passe et ajouter une photo de profil.</p>
                <br>
                <p>Se déconnecter ?</p>
                <button class="btn"><a href="../public/index.php?page=signout">Se déconnecter</a></button>                
        </div>
        <?php if($user->profile_picture) : ?>
            <img src="../public/membres/profile_picture<?= $user->profile_picture?>" width="300">
            <?php else : ?>
                <div class="header-content-img-profil">
        </div>
        <?php endif; ?>
        </div>
    </header>

    <section id="editProfil" class="profil">
        <div class="editProfil-content">
            <form method="post" enctype="multipart/form-data" action="../public/index.php?page=editProfil&id_user=<?= $user->id_user ?>" class="editProfil-content-form">
            <h1 class="editProfil-content-form-title">Profil de <?= ucfirst($user->pseudo) ?></h1>
                <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                <div class="editProfil-content-form-item">
                    <span class="errors"><?= isset($errors['pseudo']) ? $errors['pseudo'] : '' ?></span>  
                    <span class="errors"><?= isset($errors['pseudoDB']) ? $errors['pseudoDB'] : '' ?></span>           
                    <?= $form->text('pseudo', 'Modifier votre pseudo', $user->pseudo, 'required') ?>
                </div>
                <div class="signup-content-form-item">
                    <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                    <?= $form->password('password', 'Ressaisir ou modifier votre mot de passe','','required') ?>
                </div>
                <div class="signup-content-form-item">
                    <?= $form->password('confirm_password', 'Confirmer votre mot de passe','','required') ?>
                </div>
                <div class="editProfil-content-form-item">
                    <span class="errors"><?= isset($errors['content']) ? $errors['content'] : '' ?></span>
                    <?= $form->file('profile_picture', 'Photo de profil', $user->profile_picture) ?>
                </div>
                <div class="editProfil-content-form-item">
                    <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
            </form>
            <?= var_dump($user->password) ?>
            <div class="editProfil-content-redir">
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
