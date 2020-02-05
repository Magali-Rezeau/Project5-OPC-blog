        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
                <br>
                <p>Ci-dessous, vous trouverez toutes les informations relatives à votre <span class="catch">profil</span>.</p>
                <br>
                <p>Vous pouvez modifier votre profil en cliquant sur le bouton <span class="catch">modifier</span>.</p>
                <br>
                <p>Se déconnecter ?</p>
                <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>  
            </div>
            <?php if($user->profile_picture) : ?>
                <img src="../public/membres/profile_picture<?= $user->profile_picture?>" width="300">
            <?php else : ?>
                <div class="header-content-img-profil"></div>
            <?php endif; ?>
        </div>
    </header>
    <section id="profil" class="profil">
        <div class="profil-content">
            <form method="post" action="../public/index.php?page=profil&id_user=<?= $user->id_user ?>" class="profil-content-form">
                <h1 class="profil-content-form-title">Profil de 
                    <?= ucfirst($user->pseudo)?>
                </h1>
                <div class="profil-content-form-item">            
                    <?= $form->text('pseudo', 'Pseudo', $user->pseudo, 'readonly="readonly"') ?>
                </div>
                <div class="profil-content-form-item">
                    <?= $form->email('email', 'Email',$user->email,'readonly="readonly"') ?>
                </div>
                <div class="profil-content-form-item">
                    <?= $form->text('role', 'Role',$user->role, 'readonly="readonly"') ?>
                </div>
                <div class="profil-content-form-item">
                    <?php  
                        $create_date = new \DateTime($user->create_date);  
                        $create_date_format = $create_date->format("d-m-Y"); 
                    ?>
                    <?= $form->text('create_date', 'Date de création', $create_date_format, 'readonly="readonly"') ?>
                </div>
                <div class="profil-content-form-item">
                    <button class="btn"><a href="../public/index.php?page=logout">Se déconnecter</a></button>
                    <button class="btn"><a href="../public/index.php?page=editProfil&id_user=<?= $_SESSION['id_user'] ?>">Modifier</a></button>
                </div>
            </form>   
            <div class="profil-content-redir">
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
