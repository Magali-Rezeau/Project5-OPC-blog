# Project5-OPC-blog
Creating a portfolio and a blog developed in PHP
This project was carried out as part of my training with 'Openclassrooms' on the course application developper PHP/Symfony. The blog had to be developed in object oriented programming and adopt an MVC architecture.

# Set up guide
1. Install Apache/PHP/MySQL.
2. Download or clone the project.
3. I use Composer and I use the autoloader to composer, to load the classes automatically.
To install composer, go to getcomposer.org/download/ and follows the instructions. Use the file composer.json. After composer installed, lauch terminal command : composer dumpautoload -o in order to load all classes.
4. Import project5-blog.sql on your database and if it's necessary, config the PDO statement at Model/DAO/Database.php
5. I use the mail function of PHP in the contact form. If you want to use it, in Controller/PublicController.php, line 43, change email adress.
6. I use the css pre processor SASS to compress and prefixet. To install SASS, use npm and in command line, enter : npm install sass and for autoprefixer, enter : npm install autoprefixer POSTCSS POSTCSS-CLI. Use the file : package.json. To lauch SASS, in command line, enter : npm run sass. To lauch Autoprefixer, enter : npm run prefix.

# Test 
To test user accounts, enter :
1. for administrator : pseudo = magali password = admin
2. for editor : pseudo = marie password = editor
3. for member with a personal profile picture: pseudo = vincent password = vincent
4. for member with a default profile picture : pseudo = eva password = eva
