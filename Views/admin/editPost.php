        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="succes">
                        <?= isset($succes_editPost) ? $succes_editPost : '' ?>
                    </span>
                    <span class="errors">
                        <?= isset($error_editPost) ? $error_editPost : '' ?>
                    </span>
                </div>
                <h1>Modification d'un article</h1>
            </div>
            <div class="header-content-img-admin">
            </div>
        </div>
    </header>
    <section class="editPost">
        <div class="editPost-content">
            <form method="post" action="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>" class="editPost-content-form">
                <span class="errors"><?= isset($errors['title']) ? $errors['title'] : '' ?></span>
                <div class="editPost-content-form-item">
                    <?= $form->text('title', 'Titre', $post->title) ?>
                </div>
                <span class="errors"><?= isset($errors['author']) ? $errors['author'] : '' ?></span>
                <div class="editPost-content-form-item">
                    <?= $form->text('author', 'Auteur', $post->author) ?>
                </div>
                <span class="errors"><?= isset($errors['short_content']) ? $errors['short_content'] : '' ?></span>
                <div class="editPost-content-form-item">
                    <?= $form->textarea('short_content', 'Short_content',$post->short_content) ?>
                </div>
                <span class="errors"><?= isset($errors['content']) ? $errors['content'] : '' ?></span>
                <div class="editPost-content-form-item">
                    <?= $form->textarea('content', 'Content',$post->content) ?>
                </div>
                <div class="editPost-content-form-item">
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
            </form>
            <div class="editPost-content-redir">
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'ADMIN') : ?>
                    <button class="btn"><a href="../public/index.php?page=dashboard">Dashboard</a></button>
                <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] === 'EDITOR') : ?>
                    <button class="btn"><a href="../public/index.php?page=editorDashboard">Dashboard</a></button>
                <?php endif; ?> 
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
