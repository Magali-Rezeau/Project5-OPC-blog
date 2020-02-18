        <div class="header-content">
            <div class="header-content-text">
                <div class="header-content-text-message">
                    <span class="succes">
                        <?= $this->session->show('emailSent') ?>
                    </span>
                    <span class="errors">
                        <?= $this->session->show('error_emailSent') ?>
                    </span>
                </div>
                <h1>Bienvenue,</h1>
                <p>Je suis <span class="catch">Magali Rézeau</span> en formation chez Openclassrooms sur le parcours <span class="catch">Développeur d'application</span> PHP/Symfony et ce site est un <span class="catch">portfolio</span> et un <span class="catch">blog</span> développé en php.</p>
                <button class="btn"><a href="../public/index.php?page=blog">Blog</a></button>
            </div>
            <div class="header-content-img">
            </div>
        </div>
    </header>
    <section class="portfolio">
        <div class="portfolio-title">
            <h1>Portfolio</h1>
        </div>
        <div class="portfolio-content">
            <div class="portfolio-content-p1">
                <figure>
                    <figcaption>
                        <h2>John Doe</h2>
                        <h3>Création d'un site web pour un musicien</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p2">
                <figure>
                    <figcaption>
                        <h2>Chalets et caviar</h2>
                        <h3>Intégration d'un thème Wordpress pour un client</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p3">
                <figure>
                    <figcaption>
                        <h2>Les films de plein air</h2>
                        <h3>Analyse des besoins d'un client</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p4">
                <figure>
                    <figcaption>
                        <h2>Express food</h2>
                        <h3>Modélisation des besoins d'une application</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p5">
                <figure>
                    <figcaption>
                        <h2>Blog</h2>
                        <h3>Création d'un blog en php</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p6">
                <figure>
                    <figcaption>
                        <h2>Snowtricks</h2>
                        <h3>Création d'un site communautaire avec Symfony</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
            <div class="portfolio-content-p7">
                <figure>
                    <figcaption>
                        <h2>Bilemo</h2>
                        <h3>Développement d'une API REST avec symfony</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>

            </div>
            <div class="portfolio-content-p8">
                <figure>
                    <figcaption>
                        <h2>TodoList</h2>
                        <h3>Amélioration d'une application existante</h3>
                    </figcaption>
                    <div class="img"></div>
                </figure>
            </div>
        </div>
    </section>
    <section class="cv">
        <button class="btn"><a href="../public/pdf/CV-MR.pdf" target="_blank">Mon cv</a></button>
    </section>
    <section id="contact" class="contact">
        <div class="contact-content">
            <div class="contact-content-img"></div>
            <div class="contact-content-form">
                <h1>Contact</h1>
                <form action="../public/index.php?page=home" method="post" id="contact-form" name="contact-form" class="contact-form">
                    <span class="errors">
                        <?= isset($errors['lastname']) ? $errors['lastname'] : '' ?>
                    </span>
                    <div class="contact-form-item">
                        <?= $form->text('lastname', 'Votre nom', '', 'required') ?>
                    </div>
                    <span class="errors">
                        <?= isset($errors['firstname']) ? $errors['firstname'] : '' ?>
                    </span>
                    <div class="contact-form-item">
                        <?= $form->text('firstname', 'Votre prénom', '', 'required') ?>
                    </div>
                    <span class="errors">
                        <?= isset($errors['email']) ? $errors['email'] : '' ?>
                    </span>
                    <div class="contact-form-item">
                        <?= $form->email('email', 'Votre email', '', 'required') ?>
                    </div>
                    <span class="errors">
                        <?= isset($errors['message']) ? $errors['message'] : '' ?>
                    </span>
                    <div class="contact-form-item">
                        <?= $form->textarea('message', 'Votre message', '', 'required') ?>
                    </div>
                    <div class="contact-form-item">
                        <?= $form->submit('submit', 'Envoyer') ?>
                    </div> 
                </form>
            </div>
        </div>
    </section>
