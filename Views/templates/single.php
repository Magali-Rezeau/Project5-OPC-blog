        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="catch">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours <span class="catch">Développeur d'application PHP/Symfony</span> et cette page est un <span class="catch">blog</span> développé en php.</p>
            </div>
            <div class="header-content-img-blog">
            </div>
        </div>
        </header>
        <section class="post">
            <div class="post-card">
                <div class="post-card-header">
                    <h1><?= htmlspecialchars($post->title); ?></h1>
                    <hr>
                    <h3>Par <span class="catch"><?= htmlspecialchars($post->author); ?></span> le
                        <span class="catch">
                            <?php
                            $date = new \DateTime($post->create_date);
                            echo $date->format("d-m-Y");
                            ?>
                        </span>
                        <br>Modifié le
                        <span class="catch">
                            <?php
                            $modification_date = new \DateTime($post->modification_date);
                            echo $modification_date->format("d-m-Y");
                            ?>
                        </span>
                    </h3>
                </div>
                <div class="post-card-content">
                    <p><?= htmlspecialchars($post->short_content); ?></p>
                    <hr>
                    <p><?= htmlspecialchars($post->content); ?></p>
                </div>
                <div class="post-card-comment">
                    <h1>Commentaires</h1>
                    <hr>
                    <?php foreach ($comments as $comment) : ?>
                        <h3><span class="catch"><?= htmlspecialchars($comment->author); ?></span></h3>
                        <h4>Le
                            <span class="catch">
                                <?php
                                $date = new \DateTime($comment->create_date);
                                echo $date->format("d-m-Y à h:m:s");
                                ?>
                            </span>
                        </h4>
                        <p><?= htmlspecialchars($comment->content); ?></p>
                        <hr>
                    <?php endforeach; ?>
                    <form action="../public/?page=single" method="post" id="comment-form" name="comment-form" class="post-card-comment-form">
                        <h2>Ajouter un commentaire</h2>
                        <span class="succes"><?= isset($succes) ? $succes : '' ?></span>
                        <div class="post-card-comment-form-item">
                            <span class="errors"><?= isset($errors['username']) ? $errors['username'] : '' ?></span>
                            <?= $form->text('username', 'Pseudo') ?>
                        </div>
                        <div class="post-card-comment-form-item">
                            <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                            <?= $form->password('password', 'Mot de passe') ?>
                        </div>
                        <div class="post-card-comment-form-item">
                            <span class="errors"><?= isset($errors['comment']) ? $errors['comment'] : '' ?></span>
                            <?= $form->textarea('comment', 'Commentaire') ?>
                        </div>
                        <div class="post-card-comment-form-item">
                            <?= $form->submit('submit', 'Envoyer') ?>
                        </div>
                    </form>
                </div>
                <div class="post-card-redir">
                    <button class="btn"><a href="../public/?page=blog">Blog</a></button>
                    <button class="btn"><a href="../public/?page=home">Accueil</a></button>
                </div>
            </div>
        </section>