-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 15, 2020 at 01:15 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project5-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `create_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `content`, `create_date`, `user_id`, `post_id`) VALUES
(1, 'It is actually in fact a warning, that the spot belongs to Chuck Norris and that you will be handicapped if you park there.', '2019-12-18 17:22:00', 2, 1),
(2, 'Chuck Norris is the reason you turn a light on when you enter a room.', '2019-12-17 15:22:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  `short_content` text NOT NULL,
  `create_date` date NOT NULL,
  `modification_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `content`, `short_content`, `create_date`, `modification_date`, `user_id`) VALUES
(1, 'Chuck Norris Ipsum', 'When Chuck Norris sends in his taxes, he sends blank forms and includes only a picture of himself, crouched and ready to attack. Chuck Norris has not had to pay taxes, ever Chuck Norris is the only man to ever defeat a brick wall in a game of tennis. Chuck Norris looks gift horses in the mouth. Chuck Norris doesn’t wear a watch. HE decides what time it is, The Great Wall of China was originally created to keep Chuck Norris out. It failed miserably.\r\n\r\nChuck Norris will attain statehood in 2009. His state flower will be the Magnolia Chuck Norris has two speeds. Walk, and Kill Chuck Norris can win a game of Connect Four in only three moves If you spell Chuck Norris in Scrabble, you win. Forever. The leading causes of death in the United States are: 1. Heart Disease 2. Chuck Norris 3. Cancer.\r\n\r\nThe chief export of Chuck Norris is Pain Chuck Norris is the reason you turn a light on when you enter a room. There is no theory of evolution. Just a list of animals Chuck Norris allows to live Chuck Norris received an electric shock, the result was Tron Chuck Norris is the reason why Waldo is hiding Police label anyone attacking Chuck Norris as a Code 45-11… a suicide, Fool me once, shame on you. Fool Chuck Norris once and he will roundhouse you in the face.\r\n\r\nThere is no chin behind Chuck Norris’ beard. There is only another fist. If you spell Chuck Norris in Scrabble, you win. Forever If you ask Chuck Norris what time it is, he always says, “Two seconds ’til.” After you ask, “Two seconds ’til what?” he roundhouse kicks you in the face, Chuck Norris can speak a language inside of another language, A Handicapped parking sign does not signify that this spot is for handicapped people. It is actually in fact a warning, that the spot belongs to Chuck Norris and that you will be handicapped if you park there.', 'Chuck Norris can slam a revolving door. Chuck Norris can have his cake and eat it, too. Chuck Norris is currently suing NBC, claiming Law and Order are trademarked names for his left and right legs...', '2020-01-01', '2020-01-02', 1),
(2, 'Coffee Ipsum', 'Java chicory, black doppio and roast cream mocha turkish strong. Blue mountain doppio black, chicory, sugar medium, single shot a wings blue mountain turkish. Viennese et, cinnamon, turkish lungo qui cappuccino kopi-luwak. Black, dripper, to go medium espresso lungo in, and plunger pot latte sweet redeye. Half and half, galão, single shot wings beans bar that con panna macchiato dark foam galão.\r\n\r\nTo go, est ut affogato, to go crema percolator steamed whipped latte. Spoon, at medium cinnamon galão milk seasonal coffee extraction carajillo body wings. Doppio acerbic con panna plunger pot espresso breve, arabica cream roast galão decaffeinated. To go irish shop affogato, aromatic skinny steamed foam white. Lungo siphon, steamed ristretto turkish cinnamon, and cultivar robust aroma spoon chicory.\r\n\r\nBarista et bar aftertaste, brewed variety filter turkish breve organic. Mug french press rich doppio barista redeye cream. Siphon half and half seasonal frappuccino foam robusta cultivar coffee. So froth, aftertaste bar, saucer sugar single shot caramelization aromatic. Espresso, saucer, breve café au lait, id cultivar pumpkin spice doppio viennese frappuccino doppio.\r\n\r\nCup white, sit percolator froth turkish, crema wings at carajillo mazagran. Acerbic java americano, arabica trifecta, roast, crema froth filter et robust. Est, turkish french press percolator cream lungo milk acerbic. Latte cup, espresso carajillo cinnamon breve frappuccino. Siphon est, so mug cappuccino fair trade sweet.\r\n\r\nTrifecta, organic, irish grinder foam roast cup extra. Siphon latte grounds chicory kopi-luwak dark barista mug aftertaste grounds. Acerbic brewed at, mug cultivar mocha aftertaste shop. Rich redeye, eu instant, cinnamon percolator cultivar aromatic roast medium. French press aroma beans flavour organic blue mountain as flavour.\r\n\r\nFair trade siphon crema extra, viennese qui, foam viennese siphon est so caramelization. Carajillo sit ut extra chicory aged instant crema chicory. Et, dark a cup, cortado, siphon at arabica flavour macchiato. Cream, at, acerbic redeye iced americano coffee white. To go et, steamed a café au lait, single origin aftertaste frappuccino blue mountain whipped.', 'Java chicory, black doppio and roast cream mocha turkish strong. Blue mountain doppio black, chicory, sugar medium, single shot a wings blue mountain turkish...', '2020-01-03', '2020-01-03', 2),
(3, 'Batman Ipsum', 'My dad got shot a couple of years later for a gambling debt. Oh I remember that one just fine. Not a lot of people know what it feels like to be angry in your bones. I mean they understand. The fosters parents. Everybody understands, for a while. Then they want the angry little kid to do something he knows he can’t do, move on. After a while they stop understanding. They send the angry kid to a boy’s home, I figured it out too late. Yeah I learned to hide the anger, and practice smiling in the mirror. It’s like putting on a mask. So you showed up this one day, in a cool car, pretty girl on your arm. We were so excited! Bruce Wayne, a billionaire orphan? We used to make up stories about you man, legends and you know with the other kids, that’s all it was, just stories, but right when I saw you, I knew who you really were. I’d seen that look on your face before. It’s the same one I taught myself. I don’t why you took the fault for Dent’s murder but I’m still a believer in the Batman. Even if you’re not…\r\n\r\nEvery man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.\r\n\r\nBut we’ve met before. That was a long time ago, I was a kid at St. Swithin’s, It used to be funded by the Wayne Foundation. It’s an orphanage. My mum died when I was small, it was a car accident. I don’t remember it. My dad got shot a couple of years later for a gambling debt. Oh I remember that one just fine. Not a lot of people know what it feels like to be angry in your bones. I mean they understand. The fosters parents. Everybody understands, for a while. Then they want the angry little kid to do something he knows he can’t do, move on. After a while they stop understanding. They send the angry kid to a boy’s home, I figured it out too late. Yeah I learned to hide the anger, and practice smiling in the mirror. It’s like putting on a mask. So you showed up this one day, in a cool car, pretty girl on your arm. We were so excited! Bruce Wayne, a billionaire orphan? We used to make up stories about you man, legends and you know with the other kids, that’s all it was, just stories, but right when I saw you, I knew who you really were. I’d seen that look on your face before. It’s the same one I taught myself. I don’t why you took the fault for Dent’s murder but I’m still a believer in the Batman. Even if you’re not…\r\n\r\nEvery man who has lotted here over the centuries, has looked up to the light and imagined climbing to freedom. So easy, so simple! And like shipwrecked men turning to seawater foregoing uncontrollable thirst, many have died trying. And then here there can be no true despair without hope. So as I terrorize Gotham, I will feed its people hope to poison their souls. I will let them believe that they can survive so that you can watch them climbing over each other to stay in the sun. You can watch me torture an entire city. And then when you’ve truly understood the depth of your failure, we will fulfill Ra’s Al Ghul’s destiny. We will destroy Gotham. And then, when that is done, and Gotham is… ashes Then you have my permission to die.\r\n\r\nBut we’ve met before. That was a long time ago, I was a kid at St. Swithin’s, It used to be funded by the Wayne Foundation. It’s an orphanage. My mum died when I was small, it was a car accident. I don’t remember it. My dad got shot a couple of years later for a gambling debt. Oh I remember that one just fine. Not a lot of people know what it feels like to be angry in your bones. I mean they understand. The fosters parents. Everybody understands, for a while. Then they want the angry little kid to do something he knows he can’t do, move on. After a while they stop understanding. They send the angry kid to a boy’s home, I figured it out too late. Yeah I learned to hide the anger, and practice smiling in the mirror. It’s like putting on a mask. So you showed up this one day, in a cool car, pretty girl on your arm. We were so excited! Bruce Wayne, a billionaire orphan? We used to make up stories about you man, legends and you know with the other kids, that’s all it was, just stories, but right when I saw you, I knew who you really were. I’d seen that look on your face before. It’s the same one I taught myself. I don’t why you took the fault for Dent’s murder but I’m still a believer in the Batman. Even if you’re not…', 'But we’ve met before. That was a long time ago, I was a kid at St. Swithin’s, It used to be funded by the Wayne Foundation. It’s an orphanage. My mum died when I was small, it was a car accident. I don’t remember it...', '2020-01-03', '2020-01-03', 1),
(4, 'Cupcake Ipsum', ' Jujubes chocolate cake croissant powder marshmallow lemon drops jujubes gingerbread gingerbread... Gummi bears macaroon ice cream jujubes gingerbread sesame snaps sweet tootsie roll. Toffee candy donut chupa chups sugar plum liquorice muffin tiramisu. Jujubes icing croissant sweet gummi bears jelly beans gummies liquorice. Sweet roll fruitcake candy gummies marshmallow. Sweet roll topping pastry oat cake chocolate cake. Oat cake jelly beans marshmallow jelly-o. Bear claw chocolate carrot cake chocolate cake marzipan pastry chocolate danish gummies. Sweet roll topping marshmallow.\r\n\r\nWafer icing cotton candy oat cake. Toffee muffin jelly jelly beans toffee. Tart topping tiramisu tiramisu jelly. Danish chocolate chupa chups ice cream tootsie roll topping chocolate. Sesame snaps jelly topping tiramisu gummi bears. Cheesecake marzipan bonbon lemon drops. Wafer macaroon donut macaroon pudding pudding cupcake. Pie candy icing pastry fruitcake biscuit jelly beans chupa chups jelly. Powder cookie liquorice danish chocolate. Soufflé lemon drops jelly beans tart wafer. Bear claw tiramisu muffin jelly-o donut cake. Cupcake macaroon pudding halvah pudding tootsie roll cupcake. Cake cake jelly tart biscuit biscuit wafer icing. Macaroon cupcake cake cupcake tart brownie.\r\n\r\nCupcake brownie halvah gingerbread gingerbread brownie danish muffin. Caramels gummi bears pie. Sugar plum sweet roll chocolate gingerbread jelly halvah muffin. Marzipan macaroon bonbon gummies cake gummies lemon drops. Soufflé bonbon cake. Sweet roll marzipan cake tootsie roll sweet. Sweet tart marzipan candy carrot cake topping. Pudding pudding gummies bonbon icing chupa chups. Icing jelly-o dragée. Cupcake soufflé cheesecake jelly beans. Sesame snaps gummi bears bonbon pie tiramisu. Cupcake carrot cake danish. Biscuit gummi bears croissant jujubes.\r\n\r\nCheesecake cotton candy topping cheesecake icing. Ice cream biscuit marshmallow cake cake. Soufflé jelly-o apple pie tootsie roll. Pudding jelly-o sugar plum gummies powder. Gummi bears cookie candy lemon drops chocolate cake lollipop gummies donut. Chocolate bar cookie lemon drops donut. Macaroon marshmallow sweet roll chupa chups jelly-o candy canes jelly donut. Marshmallow carrot cake lollipop. Icing ice cream pie marshmallow gummi bears powder sugar plum sweet roll gummies. Wafer jujubes tart jelly. Gummies halvah powder ice cream cupcake toffee biscuit jelly-o sweet. Marzipan gingerbread gummi bears biscuit. Bear claw topping apple pie. Carrot cake chupa chups caramels carrot cake cheesecake.\r\n\r\nApple pie pudding danish halvah. Soufflé toffee pastry. Gummies caramels sweet gingerbread. Toffee fruitcake halvah. Tart jelly sugar plum chocolate bar croissant cheesecake cake. Tart cookie dragée chocolate bar tiramisu cookie gummies gummi bears jelly-o. Carrot cake cookie pastry chupa chups jelly-o chocolate bar. Oat cake chocolate bar sweet roll chocolate bar chocolate cake bonbon sweet roll tootsie roll. Carrot cake halvah sugar plum gingerbread jelly beans brownie. Chocolate bar chupa chups carrot cake bonbon fruitcake tootsie roll cake halvah caramels. Muffin gummi bears candy cake jelly beans carrot cake toffee jelly beans. Bonbon halvah powder chocolate bar candy canes pastry pudding. Tiramisu sesame snaps jelly beans.', 'Jelly-o gummi bears wafer. Oat cake cupcake bonbon toffee. Jelly tiramisu gummi bears jelly beans dragée dragée cupcake fruitcake. Jelly beans pastry toffee halvah caramels...', '2020-01-10', '2020-01-14', 1),
(5, 'Dalai Lama Ipsum', 'Rich or poor, educated or uneducated, belonging to one nation or another, to one religion or another, adhering to this ideology or that, ultimately each of us is just a human being like everyone else: we all desire happiness and do not want suffering.Furthermore, each of us has an equal right to pursue these goals.\r\n\r\nLet us cultivate love and compassion, both of which give life true meaning. This is the religion I preach. It is simple. Its temple is the heart. Its teaching is love and compassion. Its moral values are loving and respecting others, whoever they may be. Whether one is a lay person or a monastic, we have no other option if we wish to survive in this world.\r\n\r\nWe have bigger houses but smaller families. More conveniences, but less time. We have more degrees, but less sense. More knowledge, but less judgment. More experts, but more problems. More medicines, but less healthiness. We’ve been all the way to the moon and back, but have trouble crossing the street to meet the new neighbor. We build more computers to hold more information to produce more copies than ever but have less communication. We have become long on quantity, but short on quality. These are times of fast foods but slow digestion; Tall man but short character; Steep profits but shallow relationships. It’s a time when there is much in the window, but nothing in the room.\r\n\r\nThe goal is to cultivate in our hearts the concern a dedicated mother feels for her child, and then focus it on more and more people and living beings. This is a heartfelt, powerful love. Such feelings give us a true understanding of human rights, that is not grounded just in legal terms, but rooted deeply in the heart.\r\n\r\nEveryone can understand from natural experience and common sense that affection is crucial from the day of birth; it is the basis of life. The very survival of our body requires the affection of others, to whom we also respond with affection. Though mixed with attachment, this affection is not based on physical or sexual attraction, so it can be extended to all living beings without bias.', 'Whether we like it or not, we have all been born on this earth as part of one great human family...', '2020-01-12', '2020-01-12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `role_users`
--

CREATE TABLE `role_users` (
  `id_role_user` int(11) NOT NULL,
  `entitled` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_users`
--

INSERT INTO `role_users` (`id_role_user`, `entitled`) VALUES
(1, 'ADMIN'),
(2, 'EDITOR'),
(3, 'MEMBER');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `create_date` date NOT NULL,
  `profile_picture` varchar(45) DEFAULT NULL,
  `role_users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `password`, `create_date`, `profile_picture`, `role_users_id`) VALUES
(1, 'Magali', 'magalirezeau@gmail.com', 'root', '2019-12-12', NULL, 1),
(2, 'Marie', 'marie@gmail.com', 'member', '2019-12-15', NULL, 2),
(3, 'mag', 'mag@gmail.com', 'dgsdg', '2020-01-14', NULL, 1),
(4, 'mag', 'mag@gmail.com', 'c2e67bf406bd44606019f966f70c5f70e69cc456', '2020-01-14', NULL, 1),
(5, 'mag', 'mag@outlook.com', '1f71e0f4ac9b47cd93bf269e4017abaab9d3bd63', '2020-01-14', NULL, 1),
(6, 'mag', 'mag@outlook.com', '1f71e0f4ac9b47cd93bf269e4017abaab9d3bd63', '2020-01-14', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `fk_comments_users_idx` (`user_id`),
  ADD KEY `fk_comments_posts_idx` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_posts_users_idx` (`user_id`);

--
-- Indexes for table `role_users`
--
ALTER TABLE `role_users`
  ADD PRIMARY KEY (`id_role_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_users_role_users_idx` (`role_users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `role_users`
--
ALTER TABLE `role_users`
  MODIFY `id_role_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_posts` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id_post`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_posts_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_role_users` FOREIGN KEY (`role_users_id`) REFERENCES `role_users` (`id_role_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
