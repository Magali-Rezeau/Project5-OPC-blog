<div class="header-content">
        <div class="header-content-text">
            <h1>Bienvenue <?= ucfirst($user->pseudo) ?>,</h1>
            <br>
            <p>Ci-dessous, vous trouverez toutes les informations relatives à votre <span class="catch">profil</span>.</p>
            <br>
            <p>Se déconnecter ?</p>
            <button class="btn"><a href="../public/index.php?page=signup">Se déconnecter</a></button>                
        </div>
        <div class="header-content-img-profil">
        </div>
    </div>
</header>

<section id="profil" class="profil">
    <div class="profil-content">
        <table class="profil-content-table">
            <thead class="profil-content-table-head">
                <tr class="profil-content-table-head-row">
                    <td class="profil-content-table-head-cell">Pseudo</td>
                    <td class="profil-content-table-head-cell">Email</td>
                    <td class="profil-content-table-head-cell">Role</td>
                    <td class="profil-content-table-head-cell">Date de création</td>
                </tr>
            </thead>
            <tbody class="profil-content-table-body">
                <tr class="profil-content-table-body-row">
                    <td class="profil-content-table-body-cell"><?= $user->pseudo;?></td>
                    <td class="profil-content-table-body-cell"><?= $user->email;?></td>
                    <td class="profil-content-table-body-cell"><?= $user->role;?></td>
                    <td class="profil-content-table-body-cell">
                        <?php 
                            $date = new \DateTime($user->create_date); 
                            echo $date->format("d-m-Y"); 
                        ?>
                    </td>  
                </tr>      
            </tbody>
        </table>
        <div class="profil-content-redir">
            <button class="btn"><a href="../public/index.php?page=home">Accueil</a></button>
            <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
        </div>
    </div>
</section>