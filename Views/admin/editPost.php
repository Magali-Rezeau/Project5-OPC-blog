        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="font">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours Développeur d'application PHP/Symfony et cette page permet <span class="font">d' administrer les articles du blog.</span></p>
            </div>
            <div class="header-content-img-admin">
            </div>
        </div>
    </header>
    <section class="editPost">
        <div class="editPost-content">
            <form method="post" action="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>" class="editPost-content-form">
                <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                <div class="editPost-content-form-item">
                    <span class="errors"><?= isset($errors['title']) ? $errors['title'] : '' ?></span>               <?= $form->text('title', 'Titre', $post->title) ?>
                </div>
                <div class="editPost-content-form-item">
                    <span class="errors"><?= isset($errors['author']) ? $errors['author'] : '' ?></span>             <?= $form->text('author', 'Auteur', $post->author) ?>
                </div>
                <div class="editPost-content-form-item">
                    <span class="errors"><?= isset($errors['short_content']) ? $errors['short_content'] : '' ?></span>
                    <?= $form->textarea('short_content', 'Short_content',$post->short_content) ?>
                </div>
                <div class="editPost-content-form-item">
                    <span class="errors"><?= isset($errors['content']) ? $errors['content'] : '' ?></span>
                    <?= $form->textarea('content', 'Content',$post->content) ?>
                </div>
                <div class="editPost-content-form-item">
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
            </form>
            <div class="editPost-content-redir">
                <button class="btn"><a href="../public/index.php?page=dashboard">Dashboard</a></button>
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
