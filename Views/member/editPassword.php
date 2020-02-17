        <div class="header-content">
            <div class="header-content-text">
            <div class="header-content-text-message">
                    <span class="succes">
                        <?= $this->session->show('editPassword') ?>
                    </span>
                    <span class="errors">
                        <?= $this->session->show('error_editPassword') ?>
                    </span>
                </div>
                <br>
                <?php if(!empty($method) && empty($errors)): ?>
                    <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                    <p>Vous pouvez retourner sur votre profil ou vous déconnecter.</p>
                    <button class="btn"><a href="../public/index.php?page=profil&id_user=<?= $user->id_user ?>">Profil</a></button>
                    <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>
                <?php else : ?>
                    <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                    <br>
                    <p>Vous pouvez modifier votre mot de passe en remplissant le formulaire ci-dessous.</p>
                    <br>
                    <p>Se déconnecter ?</p>
                    <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>  
                <?php endif; ?>                 
            </div>
            <?php if($user->profile_picture) : ?>
                <img class="header-content-profile-picture" src="../public/profile_pictures/profile_picture<?= $user->profile_picture?>">
            <?php else : ?>
                <div class="header-content-img-profil"></div>
            <?php endif; ?>
        </div>
    </header>

    <section id="editPassword" class="editPassword">
        <div class="editPassword-content">
            <form method="post" enctype="multipart/form-data" action="../public/index.php?page=editPassword&id_user=<?= $user->id_user ?>" class="editPassword-content-form">
                <h1 class="editPassword-content-form-title">Modifier votre mot de passe</h1>
                <span class="errors">
                    <?= isset($errors['password']) ? $errors['password'] : '' ?>
                </span>
                <div class="editPassword-content-form-item">
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
