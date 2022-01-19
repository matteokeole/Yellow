-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 19, 2022 at 02:00 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yellow`
--

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `content_product_quantity` int(11) NOT NULL,
  `basket_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_admin` int(11) NOT NULL,
  `customer_first_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_last_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_password` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_post_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_city` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220119113508', '2022-01-19 13:38:10', 405),
('DoctrineMigrations\\Version20220119113725', '2022-01-19 13:38:10', 35),
('DoctrineMigrations\\Version20220119114846', '2022-01-19 13:38:10', 28),
('DoctrineMigrations\\Version20220119115225', '2022-01-19 13:38:10', 208),
('DoctrineMigrations\\Version20220119115321', '2022-01-19 13:38:10', 149),
('DoctrineMigrations\\Version20220119115620', '2022-01-19 13:38:11', 170),
('DoctrineMigrations\\Version20220119133746', '2022-01-19 13:38:11', 156);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `basket_id` int(11) NOT NULL,
  `order_content` json NOT NULL,
  `order_date` date NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `order_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_author` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_date` int(11) NOT NULL,
  `product_desc` longtext COLLATE utf8mb4_unicode_ci,
  `product_cover` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_price` decimal(3,2) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_category` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_author`, `product_date`, `product_desc`, `product_cover`, `product_price`, `product_stock`, `product_category`) VALUES
