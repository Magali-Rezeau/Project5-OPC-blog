        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="succes">
                        <?= $this->session->show('addComment') ?>
                    </span>
                    <span class="errors">
                        <?= $this->session->show('error_addComment') ?>
                    </span>
                </div>
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="catch">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours <span class="catch">Développeur d'application PHP/Symfony.</span></p>
                <br>
                <p>Découvrez l'article <span class="catch"><?= $post->title ?></span>.</p>
            </div>
            <div class="header-content-img-blog">
            </div>
        </div>
        </header>
        <section class="post">
            <div class="post-card">
                <div class="post-card-header">
                    <h1><?= $post->title ?></h1>
                    <hr>
                    <h3>Par <span class="catch"><?= $post->author ?></span> le
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
                            <?= $format_modification_date ?>
                        </span>
                    </h3>
                </div>
                <div class="post-card-content">
                    <p><?= $post->short_content ?></p>
                    <hr>
                    <p><?= $post->content ?></p>
                </div>
                <div class="post-card-comment">
                    <div class="post-card-comment-title">
                        <h1>Commentaires</h1>
                        <hr>
                    </div>
                    <div class="post-card-comment-content">
                        <?php foreach ($comments as $comment) : ?>
                            <div class="post-card-comment-content-profil">
                                <img src="../public/profile_pictures/profile_picture<?= $comment->profile_picture ?>">
                                <h3>
                                    <span class="catch">
                                        <?= $comment->author ?>
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
                                        <?= $format_date ?>
                                    </span>
                                </h4>
                                <p><?= $comment->content ?></p>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                        <?php if(!empty($userId)) : ?>
                            <h2>Ajouter un commentaire</h2>
                            <div class="post-card-comment-content-add">
                                <div class="post-card-comment-content-add-profil">
                                    <img src="../public/profile_pictures/profile_picture<?= $user->profile_picture ?>">
                                    <h3>
                                        <span class="catch">
                                            <?= ucfirst($user->pseudo) ?>
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
