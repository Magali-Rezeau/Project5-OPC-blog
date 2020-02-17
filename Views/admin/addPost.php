        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="succes">
                        <?= $this->session->show('addPost') ?>
                    </span>
                    <span class="errors">
                        <?= $this->session->show('error_addPost') ?>
                    </span>
                </div>
                <h1>Ajout d'un article</h1>
                <?php if(!empty($method) && empty($errors)): ?>
                    <?php if($this->userSession->checkAdmin()): ?>
                        <button class="btn"><a href="../public/index.php?page=dashboard">Dashboard</a></button>
                    <?php elseif($this->userSession->checkEditor()): ?>
                        <button class="btn"><a href="../public/index.php?page=editorDashboard">Dashboard</a></button>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="header-content-img-admin">
            </div>
        </div>
    </header>
    <section class="addPost">
        <div class="addPost-content">
            <form method="post" action="../public/index.php?page=addPost" class="addPost-content-form">
                <span class="errors">
                    <?= isset($errors['title']) ? $errors['title'] : '' ?>
                </span>
                <div class="addPost-content-form-item">                                
                    <?= $form->text('title', 'Titre', '', 'required') ?> 
                </div>
                <span class="errors">
                    <?= isset($errors['short_content']) ? $errors['short_content'] : '' ?>
                </span> 
                <div class="addPost-content-form-item">                             
                    <?= $form->textarea('short_content', 'Short_content', '', 'required') ?>
                </div>
                <span class="errors">
                    <?= isset($errors['content']) ? $errors['content'] : '' ?>
                </span>
                <div class="addPost-content-form-item">
                    <?= $form->textarea('content', 'Content', '', 'required') ?>
                </div>
                <div class="addPost-content-form-item">
                    <?= $form->submit('submit', 'Valider') ?>
                </div>
            </form>
            <div class="addPost-content-redir">
                <?php if($this->userSession->checkAdmin()) : ?>
                    <button class="btn"><a href="../public/index.php?page=dashboard">Dashboard</a></button>
                <?php elseif($this->userSession->checkEditor()) : ?>
                    <button class="btn"><a href="../public/index.php?page=editorDashboard">Dashboard</a></button>
                <?php endif; ?> 
                <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
        </div>
    </section>
    