(1, 'One Piece', 'Eiichirō Oda', 1997, 'Nous sommes à l’ère des pirates ! Luffy, un garçon espiègle, rêve de devenir le roi des pirates en trouvant le «One Piece», un fabuleux et mystérieux trésor. Mais, par mégarde, Luffy a avalé un jour un «fruit magique du démon» qui l’a transformé en homme caoutchouc. Depuis, il est capable de contorsionner son corps élastique dans tous les sens, mais il a perdu la faculté de nager, le comble pour un pirate ! Au fil d’aventures toujours plus rocambolesques et de rencontres fortuites, Luffy va progressivement composer son équipage et multiplier les amitiés avec les peuples qu’il découvre, tout en affrontant de redoutables ennemis.', 'onepiece', '6.90', 47, 'shonen'),
(2, 'Dragon Ball', 'Akira Toriyama', 1985, 'Dans un monde fantastique semblable à la Terre et peuplé de créatures plus étranges les unes que les autres, un petit garçon à la force herculéenne et doté d’une queue de singe croise un jour la route d’une jeune fille. Celle-ci s’est lancée à la recherche de sept mystérieuses boules de cristal. Car il est dit que quiconque les réunira pourra appeler le dragon sacré et exaucer son voeu le plus cher. En chemin, ce duo d’aventuriers peu commun se heurte à un cochon transformiste usant de ses dons pour kidnapper les jeunes filles d’un village, puis à un vagabond solitaire adepte des arts martiaux que la simple vue d’une jeune femme suffit à tétaniser sur place. Ce n’est que le début d’une grande aventure riche en péripéties, en humour et en combats extraordinaires…', 'dragonball', '6.90', 43, 'shonen'),
(3, 'Naruto', 'Masashi Kishimoto', 1999, 'Naruto est un garçon un peu spécial. Solitaire au caractère fougueux, il n\'est pas des plus appréciés dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un \"maître Hokage\", la plus haute distinction dans l\'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs mais cela ne sera pas de tout repos ... Suivez l\'éternel farceur dans sa quête du secret de sa naissance et de la conquête des fruits de son ambition !', 'naruto', '3.00', 39, 'shonen'),
(4, 'Fullmetal Alchemist', 'Hiromu Arakawa', 2001, 'En voulant ressusciter leur mère, Edward et Alphonse Elric vont utiliser une technique interdite relevant du domaine de l\'alchimie : la transmutation humaine. Seulement, l\'expérience va mal tourner : Edward perd un bras et une jambe et Alphonse son corps, son esprit se retrouvant prisonnier d\'une armure. Devenu un alchimiste d\'Etat, Edward, surnommé \"fullmetal alchimiste\", se lance, avec l\'aide de son frère, à la recherche de la pierre philosophale, leur seule chance de retrouver leur état initial. Ils commencent à enquêter sur un étrange homme, \"le fondateur\" qui passe pour un faiseur de miracles...', 'fullmetalalchemist', '6.60', 36, 'shonen'),
(5, 'Berserk', 'Kentarō Miura', 1989, 'Dans un monde médiéval et fantastique, erre un guerrier solitaire nommé Guts, décidé à être seul maître de son destin. Autrefois contraint par un pari perdu à rejoindre les Faucons, une troupe de mercenaires dirigés par Griffith, Guts fut acteur de nombreux combats sanglants et témoin de sombres intrigues politiques. Mais il réalisa soudain que la fatalité n\'existe pas et qu\'il pouvait reprendre sa liberté s\'il le désirait vraiment...', 'berserk', '6.90', 31, 'seinen'),
(6, 'Parasite', 'Hitoshi Iwaaki', 1988, 'De mystérieuses sphères abritant des parasites se répandent un peu partout sur Terre. Rapidement, les entités prennent possession du cerveau de certains habitants. Nul ne sait d\'où elles viennent, mais elles sont là pour débarrasser le monde de l\'espèce humaine. Shin\'ichi, jeune lycéen, est un « hôte » dont le cerveau a miraculeusement été épargné : Migy, son parasite, a pris possession de son bras droit ! Les deux êtres vont apprendre chacun l\'un de l\'autre. Alors que Shin\'ichi se découvre doté d\'incroyables facultés physiques, il prend aussi conscience de la menace qui plane sur ses proches et sur l\'humanité tout entière.', 'parasite', '6.90', 27, 'seinen'),
(7, 'Vinland Saga', 'Makoto Yukimura', 2005, 'Depuis qu\'Askeladd, un chef de guerre fourbe et sans honneur, a tué son père lorsqu\'il était enfant, Thorfinn le suit partout dans le but de se venger. Mais bien qu\'il soit devenu un guerrier redoutable, il ne parvient toujours pas à vaincre son ennemi. Au fil des ans, enchaînant missions périlleuses et combats afin d\'obtenir des duels contre l\'homme qu\'il hait plus que tout, le gentil Thorfinn est devenu froid et solitaire, prisonnier de son passé et incapable d\'aller de l\'avant. Jusqu\'à ce que la vie le force à regarder le monde différemment…', 'vinlandsaga', '7.65', 35, 'seinen'),
(8, 'Kingdom', 'Yasuhisa Hara', 2006, 'Dans la Chine de l\'époque des Royaumes Combattants qui va du Ve siècle av. J.-C. jusqu\'à l\'unification des royaumes chinois par la dynastie Qin en 221 av. J.-C), on suit le jeune Shin dans son chemin vers l\'accomplissement de son rêve : devenir un Grand Général. Shin est originaire de l\'état de Qin, en proie à de nombreux soubresauts aussi bien à l\'intérieur du royaume qu\'à l\'extérieur. À travers l\'histoire de Shin, on suit aussi notamment l\'histoire de Ei Sei, l\'homme qui sera par la suite connu sous le nom de Qin Shi Huang, unificateur de la Chine.', 'kingdom', '6.95', 24, 'seinen'),
(9, 'Nana', 'Ai Yazawa', 2000, 'La première est rêveuse, rigolote et sensible, mais « coeur d´artichaut », un brin capricieuse et loin d´être indépendante. La seconde est plus mature, déterminée, un peu mystérieuse mais peut être d´une froideur qui glace le dos. Toutes deux s´appellent « Nana », ont un attrait pour l´art et ont vécu en province. Toutes deux vont connaître l´Amour et décider de partir pour Tokyo.', 'nana', '6.99', 19, 'shojo'),
(10, 'Orange', 'Ichigo Takano', 2012, 'Un matin, alors qu\'elle se rend au lycée, Naho reçoit une drôle de lettre… une lettre du futur ! La jeune femme qu\'elle est devenue dix ans plus tard, rongée par de nombreux remords, souhaite aider celle qu\'elle était autrefois à ne pas faire les mêmes erreurs qu\'elle. Aussi, elle a décrit, dans un long courrier, les événements qui vont se dérouler dans la vie de Naho lors des prochains mois, lui indiquant même comment elle doit se comporter. Mais Naho, a bien du mal à y croire, à cette histoire… Et de toute façon, elle manque bien trop d\'assurance en elle pour suivre certaines directives indiquées dans ce curieux courrier. Pour le moment, la seule chose dont elle est sûre, c\'est que Kakeru, le nouvel élève de la classe, ne la laisse pas indifférent…', 'orange', '7.95', 26, 'shojo'),
(11, 'Sailor Moon', 'Naoko Takeuchi', 1991, 'Usagi est une jeune fille de 14 ans comme tant d\'autres : elle aime dormir, jouer aux jeux vidéo, elle pleure pour un oui ou pour un non et elle ne se passionne pas pour ses études. Mais un beau jour, elle croise le chemin de Luna, un chat doué de parole qui va la transformer en une jolie justicière : Sailor Moon ! La voilà investie de plusieurs missions : elle doit identifier ses alliées, retrouver le légendaire Cristal d\'Argent et protéger une certaine princesse... tout en luttant contre de mystérieux ennemis qui sont eux aussi à la recherche du fabuleux cristal aux pouvoirs fantastiques !', 'sailormoon', '6.95', 22, 'shojo'),
(12, 'Kids on the Slope', 'Yūki Kodama', 2007, 'À la fin des années 60, alors que le Japon occupé fait face à de grands changements sociaux, la musique venue des États-Unis va faire naître, entre deux adolescents que tout oppose, une amitié complexe. Kaoru vient tout juste d\'emménager en ville. D\'un naturel solitaire et studieux, il n\'a pas pour habitude de se mêler à ses camarades de classe. Et pourtant, sa rencontre avec le bagarreur Sentarô va radicalement changer sa vie…', 'kidsontheslope', '6.79', 31, 'josei'),
(13, 'Nodame Cantabile', 'Tomoko Ninomiya', 2001, 'Chiaki, élève surdoué du conservatoire, quitte le cours d’un professeur de piano réputé, ne supportant plus ses méthodes. Son rêve est de devenir chef d’orchestre, comme son idole, le célèbre Sevastiano Viera, qu’il a connu lorsqu’il vivait, enfant, en Europe.\r\nHélas, pour le moment, Chiaki ne peut en aucun cas envisager un retour sur le Vieux Continent du fait de ses phobies de l’avion... mais aussi du bateau... En somme, il est prisonnier du Japon. Il envisage alors d’arrêter la musique. C’est là qu’il va rencontrer Megumi Noda – « Nodame » –, sa voisine qui se révèle être une musicienne sans aucune rigueur mais au toucher particulièrement sensible, qualité qui ne laisse pas insensible Chiaki.', 'nodamecantabile', '6.95', 34, 'josei'),
(14, 'Blue', 'Kiriko Nananan', 1996, 'Le bleu, c\'est celui de la mer que Kayako vient contempler, après les cours. Un jour, la secrète Masami l\'y accompagne. L\'amitié se mue en amour, puis en souffrance, chacune ayant des aspirations et obligations différentes...', 'blue', '6.90', 39, 'josei'),
(15, 'Pokemon', 'Asada Miho', 1997, 'Nos jeunes héros sont prêts à tout pour devenir les meilleurs éleveurs de Pokémon de la planète. Pour cela, il faut en attraper le plus possible, les entrainer pour les livrer à des combats durant lesquels ils vont prendre du galon. Arrivés à un certain seuil de force, les Pokémon subissent ce que les initiés appellent une \"évolution\", se transformant en monstres beaucoup plus puissants.', 'pokemon', '9.90', 55, 'kodomo'),
(16, 'Doraemon', 'Fujiko Fujio', 1969, 'Nobita est un jeune garçon assez irresponsable, complètement gaffeur et maladroit. Il est, de plus, régulièrement grondé par sa mère et ses professeurs à cause des mauvais plans qu\'il imagine souvent.\r\nUn jour, pourtant, débarque dans sa vie un chat-robot venu du futur. Il se nomme DORAemon, porte toujours une clochette autour du coup et a la particularité d\'avoir des mains toutes rondes. DORAemon est en fait envoyé par le futur petit-fils de Nobita. Sa mission sur Terre : sauver Nobita de ses échecs successifs et donc sauver la famille de la déchéance. Il va donc devoir s\'atteler à faire évoluer Nobita dans le bon sens et, par là, infléchir le destin. Inutile de préciser que cela ne sera pas de tout repos…\r\nHeureusement que DORAemon ne perd jamais sa mine joviale et n\'est jamais à court ni de gadgets ni de bonnes idées !', 'doraemon', '6.85', 27, 'kodomo'),
(17, 'Inazuma Eleven', 'Tenya Yabuno', 2008, 'Mark Evans, leader de la modeste équipe de football du collège Raimon, tente de ranimer l\'esprit d\'Inazuma Eleven, une team légendaire composée de membres ayant chacun une technique de jeu foudroyante. Envers et contre tous - notamment la fille du directeur qui a juré la dissolution de leur équipe - ils se lancent à la poursuite de leur rêve ! Mais les adversaires sont de taille, à commencer par l\'institut Occulte, qui leur a lancé une terrible malédiction ! Mark et ses co-équipiers sauront-ils la vaincre et triompher sur le terrain ?', 'inazumaeleven', '6.60', 35, 'kodomo'),
(18, 'Beyblade', 'Takao Aoki', 1999, 'C\'est un gaffeur de première, mais personne n\'est plus passionné de Beyblades que Tyson Kinomiya. Avec la légendaire Dragoon, la Beyblade aux mystérieux pouvoirs, il compte bien triompher de tous les adversaires prêts à en découdre avec lui !', 'beyblade', '6.90', 42, 'kodomo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2246507B9395C3F3` (`customer_id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_FEC530A91BE1FB52` (`basket_id`),
  ADD UNIQUE KEY `UNIQ_FEC530A94584665A` (`product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F52993981BE1FB52` (`basket_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `FK_2246507B9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `FK_FEC530A91BE1FB52` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`id`),
  ADD CONSTRAINT `FK_FEC530A94584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_F52993981BE1FB52` FOREIGN KEY (`basket_id`) REFERENCES `basket` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
