        <div class="header-content">
            <div class="header-content-text">
                <h1>Dashboard de l'administrateur</h1>
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
                    <td class="dashboard-post-table-head-cell dashboard-post-table-head-cell-display">Id</td>
                    <td class="dashboard-post-table-head-cell">Auteur</td>
                    <td class="dashboard-post-table-head-cell">Titre</td>
                    <td class="dashboard-post-table-head-cell dashboard-post-table-head-cell-display">Date de création</td>
                    <td class="dashboard-post-table-head-cell dashboard-post-table-head-cell-display">Date de modification</td>
                    <td class="dashboard-post-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-post-table-body">
                <?php foreach ($posts as $post) : ?>
                    <tr class="dashboard-post-table-body-row">
                        <td class="dashboard-post-table-body-cell dashboard-post-table-body-cell-display"><?= $post->id_post; ?> </td>
                        <td class="dashboard-post-table-body-cell"><?= $post->author; ?> </td>
                        <td class="dashboard-post-table-body-cell"><?= $post->title; ?></td>
                        <td class="dashboard-post-table-body-cell dashboard-post-table-body-cell-display">
                            <?php 
                                $date = new \DateTime($post->create_date);
                                $format_date = $date->format("d-m-Y"); 
                            ?>
                            <?= $format_date ?>
                        </td>
                        <td class="dashboard-post-table-body-cell dashboard-post-table-body-cell-display">
                            <?php
                                $modification_date = new \DateTime($post->modification_date);
                                $format_modification_date = $modification_date->format("d-m-Y");
                            ?>
                            <?= $format_modification_date ?>   
                        </td>
                        <td class="dashboard-post-table-body-cell">
                            <button class="btn"><a href="../public/index.php?page=editPost&id_post=<?= $post->id_post ?>">Modifier</a></button>
                            <button class="btn"><a href="../public/index.php?page=deletePost&id_post=<?= $post->id_post ?>">Supprimer</a></button>
                        </td>
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
                    <td class="dashboard-comment-table-head-cell dashboard-comment-table-head-cell-display">Id article</td>
                    <td class="dashboard-comment-table-head-cell">Auteur</td>
                    <td class="dashboard-comment-table-head-cell dashboard-comment-table-head-cell-display">Date de création</td>
                    <td class="dashboard-comment-table-head-cell">Contenu</td>
                    <td class="dashboard-comment-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-comment-table-body">
                <?php foreach ($comments as $comment) : ?>
                    <tr class="dashboard-comment-table-body-row">
                        <td class="dashboard-comment-table-body-cell dashboard-comment-table-body-cell-display"><?= $comment->post_id; ?></td>
                        <td class="dashboard-comment-table-body-cell"><?= $comment->author; ?></td>
                        <td class="dashboard-comment-table-body-cell dashboard-comment-table-body-cell-display">
                            <?php 
                                $date = new \DateTime($comment->create_date);
                                $format_date = $date->format("d-m-Y");
                            ?>
                            <?= $format_date ?>
                        </td>
                        <td class="dashboard-comment-table-body-cell"><?= $comment->content; ?></td>
                        <td class="dashboard-comment-table-body-cell">
                            <button class="btn" ><a href="../public/index.php?page=validateComment&id_comment=<?= $comment->id_comment ?>">Valider</a></button>
                            <button class="btn"><a href="../public/index.php?page=deleteComment&id_comment=<?= $comment->id_comment ?>">Supprimer</a></button>
                        </td>
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
                    <td class="dashboard-user-table-head-cell dashboard-user-table-body-cell-display">Id</td>
                    <td class="dashboard-user-table-head-cell">Pseudo</td>
                    <td class="dashboard-user-table-head-cell">Email</td>
                    <td class="dashboard-user-table-head-cell dashboard-user-table-body-cell-display">Role</td>
                    <td class="dashboard-user-table-head-cell dashboard-user-table-body-cell-display">Date de création</td>
                    <td class="dashboard-user-table-head-cell">Actions</td>
                </tr>
            </thead>
            <tbody class="dashboard-user-table-body">
                <?php foreach($users as $user) : ?>
                    <tr class="dashboard-user-table-body-row">
                        <td class="dashboard-user-table-body-cell dashboard-user-table-body-cell-display"><?= $user->id_user;?></td>
                        <td class="dashboard-user-table-body-cell display"><?= $user->pseudo;?></td>
                        <td class="dashboard-user-table-body-cell"><?= $user->email;?></td>
                        <td class="dashboard-user-table-body-cell dashboard-user-table-body-cell-display"><?= $user->role;?></td>
                        <td class="dashboard-user-table-body-cell dashboard-user-table-body-cell-display">
                            <?php 
                                $date = new \DateTime($user->create_date); 
                                $format_date = $date->format("d-m-Y");
                            ?>
                            <?= $format_date ?>
                        </td>
                        <td class="dashboard-user-table-body-cell">
                           
                            <button class="btn"><a href="../public/index.php?page=deleteUser&id_user=<?= $user->id_user ?>">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </section>
