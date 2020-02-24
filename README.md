# Project5-OPC-blog
Creating a portfolio and a blog developed in PHP
This project was carried out as part of my training with 'Openclassrooms' on the course application developper PHP/Symfony.

The project of github : [ github.com/Magali-Rezeau/Project5-OPC-blog ]
Link to issues on Github : [ github.com/Magali-Rezeau/Project5-OPC-blog/issues ]
Link to pull-request on Github : [ github.com/Magali-Rezeau/Project5-OPC-blog/pulls ]

Set up guide

Install Apache/PHP/MySQL.
Download or clone the project.
I use Composer and I use the autoloader to composer, to load the classes automatically.
To install composer, go to [ getcomposer.org/download/ ] and follows the instructions. Use the file composer.json. After composer installed, lauch terminal command : composer dumpautoload -o in order to load all classes.
Import project5-blog.sql on your database and if it's necessary, config the PDO statement at Model/DAO/Database.php
I use the mail function of PHP in the contact form. If you want to use it, in Controller/PublicController.php, line 43, change email adress.
I use the css pre processor SASS to compress and prefixet. To install SASS, use npm and in command line, enter : npm install sass and for autoprefixer, enter : npm install autoprefixer POSTCSS POSTCSS-CLI. Use the file : package.json. To lauch SASS, in command line, enter : npm run sass. To lauch Autoprefixer, enter : npm run prefix.

Test 
To test user accounts, enter :
    - for administrator : pseudo = magali password = admin
    - for editor : pseudo = marie password = editor
    - for member with a personal profile picture: pseudo = vincent password = vincent
    - for member with a default profile picture : pseudo = eva password = eva
