        <div class="header-content">
            <div class="header-content-text">
                <h1>Dashboard de l'éditeur</h1>
            </div>
            <div class="header-content-img-admin">
            </div>
        </div>
    </header>
    <section class="dashboard">
        <div class="dashboard-post-title">
            <h1>Administration des articles</h1>
            <?php var_dump($_SESSION); ?>
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
    </section>
