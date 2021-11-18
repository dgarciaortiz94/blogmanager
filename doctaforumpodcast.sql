-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2021 a las 08:58:57
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doctaforumpodcast`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `podcast_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `podcast_id`, `content`, `is_active`) VALUES
(1, 5, 16, 'Primer comentario', 1),
(2, 5, 16, 'Segundo comentario', 1),
(3, 6, 16, 'Tercer comentario', 1),
(4, 6, 20, 'Este es un podcast de prueba, aquí puedes comentar.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20211112214713', '2021-11-12 21:47:38', 82),
('DoctrineMigrations\\Version20211112215230', '2021-11-12 21:52:34', 44),
('DoctrineMigrations\\Version20211115230446', '2021-11-15 23:05:13', 235),
('DoctrineMigrations\\Version20211117083217', '2021-11-17 08:32:39', 202),
('DoctrineMigrations\\Version20211117083349', '2021-11-17 08:33:53', 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `podcast`
--

CREATE TABLE `podcast` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `audio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `podcast`
--

INSERT INTO `podcast` (`id`, `user_id`, `title`, `description`, `audio`, `picture`, `create_date`, `is_active`) VALUES
(16, 5, 'Podcast 1', 'Cu nam labores lobortis definiebas, ei aliquyam salutatus persequeris quo, cum eu nemore fierent dissentiunt. Per vero dolor id, vide democritum scribentur eu vim, pri erroribus temporibus ex. Euismod molestie offendit has no. Quo te semper invidunt quaestio, per vituperatoribus sadipscing ei, partem aliquyam sensibus in cum.\r\n\r\nDicunt percipit deserunt ut usu. Aliquip delenit an eam, vocent vituperata vim ea. Ei mollis audire interpretaris cum, ei impedit fierent sea. Ius at homero noster prompta, ea sit dignissim vituperata efficiendi. Natum placerat ad mei.\r\n\r\nVirtute equidem ceteros in mel. Id volutpat neglegentur eos. Eu eum facilisis voluptatum, no eam albucius verterem. Sit congue platonem adolescens ut. Offendit reprimique et has, eu mei homero imperdiet.\r\n\r\nVis id minim dicant sensibus. Pri aliquip conclusionemque ad, ad malis evertitur torquatos his. Has ei solum harum reprimique, id illum saperet tractatos his. Ei omnis soleat antiopam quo. Ad augue inani postulant mel, mel ea qualisque forensibus.\r\n\r\nSenserit mediocrem vis ex, et dicunt deleniti gubergren mei. Mel id clita mollis repudiare. Sed ad nostro delicatissimi, postea pertinax est an. Adhuc sensibus percipitur sed te, eirmod tritani debitis nec ea. Cu vis quis gubergren.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.', 'kendo-kadoni-ringtones-prueba-sonido-de-6195381634845.mp3', 'arbol-619538163430e.jpg', '2021-11-17 17:12:54', 1),
(17, 6, 'Podcast 2', 'Est ei erat mucius quaeque. Ei his quas phaedrum, efficiantur mediocritatem ne sed, hinc oratio blandit ei sed. Blandit gloriatur eam et. Brute noluisse per et, verear disputando neglegentur at quo. Sea quem legere ei, unum soluta ne duo. Ludus complectitur quo te, ut vide autem homero pro.\r\n\r\nAn vim commodo dolorem volutpat, cu expetendis voluptatum usu, et mutat consul adversarium his. His natum numquam legimus an, diam fabulas mei ut. Melius fabellas sadipscing vel id. Partem diceret mandamus mea ne, has te tempor nostrud. Aeque nostro eum no.\r\n\r\nDicunt percipit deserunt ut usu. Aliquip delenit an eam, vocent vituperata vim ea. Ei mollis audire interpretaris cum, ei impedit fierent sea. Ius at homero noster prompta, ea sit dignissim vituperata efficiendi. Natum placerat ad mei.\r\n\r\nLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nNo his munere interesset. At soluta accusam gloriatur eos, ferri commodo sed id, ei tollit legere nec. Eum et iudico graecis, cu zzril instructior per, usu at augue epicurei. Saepe scaevola takimata vix id. Errem dictas posidonium id vis, ne modo affert incorrupte eos.\r\n\r\nAt cum soleat disputationi, quo veri admodum vituperata ad. Ea vix ceteros complectitur, vel cu nihil nullam. Nam placerat oporteat molestiae ei, an putant albucius qui. Oblique menandri ei his, mei te mazim oportere comprehensam.\r\n\r\nSenserit mediocrem vis ex, et dicunt deleniti gubergren mei. Mel id clita mollis repudiare. Sed ad nostro delicatissimi, postea pertinax est an. Adhuc sensibus percipitur sed te, eirmod tritani debitis nec ea. Cu vis quis gubergren.\r\n\r\nLorem salutandi eu mea, eam in soleat iriure assentior. Tamquam lobortis id qui. Ea sanctus democritum mei, per eu alterum electram adversarium. Ea vix probo dicta iuvaret, posse epicurei suavitate eam an, nam et vidit menandri. Ut his accusata petentium.', 'AUTORACEDRAGSTER6091-91-61958fa61f2d7.mp3', 'girasol-61958fa61eca1.jpg', '2021-11-17 23:26:30', 1),
(18, 6, 'Podcast 3', 'Has maiorum habemus detraxit at. Timeam fabulas splendide et his. Facilisi aliquando sea ad, vel ne consetetur adversarium. Integre admodum et his, nominavi urbanitas et per, alii reprehendunt et qui. His ei meis legere nostro, eu kasd fabellas definiebas mei, in sea augue iriure.\r\n\r\nMei eu mollis albucius, ex nisl contentiones vix. Duo persius volutpat at, cu iuvaret epicuri mei. Duo posse pertinacia no, ex dolor contentiones mea. Nec omnium utamur dignissim ne. Mundi lucilius salutandi an sea, ne sea aeque iudico comprehensam. Populo delicatissimi ad pri. Ex vitae accusam vivendum pro.\r\n\r\nLorem salutandi eu mea, eam in soleat iriure assentior. Tamquam lobortis id qui. Ea sanctus democritum mei, per eu alterum electram adversarium. Ea vix probo dicta iuvaret, posse epicurei suavitate eam an, nam et vidit menandri. Ut his accusata petentium.\r\n\r\nExpetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.', 'Resistire-2020-Video-Oficial-160k-61959004423b4.mp3', 'gato-619590043ac60.jpg', '2021-11-17 23:28:04', 1),
(19, 6, 'Podcast 4', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.\r\n\r\nNo his munere interesset. At soluta accusam gloriatur eos, ferri commodo sed id, ei tollit legere nec. Eum et iudico graecis, cu zzril instructior per, usu at augue epicurei. Saepe scaevola takimata vix id. Errem dictas posidonium id vis, ne modo affert incorrupte eos.\r\n\r\nAt quaeque adversarium ius, sed at integre persius verterem. Sit summo tibique at, eam et fugit complectitur, vis te natum vivendum mandamus. Iudico quodsi cum ad, dicit everti sensibus in sea, ea eius paulo deterruisset pri. Pro id aliquam hendrerit definitiones. Per et legimus delectus.\r\n\r\nWisi forensibus mnesarchum in cum. Per id impetus abhorreant, his no magna definiebas, inani rationibus in quo. Ut vidisse dolores est, ut quis nominavi mel. Ad pri quod apeirian concludaturque, id timeam iudicabit rationibus pri. Erant putant luptatum ex sit, error euismod ad qui, meliore voluptatum complectitur an vix. Clita persius sed et, vix vidit consulatu complectitur ex. Per nonummy postulant assentior an, mea audiam fabellas deserunt id.', 'cintas-de-prueba-1-61959030b2de3.mp3', 'fotografa-61959030b2934.jpg', '2021-11-17 23:28:48', 1),
(20, 6, 'Volcán de la palma', 'At quaeque adversarium ius, sed at integre persius verterem. Sit summo tibique at, eam et fugit complectitur, vis te natum vivendum mandamus. Iudico quodsi cum ad, dicit everti sensibus in sea, ea eius paulo deterruisset pri. Pro id aliquam hendrerit definitiones. Per et legimus delectus.\r\n\r\nEam ex integre quaeque bonorum, ea assum solet scriptorem pri, et usu nonummy accusata interpretaris. Debitis necessitatibus est no. Eu probo graeco eum, at eius choro sit, possit recusabo corrumpit vim ne. Noster diceret delicata vel id.\r\n\r\nWisi forensibus mnesarchum in cum. Per id impetus abhorreant, his no magna definiebas, inani rationibus in quo. Ut vidisse dolores est, ut quis nominavi mel. Ad pri quod apeirian concludaturque, id timeam iudicabit rationibus pri. Erant putant luptatum ex sit, error euismod ad qui, meliore voluptatum complectitur an vix. Clita persius sed et, vix vidit consulatu complectitur ex. Per nonummy postulant assentior an, mea audiam fabellas deserunt id.\r\n\r\nNo his munere interesset. At soluta accusam gloriatur eos, ferri commodo sed id, ei tollit legere nec. Eum et iudico graecis, cu zzril instructior per, usu at augue epicurei. Saepe scaevola takimata vix id. Errem dictas posidonium id vis, ne modo affert incorrupte eos.\r\n\r\nHis audiam deserunt in, eum ubique voluptatibus te. In reque dicta usu. Ne rebum dissentiet eam, vim omnis deseruisse id. Ullum deleniti vituperata at quo, insolens complectitur te eos, ea pri dico munere propriae. Vel ferri facilis ut, qui paulo ridens praesent ad. Possim alterum qui cu. Accusamus consulatu ius te, cu decore soleat appareat usu.\r\n\r\nCu nam labores lobortis definiebas, ei aliquyam salutatus persequeris quo, cum eu nemore fierent dissentiunt. Per vero dolor id, vide democritum scribentur eu vim, pri erroribus temporibus ex. Euismod molestie offendit has no. Quo te semper invidunt quaestio, per vituperatoribus sadipscing ei, partem aliquyam sensibus in cum.\r\n\r\nExpetenda tincidunt in sed, ex partem placerat sea, porro commodo ex eam. His putant aeterno interesset at. Usu ea mundi tincidunt, omnium virtute aliquando ius ex. Ea aperiri sententiae duo. Usu nullam dolorum quaestio ei, sit vidit facilisis ea. Per ne impedit iracundia neglegentur. Consetetur neglegentur eum ut, vis animal legimus inimicus id.\r\n\r\nIn mel saperet expetendis. Vitae urbanitas sadipscing nec ut, at vim quis lorem labitur. Exerci electram has et, vidit solet tincidunt quo ad, moderatius contentiones nec no. Nam et puto abhorreant scripserit, et cum inimicus accusamus.\r\n\r\nAn vim commodo dolorem volutpat, cu expetendis voluptatum usu, et mutat consul adversarium his. His natum numquam legimus an, diam fabulas mei ut. Melius fabellas sadipscing vel id. Partem diceret mandamus mea ne, has te tempor nostrud. Aeque nostro eum no.\r\n\r\nAt cum soleat disputationi, quo veri admodum vituperata ad. Ea vix ceteros complectitur, vel cu nihil nullam. Nam placerat oporteat molestiae ei, an putant albucius qui. Oblique menandri ei his, mei te mazim oportere comprehensam.', 'yt1s-com-VOLCAN-de-LA-PALMA-Como-viven-los-CIENTIFICOS-que-estan-al-frente-de-una-emergencia-asi-RTVE-6195916155726.mp3', 'volcan-6195916154efb.jpg', '2021-11-17 23:33:53', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `name`, `is_active`) VALUES
(4, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$Nkeams4D0P/9TuiY0.90x.FQk6sF.pzjmKWpfVBDLJW8uQzOTTFoq', 'Administrador', NULL, 'Admin', 1),
(5, 'dgarciaortiz94@gmail.com', '[\"ROLE_USER\"]', '$2y$13$qt6J330HpBYuZA1HBYQkuuqqsuzLSFKIwV8IagauzGkUGL9bKTpKG', 'García', 'Ortiz', 'Diego', 1),
(6, 'diego01@mail.com', '[\"ROLE_USER\"]', '$2y$13$11Qz48CL/u1n5Ysc302w8OQXUactwr.SzUL7s/gdAT0Ar.Q1jVXTW', 'García', NULL, 'Diego01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CA76ED395` (`user_id`),
  ADD KEY `IDX_9474526C786136AB` (`podcast_id`);

--
-- Indices de la tabla `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D7E805BDA76ED395` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C786136AB` FOREIGN KEY (`podcast_id`) REFERENCES `podcast` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `podcast`
--
ALTER TABLE `podcast`
  ADD CONSTRAINT `FK_D7E805BDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
