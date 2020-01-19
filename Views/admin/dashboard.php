<div class="header-content">
    <div class="header-content-text">
        <h1>Bienvenue,</h1>
        <p>Je suis <span class="font">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours Développeur d'application PHP/Symfony et cette page permet <span class="font">d' administrer les articles du blog.</span></p>
    </div>
    <div class="header-content-img-admin">
    </div>
</div>
</header>
    <section class="dashboard">
        <div class="dashboard-post-title">
            <h1>Administration des articles</h1>
        </div>
        <div class="dashboard-btn-addPost">
            <button class="btn"><a href="../public/index.php?page=addPost">Ajouter un article</a></button>
        </div>
        <table class="dashboard-post-table">
            <thead class="dashboard-post-table-head">
                <tr class="dashboard-post-table-head-row">
                    <td class="dashboard-post-table-head-cell">Id</td>
                    <td class="dashboard-post-table-head-cell">Auteur</td>
                    <td class="dashboard-post-table-head-cell">Titre</td>
                    <td class="dashboard-post-table-head-cell">Date de création</td>
                    <td class="dashboard-post-table-head-cell">Date de modification</td>
                    <td class="dashboard-post-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-post-table-body">
                <?php foreach ($posts as $post) : ?>
                    <tr class="dashboard-post-table-body-row">
                        <td class="dashboard-post-table-body-cell"><?= $post->id_post; ?> </td>
                        <td class="dashboard-post-table-body-cell"><?= $post->author; ?> </td>
                        <td class="dashboard-post-table-body-cell"><?= $post->title; ?></td>
                        <td class="dashboard-post-table-body-cell">
                            <?php 
                                $date = new \DateTime($post->create_date);
                                echo $date->format("d-m-Y"); 
                            ?>
                        </td>
                        <td class="dashboard-post-table-body-cell">
                            <?php
                                $modification_date = new \DateTime($post->modification_date);
                                echo $modification_date->format("d-m-Y");   
                            ?>
                        </td>
                        <td class="dashboard-post-table-body-cell"><button class="btn"><a href="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>">Modifier</a></button><button class="btn"><a href="../public/index.php?page=deletePost&id_post=<?= $post->id_post ?>">Supprimer</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="dashboard-comment-title">
            <h1>Administration des commentaires</h1>
        </div>
        <table class="dashboard-comment-table">
            <thead class="dashboard-comment-table-head">
                <tr class="dashboard-comment-table-head-row">
                    <td class="dashboard-comment-table-head-cell">Id article</td>
                    <td class="dashboard-comment-table-head-cell">Auteur</td>
                    <td class="dashboard-comment-table-head-cell">Date de création</td>
                    <td class="dashboard-comment-table-head-cell">Contenu</td>
                    <td class="dashboard-comment-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-comment-table-body">
            <?php foreach ($comments as $comment) : ?>
                    <tr class="dashboard-comment-table-body-row">
                        <td class="dashboard-comment-table-body-cell"><?= $comment->post_id; ?></td>
                        <td class="dashboard-comment-table-body-cell"><?= $comment->author; ?></td>
                        <td class="dashboard-comment-table-body-cell">
                            <?php 
                                $date = new \DateTime($comment->create_date);
                                echo $date->format("d-m-Y"); 
                            ?>
                        </td>
                        <td class="dashboard-comment-table-body-cell"><?= $comment->content; ?></td>
                        <td class="dashboard-comment-table-body-cell"><button class="btn"><a href="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>">Valider</a></button><button class="btn"><a href="../public/index.php?page=deletePost&id_post=<?= $post->id_post ?>">Supprimer</a></td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
        <div class="dashboard-user-title">
            <h1>Administration des utilisateurs</h1>
        </div>
        <table class="dashboard-user-table">
            <thead class="dashboard-user-table-head">
                <tr class="dashboard-user-table-head-row">
                    <td class="dashboard-user-table-head-cell">Id</td>
                    <td class="dashboard-user-table-head-cell">Pseudo</td>
                    <td class="dashboard-user-table-head-cell">Email</td>
                    <td class="dashboard-user-table-head-cell">Role</td>
                    <td class="dashboard-user-table-head-cell">Date de création</td>
                    <td class="dashboard-user-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-user-table-body">
                    <tr class="dashboard-user-table-body-row">
                        <td class="dashboard-user-table-body-cell"></td>
                        <td class="dashboard-user-table-body-cell"></td>
                        <td class="dashboard-user-table-body-cell"></td>
                        <td class="dashboard-user-table-body-cell"></td>
                        <td class="dashboard-user-table-body-cell"></td>
                        <td class="dashboard-user-table-body-cell"><button class="btn"><a href="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>">Modifier</a></button><button class="btn"><a href="../public/index.php?page=deletePost&id_post=<?= $post->id_post ?>">Supprimer</a></td>
                    </tr>
            </tbody>
        </table>
    </section>
