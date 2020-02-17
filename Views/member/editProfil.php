        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="errors">
                        <?= $this->session->show('error_editProfil') ?>
                    </span>
                </div>
                <br>
                <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                <p>Vous pouvez modifier votre pseudo, votre mot de passe et votre photo de profil.</p>
                <br>
                <p>Se déconnecter ?</p>
                <button class="btn"><a href="../public/index.php?page=signout">Se déconnecter</a></button>
            </div>
            <?php if ($user->profile_picture) : ?>
                <img class="header-content-profile-picture" src="../public/profile_pictures/profile_picture<?= $user->profile_picture ?>">
            <?php else : ?>
                <div class="header-content-img-profil"></div>
            <?php endif; ?>
        </div>
        </header>
        <section id="editProfil" class="editProfil">
            <div class="editProfil-content">
                <form method="post" enctype="multipart/form-data" action="../public/index.php?page=editProfil&id_user=<?= $user->id_user ?>" class="editProfil-content-form">
                    <h1 class="editProfil-content-form-title">Modifier votre profil</h1>
                    <span class="errors">
                        <?= isset($errors['pseudo']) ? $errors['pseudo'] : '' ?>
                    </span>
                    <span class="errors">
                        <?= isset($error_pseudoDB) ? $error_pseudoDB : '' ?>
                    </span>
                    <div class="editProfil-content-form-item">
                        <?= $form->text('pseudo', 'Modifier votre pseudo', $user->pseudo, 'required') ?>
                    </div>
                    <div class="editProfil-content-form-item">
                        <h3>Modifier votre mot de passe</h3>
                        <button class="btn btn-editPassword"><a href="../public/index.php?page=editPassword&id_user=<?= $user->id_user ?>">Modifier</a></button>
                    </div>
                    <span class="errors">
                        <?= isset($error_weight) ? $error_weight : '' ?>
                    </span>
                    <span class="errors">
                        <?= isset($error_upload) ? $error_upload : '' ?>
                    </span>
                    <span class="errors">
                        <?= isset($error_format) ? $error_format : '' ?>
                    </span>
                    <div class="editProfil-content-form-item">
                        <?= $form->file('profile_picture', 'Modifier votre photo de profil', $user->profile_picture) ?>
                    </div>
                    <div class="editProfil-content-form-item">
                        <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>
                        <?= $form->submit('submit', 'Valider') ?>
                    </div>
                </form>
                <div class="editProfil-content-redir">
                    <button class="btn"><a href="../public/index.php?page=profil&id_user=<?= $user->id_user ?>">Profil</a></button>
                    <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                    <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
                </div>
            </div>
        </section>