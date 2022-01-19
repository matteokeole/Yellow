-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2022 at 01:47 PM
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_id`, `category_name`) VALUES
(1, 1, 'Shonen'),
(2, 2, 'Seinen'),
(3, 3, 'Shojo'),
(4, 4, 'Josei'),
(5, 5, 'Kodomo');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
('DoctrineMigrations\\Version20220114134234', '2022-01-14 13:42:55', 373);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` date NOT NULL,
  `order_total` int(11) NOT NULL,
  `order_shipping_date` date NOT NULL,
  `order_is_delivered` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id_id` int(11) NOT NULL,
  `order_details_id` int(11) NOT NULL,
  `order_details_subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details_product`
--

CREATE TABLE `order_details_product` (
  `order_details_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` int(255) NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id_id`, `product_id`, `product_name`, `author`, `product_desc`, `date`, `cover`, `price`, `stock`) VALUES
(1, 1, 10, 'One Piece', 'Eiichirō Oda', 'Nous sommes à l’ère des pirates ! Luffy, un garçon espiègle, rêve de devenir le roi des pirates en trouvant le «One Piece», un fabuleux et mystérieux trésor. Mais, par mégarde, Luffy a avalé un jour un «fruit magique du démon» qui l’a transformé en homme caoutchouc. Depuis, il est capable de contorsionner son corps élastique dans tous les sens, mais il a perdu la faculté de nager, le comble pour un pirate ! Au fil d’aventures toujours plus rocambolesques et de rencontres fortuites, Luffy va progressivement composer son équipage et multiplier les amitiés avec les peuples qu’il découvre, tout en affrontant de redoutables ennemis.', 1997, 'onepiece.jpg', 6.9, 47),
(2, 1, 11, 'Dragon Ball', 'Akira Toriyama', 'Dans un monde fantastique semblable à la Terre et peuplé de créatures plus étranges les unes que les autres, un petit garçon à la force herculéenne et doté d’une queue de singe croise un jour la route d’une jeune fille. Celle-ci s’est lancée à la recherche de sept mystérieuses boules de cristal. Car il est dit que quiconque les réunira pourra appeler le dragon sacré et exaucer son voeu le plus cher. En chemin, ce duo d’aventuriers peu commun se heurte à un cochon transformiste usant de ses dons pour kidnapper les jeunes filles d’un village, puis à un vagabond solitaire adepte des arts martiaux que la simple vue d’une jeune femme suffit à tétaniser sur place. Ce n’est que le début d’une grande aventure riche en péripéties, en humour et en combats extraordinaires…', 1985, 'dragonball.jpg', 6.9, 45),
(3, 1, 12, 'Naruto', 'Masashi Kishimoto', 'Naruto est un garçon un peu spécial. Solitaire au caractère fougueux, il n\'est pas des plus appréciés dans son village. Malgré cela, il garde au fond de lui une ambition: celle de devenir un \"maître Hokage\", la plus haute distinction dans l\'ordre des ninjas, et ainsi obtenir la reconnaissance de ses pairs mais cela ne sera pas de tout repos ... Suivez l\'éternel farceur dans sa quête du secret de sa naissance et de la conquête des fruits de son ambition !', 1999, 'naruto.jpg', 3, 38),
(4, 1, 13, 'Fullmetal Alchemist', 'Hiromu Arakawa', 'En voulant ressusciter leur mère, Edward et Alphonse Elric vont utiliser une technique interdite relevant du domaine de l\'alchimie : la transmutation humaine. Seulement, l\'expérience va mal tourner : Edward perd un bras et une jambe et Alphonse son corps, son esprit se retrouvant prisonnier d\'une armure. Devenu un alchimiste d\'Etat, Edward, surnommé \"fullmetal alchimiste\", se lance, avec l\'aide de son frère, à la recherche de la pierre philosophale, leur seule chance de retrouver leur état initial. Ils commencent à enquêter sur un étrange homme, \"le fondateur\" qui passe pour un faiseur de miracles...', 2001, 'fullmetalalchemist.jpg', 6.6, 24),
(5, 2, 20, 'Berserk', 'Kentarō Miura', 'Dans un monde médiéval et fantastique, erre un guerrier solitaire nommé Guts, décidé à être seul maître de son destin. Autrefois contraint par un pari perdu à rejoindre les Faucons, une troupe de mercenaires dirigés par Griffith, Guts fut acteur de nombreux combats sanglants et témoin de sombres intrigues politiques. Mais il réalisa soudain que la fatalité n\'existe pas et qu\'il pouvait reprendre sa liberté s\'il le désirait vraiment...', 1989, 'berserk.jpg', 6.9, 31),
(6, 2, 21, 'Parasite', 'Hitoshi Iwaaki', 'De mystérieuses sphères abritant des parasites se répandent un peu partout sur Terre. Rapidement, les entités prennent possession du cerveau de certains habitants. Nul ne sait d\'où elles viennent, mais elles sont là pour débarrasser le monde de l\'espèce humaine. Shin\'ichi, jeune lycéen, est un « hôte » dont le cerveau a miraculeusement été épargné : Migy, son parasite, a pris possession de son bras droit ! Les deux êtres vont apprendre chacun l\'un de l\'autre. Alors que Shin\'ichi se découvre doté d\'incroyables facultés physiques, il prend aussi conscience de la menace qui plane sur ses proches et sur l\'humanité tout entière.', 1988, 'parasite.jpg', 6.9, 27),
(7, 2, 22, 'Vinland Saga', 'Makoto Yukimura', 'Depuis qu\'Askeladd, un chef de guerre fourbe et sans honneur, a tué son père lorsqu\'il était enfant, Thorfinn le suit partout dans le but de se venger. Mais bien qu\'il soit devenu un guerrier redoutable, il ne parvient toujours pas à vaincre son ennemi. Au fil des ans, enchaînant missions périlleuses et combats afin d\'obtenir des duels contre l\'homme qu\'il hait plus que tout, le gentil Thorfinn est devenu froid et solitaire, prisonnier de son passé et incapable d\'aller de l\'avant. Jusqu\'à ce que la vie le force à regarder le monde différemment…', 2005, 'vinlandsaga.jpg', 7.65, 25),
(8, 2, 23, 'Kingdom', 'Yasuhisa Hara', 'Dans la Chine de l\'époque des Royaumes Combattants qui va du Ve siècle av. J.-C. jusqu\'à l\'unification des royaumes chinois par la dynastie Qin en 221 av. J.-C), on suit le jeune Shin dans son chemin vers l\'accomplissement de son rêve : devenir un Grand Général. Shin est originaire de l\'état de Qin, en proie à de nombreux soubresauts aussi bien à l\'intérieur du royaume qu\'à l\'extérieur. À travers l\'histoire de Shin, on suit aussi notamment l\'histoire de Ei Sei, l\'homme qui sera par la suite connu sous le nom de Qin Shi Huang, unificateur de la Chine.', 2006, 'kingdom.jpg', 6.95, 33),
(9, 3, 30, 'Nana', 'Ai Yazawa', 'La première est rêveuse, rigolote et sensible, mais « coeur d´artichaut », un brin capricieuse et loin d´être indépendante. La seconde est plus mature, déterminée, un peu mystérieuse mais peut être d´une froideur qui glace le dos. Toutes deux s´appellent « Nana », ont un attrait pour l´art et ont vécu en province. Toutes deux vont connaître l´Amour et décider de partir pour Tokyo.', 2000, 'nana.jpg', 6.99, 19),
(10, 3, 31, 'Orange', 'Ichigo Takano', 'Un matin, alors qu\'elle se rend au lycée, Naho reçoit une drôle de lettre… une lettre du futur ! La jeune femme qu\'elle est devenue dix ans plus tard, rongée par de nombreux remords, souhaite aider celle qu\'elle était autrefois à ne pas faire les mêmes erreurs qu\'elle. Aussi, elle a décrit, dans un long courrier, les événements qui vont se dérouler dans la vie de Naho lors des prochains mois, lui indiquant même comment elle doit se comporter. Mais Naho, a bien du mal à y croire, à cette histoire… Et de toute façon, elle manque bien trop d\'assurance en elle pour suivre certaines directives indiquées dans ce curieux courrier. Pour le moment, la seule chose dont elle est sûre, c\'est que Kakeru, le nouvel élève de la classe, ne la laisse pas indifférent…', 2012, 'orange.jpg', 7.95, 32),
(11, 3, 32, 'Sailor Moon', 'Naoko Takeuchi', 'Usagi est une jeune fille de 14 ans comme tant d\'autres : elle aime dormir, jouer aux jeux vidéo, elle pleure pour un oui ou pour un non et elle ne se passionne pas pour ses études. Mais un beau jour, elle croise le chemin de Luna, un chat doué de parole qui va la transformer en une jolie justicière : Sailor Moon ! La voilà investie de plusieurs missions : elle doit identifier ses alliées, retrouver le légendaire Cristal d\'Argent et protéger une certaine princesse... tout en luttant contre de mystérieux ennemis qui sont eux aussi à la recherche du fabuleux cristal aux pouvoirs fantastiques !', 1991, 'sailormoon.jpg', 6.95, 37),
(12, 4, 40, 'Kids on the Slope', 'Yūki Kodama', 'À la fin des années 60, alors que le Japon occupé fait face à de grands changements sociaux, la musique venue des États-Unis va faire naître, entre deux adolescents que tout oppose, une amitié complexe. Kaoru vient tout juste d\'emménager en ville. D\'un naturel solitaire et studieux, il n\'a pas pour habitude de se mêler à ses camarades de classe. Et pourtant, sa rencontre avec le bagarreur Sentarô va radicalement changer sa vie…', 2007, 'kidsontheslope.jpg', 6.79, 34),
(13, 4, 41, 'Nodame Cantabile', 'Tomoko Ninomiya', 'Chiaki, élève surdoué du conservatoire, quitte le cours d’un professeur de piano réputé, ne supportant plus ses méthodes. Son rêve est de devenir chef d’orchestre, comme son idole, le célèbre Sevastiano Viera, qu’il a connu lorsqu’il vivait, enfant, en Europe.\r\nHélas, pour le moment, Chiaki ne peut en aucun cas envisager un retour sur le Vieux Continent du fait de ses phobies de l’avion... mais aussi du bateau... En somme, il est prisonnier du Japon. Il envisage alors d’arrêter la musique. C’est là qu’il va rencontrer Megumi Noda – « Nodame » –, sa voisine qui se révèle être une musicienne sans aucune rigueur mais au toucher particulièrement sensible, qualité qui ne laisse pas insensible Chiaki.', 2007, 'nodamecantabile.jpg', 6.95, 23),
(14, 4, 42, 'Blue', 'Kiriko Nananan', 'Le bleu, c\'est celui de la mer que Kayako vient contempler, après les cours. Un jour, la secrète Masami l\'y accompagne. L\'amitié se mue en amour, puis en souffrance, chacune ayant des aspirations et obligations différentes...', 1996, 'blue.jpg', 6.9, 28),
(15, 5, 50, 'Pokemon', 'Asada Miho', 'Nos jeunes héros sont prêts à tout pour devenir les meilleurs éleveurs de Pokémon de la planète. Pour cela, il faut en attraper le plus possible, les entrainer pour les livrer à des combats durant lesquels ils vont prendre du galon. Arrivés à un certain seuil de force, les Pokémon subissent ce que les initiés appellent une \"évolution\", se transformant en monstres beaucoup plus puissants.', 1997, 'pokemon.jpg', 10, 45),
(16, 5, 51, 'Doraemon', 'Fujiko Fujio', 'Nobita est un jeune garçon assez irresponsable, complètement gaffeur et maladroit. Il est, de plus, régulièrement grondé par sa mère et ses professeurs à cause des mauvais plans qu\'il imagine souvent.\r\nUn jour, pourtant, débarque dans sa vie un chat-robot venu du futur. Il se nomme DORAemon, porte toujours une clochette autour du coup et a la particularité d\'avoir des mains toutes rondes. DORAemon est en fait envoyé par le futur petit-fils de Nobita. Sa mission sur Terre : sauver Nobita de ses échecs successifs et donc sauver la famille de la déchéance. Il va donc devoir s\'atteler à faire évoluer Nobita dans le bon sens et, par là, infléchir le destin. Inutile de préciser que cela ne sera pas de tout repos…\r\nHeureusement que DORAemon ne perd jamais sa mine joviale et n\'est jamais à court ni de gadgets ni de bonnes idées !', 1969, 'doraemon.jpg', 6.85, 42),
(17, 5, 52, 'Inazuma Eleven', 'Tenya Yabuno', 'Mark Evans, leader de la modeste équipe de football du collège Raimon, tente de ranimer l\'esprit d\'Inazuma Eleven, une team légendaire composée de membres ayant chacun une technique de jeu foudroyante. Envers et contre tous - notamment la fille du directeur qui a juré la dissolution de leur équipe - ils se lancent à la poursuite de leur rêve ! Mais les adversaires sont de taille, à commencer par l\'institut Occulte, qui leur a lancé une terrible malédiction ! Mark et ses co-équipiers sauront-ils la vaincre et triompher sur le terrain ?', 2008, 'inazumaeleven.jpg', 6.6, 36),
(18, 5, 53, 'Beyblade', 'Takao Aoki', 'C\'est un gaffeur de première, mais personne n\'est plus passionné de Beyblades que Tyson Kinomiya. Avec la légendaire Dragoon, la Beyblade aux mystérieux pouvoirs, il compte bien triompher de tous les adversaires prêts à en découdre avec lui !', 1999, 'beyblade.jpg', 6.9, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_81398E09FCDAEAAA` (`order_id_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_845CA2C1FCDAEAAA` (`order_id_id`);

--
-- Indexes for table `order_details_product`
--
ALTER TABLE `order_details_product`
  ADD PRIMARY KEY (`order_details_id`,`product_id`),
  ADD KEY `IDX_FE10BEE08C0FA77` (`order_details_id`),
  ADD KEY `IDX_FE10BEE04584665A` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD9777D11E` (`category_id_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
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
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `FK_81398E09FCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_845CA2C1FCDAEAAA` FOREIGN KEY (`order_id_id`) REFERENCES `order` (`id`);

--
-- Constraints for table `order_details_product`
--
ALTER TABLE `order_details_product`
  ADD CONSTRAINT `FK_FE10BEE04584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_FE10BEE08C0FA77` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD9777D11E` FOREIGN KEY (`category_id_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
