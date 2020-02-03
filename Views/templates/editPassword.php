        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                <br>
                <p>Vous pouvez votre mot de passe.</p>
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

    <section id="editPassword" class="editPassword">
        <div class="editPassword-content">
            <form method="post" enctype="multipart/form-data" action="../public/index.php?page=editPassword&id_user=<?= $user->id_user ?>" class="editPassword-content-form">
            <h1 class="editPassword-content-form-title">Profil de <?= ucfirst($user->pseudo) ?></h1>
                <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                <div class="editPassword-content-form-item">
                    <span class="errors"><?= isset($errors['password']) ? $errors['password'] : '' ?></span>
                    <?= $form->password('password', 'Modifier votre mot de passe','','required') ?>
                </div>
                <div class="editPassword-content-form-item">
                    <?= $form->password('confirm_password', 'Confirmer votre mot de passe','','required') ?>
                </div>
                <div class="editPassword-content-form-item">
                    <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
            </form>
            <div class="editPassword-content-redir">
                <button class="btn"><a href="../public/index.php?page=profil&id_user=<?= $user->id_user ?>">Profil</a></button>
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
