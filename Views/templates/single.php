        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="succes">
                        <?= isset($succes_addComment) ? htmlspecialchars($succes_addComment) : '' ?>
                    </span>
                    <span class="errors">
                        <?= isset($error_addComment) ? htmlspecialchars($error_addComment) : '' ?>
                    </span>
                </div>
                <h1>Bienvenue,</h1>
                <br>
                <p>Découvrez l'article <span class="catch"><?= htmlspecialchars($post->title) ?></span>.</p>
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
                            $format_date = $date->format("d-m-Y");
                            ?> 
                            <?= $format_date ?>
                        </span>
                        <br>Modifié le
                        <span class="catch">
                            <?php
                            $modification_date = new \DateTime($post->modification_date);
                            $format_modification_date = $modification_date->format("d-m-Y");
                            ?>
                            <?= htmlspecialchars($format_modification_date) ?>
                        </span>
                    </h3>
                </div>
                <div class="post-card-content">
                    <p><?= htmlspecialchars($post->short_content); ?></p>
                    <hr>
                    <p><?= htmlspecialchars($post->content); ?></p>
                </div>
                <div class="post-card-comment">
                    <div class="post-card-comment-title">
                        <h1>Commentaires</h1>
                        <hr>
                    </div>
                    <div class="post-card-comment-content">
                        <?php foreach ($comments as $comment) : ?>
                            <div class="post-card-comment-content-profil">
                                <img src="../public/membres/profile_picture<?= htmlspecialchars($comment->profile_picture) ?>">
                                <h3>
                                    <span class="catch">
                                        <?= htmlspecialchars($comment->author) ?>
                                    </span>
                                </h3>
                            </div>
                            <div class="post-card-comment-content-text">
                                <h4>Le
                                    <span class="catch">
                                        <?php
                                        $date = new \DateTime($comment->create_date);
                                        $format_date = $date->format("d-m-Y à h:m:s");
                                        ?>
                                        <?= htmlspecialchars($format_date) ?>
                                    </span>
                                </h4>
                                <p><?= htmlspecialchars($comment->content) ?></p>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                        <?php if(isset($_SESSION['id_user'])) : ?>
                            <h2>Ajouter un commentaire</h2>
                            <div class="post-card-comment-content-add">
                                <div class="post-card-comment-content-add-profil">
                                    <img src="../public/membres/profile_picture<?= $user->profile_picture ?>">
                                    <h3>
                                        <span class="catch">
                                            <?= htmlspecialchars(ucfirst($user->pseudo)) ?>
                                        </span>
                                    </h3>
                                </div>
                                <form action="../public/index.php?page=single&id_post=<?= $post->id_post ?>" method="post" id="comment-form" name="comment-form" class="post-card-comment-content-add-form">
                                    <span class="errors">
                                        <?= isset($errors['content']) ? $errors['content'] : '' ?>
                                    </span>
                                    <div class="post-card-comment-content-add-form-item">
                                        <?= $form->textarea('content', 'Commentaire','','required') ?>
                                    </div>
                                    <div class="post-card-comment-content-add-form-item">
                                        <?= $form->submit('submit', 'Envoyer') ?>
                                    </div>
                                </form>
                            </div>
                        <?php else : ?>
                            <div class="post-card-comment-redir">
                                <p>Vous devez être connecté pour ajouter un commentaire.</p>
                                <button class="btn"><a href="../public/index.php?page=login">Se connecter</a></button>
                                <button class="btn"><a href="../public/index.php?page=signup">S'inscrire</a></button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="post-card-redir">
                    <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
                    <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
                </div>
            </div>
        </section>
