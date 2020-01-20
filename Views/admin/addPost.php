        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="font">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours Développeur d'application PHP/Symfony et cette page permet <span class="font">d' administrer les articles du blog.</span></p>
            </div>
            <div class="header-content-img-admin">
            </div>
        </div>
    </header>
    <section class="addPost">
        <div class="addPost-content">
            <form method="post" action="../public/index.php?page=addPost" class="addPost-content-form">
                <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                <div class="addPost-content-form-item">                               
                    <span class="errors"><?= isset($errors['title']) ? $errors['title'] : '' ?></span> 
                    <?= $form->text('title', 'Titre') ?> 
                </div>
                <div class="addPost-content-form-item"> 
                    <span class="errors"><?= isset($errors['author']) ? $errors['author'] : '' ?></span>             <?= $form->text('author', 'Auteur') ?>
                </div>
                <div class="addPost-content-form-item">
                    <span class="errors"><?= isset($errors['short_content']) ? $errors['short_content'] : '' ?></span>                              
                    <?= $form->textarea('short_content', 'Short_content') ?>
                </div>
                <div class="addPost-content-form-item">
                    <span class="errors"><?= isset($errors['content']) ? $errors['content'] : '' ?></span>
                    <?= $form->textarea('content', 'Content') ?>
                </div>
                <div class="addPost-content-form-item">
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
                <?php var_dump($_POST);?>
            </form>
            <div class="addPost-content-redir">
                <button class="btn"><a href="../public/index.php?page=dashboard">Dashboard</a></button>
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>