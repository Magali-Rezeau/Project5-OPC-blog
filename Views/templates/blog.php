        <div class="header-content">
            <div class="header-content-text">
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="catch">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours <span class="catch">Développeur d'application PHP/Symfony</span> et cette page est un <span class="catch">blog</span> développé en php.</p>
            </div>
            <div class="header-content-img-blog">
            </div>
        </div>
    </header>
    <section class="blog">
        <div class="blog-card">
            <?php foreach($posts as $post) : ?>
                <?php 
                   
                    $author = isset($post->author)?htmlspecialchars($post->author):'';
                ?>
                <div class="blog-card-content">
                    <h2>
                        <?php $title = isset($post->title)?htmlspecialchars($post->title):''; ?>
                        <?= $title ?>
                    </h2>
                    <h4>Par 
                        <span class="catch">
                            <?php $author = isset($post->author)?htmlspecialchars($post->author):''; ?> 
                            <?= $author ?>
                        </span> le 
                        <span class="catch">
                            <?php 
                                $date = new \DateTime($post->create_date); 
                                $format_date = $date->format("d-m-Y"); 
                            ?>
                            <?= htmlspecialchars($format_date) ?>
                            
                        </span>
                        <br>Modifié le 
                        <span class="catch">
                            <?php 
                                $modification_date = new \DateTime($post->modification_date);
                                $format_modification_date = $modification_date->format("d-m-Y"); 
                            ?>
                            <?= htmlspecialchars($format_modification_date) ?>
                        </span>
                    </h4>
                    <hr>
                    <p>
                        <?php 
                            $shortContent = isset($post->short_content)?htmlspecialchars($post->short_content):'';
                        ?>
                        <?= 
                            $shortContent 
                        ?>
                    </p>
                    <button class="btn"><a href="<?= $post->getUrl(); ?>" >Lire la suite</a></button>
                </div> 
            <?php endforeach; ?>
        </div>
    </section>
    