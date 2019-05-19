-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2019 at 11:18 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Sportas'),
(2, 'Muzika'),
(3, 'Menas'),
(4, 'Laisvalaikis'),
(5, 'Technologijos'),
(6, 'Vaikams'),
(9, 'Art'),
(10, 'Gaudynes'),
(11, 'Skaitymas'),
(13, 'Runnio'),
(15, 'Jayme Tucker');

-- --------------------------------------------------------

--
-- Table structure for table `category_user`
--

CREATE TABLE `category_user` (
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_user`
--

INSERT INTO `category_user` (`category_id`, `user_id`) VALUES
(1, 28),
(2, 5),
(2, 26),
(2, 28),
(2, 29),
(2, 31),
(4, 26),
(4, 28),
(6, 28),
(11, 28);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `event_id`, `author_id`, `text`) VALUES
(1, 5, 10, 'asasd'),
(2, 5, 10, '123123123'),
(5, 5, 10, 'asdasdasd'),
(6, 5, 10, '12'),
(7, 5, 10, 'lol'),
(8, 5, 10, 'Geras tekast tau patiks istas tekstas tikrai labai labai labai labai labail bai sadaaaa'),
(9, 2, 10, 'asdasd'),
(10, 2, 10, 'asdasd'),
(11, 2, 10, 'asdasd'),
(12, 2, 10, '123123'),
(13, 2, 10, '523423'),
(14, 11, 10, '121212132'),
(15, 11, 10, '5423423'),
(16, 1, 10, '4984654'),
(20, 1, 11, 'Hey'),
(21, 12, 11, 'Labas'),
(23, 1, 2, 'Sveiki vis'),
(25, 1, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas eu ipsum vulputate, tristique elit id, auctor metus. Fusce sit amet justo non ante porta hendrerit a vitae sapien. Nulla non rhoncus turpis. Vivamus a velit ex. Aliquam ac ante turpis duis.'),
(28, 11, 12, 'Hello'),
(30, 3, 16, 'Hey hey hey'),
(31, 12, 16, 'Labas'),
(35, 14, 19, 'Iusto consequuntur amet quia iure laborum Qui voluptas quisquam sapiente et soluta vel'),
(37, 1, 20, 'Heyo'),
(38, 2, 20, 'asdasddas'),
(39, 1, 21, 'Labas'),
(42, 1, 2, 'ManikMonik!!!'),
(43, 5, 25, 'Sveiki draugai!'),
(44, 1, 26, 'Nu labukas'),
(45, 1, 26, 'Adminui duosiu sita sitrynti'),
(46, 2, 26, 'hey hey heyy');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `price` decimal(5,2) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `author_id`, `title`, `description`, `date`, `price`, `location`, `category_id`) VALUES
(1, 1, 'Ea harum voluptates', 'Aut sed culpa debiti', '2018-08-14 02:36:00', '80.00', 'Dolorem temporibus a', 2),
(2, 2, 'Dolore debitis irure', 'Laboris dolor cumque', '2021-05-27 08:03:00', '780.00', 'Fugiat consequuntur', 2),
(3, 2, 'Commodo commodo aut', 'Enim accusamus quo v', '2024-03-13 08:13:00', '981.00', 'Non sed reprehenderi', 1),
(4, 2, 'Molestias saepe cons', 'Ad sint sed quo ali', '2017-07-16 23:13:00', '910.00', 'Et temporibus in mag', 1),
(5, 2, 'namas', 'Enim vitae rerum atq', '2015-04-23 13:48:00', '0.00', 'Eos necessitatibus q', 1),
(11, 2, 'Vlagr mohgurklis', 'Veniam nobis except', '2020-11-28 02:33:00', '712.00', 'Maiores deserunt nis', 1),
(12, 2, 'Ex omnis sed ut repr', 'Excepteur qui numqua', '2014-08-22 14:20:00', '994.00', 'Debitis consequatur', 9),
(13, 2, 'Sokiams su guma per ozy', 'Jayyyy bus labai labai labai labai labi labi smagu', '2019-03-04 03:42:00', '0.00', 'Laborum ex non et pr', 11),
(14, 19, 'Id minus perferendi', 'Placeat nobis bland', '2024-01-21 12:14:00', '807.00', 'Minus aute in suscip', 6),
(15, 2, 'Party at the lighthouse', 'Et sapiente ea quam', '2019-09-10 17:35:00', '0.00', 'Litghouse street 100', 4),
(16, 2, 'Dolorum dolor qui de', 'Eu est rem accusanti', '2021-11-19 05:23:00', '767.00', 'Amet dicta hic accu', 13),
(19, 2, 'Libero exercitation', 'Qui debitis proident', '2020-07-10 16:39:00', '925.00', 'Blanditiis fuga Ab', 2);

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190331145817', '2019-04-22 18:50:47'),
('20190408183937', '2019-04-22 18:50:48'),
('20190422185428', '2019-04-22 18:54:37'),
('20190506143859', '2019-05-06 14:41:04'),
('20190506170948', '2019-05-06 17:10:43'),
('20190513155417', '2019-05-13 15:56:22'),
('20190519172912', '2019-05-19 17:29:30'),
('20190519173542', '2019-05-19 17:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passwordResetToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `username`, `passwordResetToken`) VALUES
(1, 'soxugij@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$bDA5VS9YWS9iZUNQbmV0Sg$uXlW3YPLXXACM3INW1WVtZHcliWh5Wk3OPagOdTo4bM', 'Nomlanga', 'Pope', 'dihapelyp', NULL),
(2, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$WnZiVTN3MFNrY1lMV1FZLg$Vgr3kkh1ztc9jieEiaYTZ18fXiGN5+mY77DjGhSLJrM', 'Adminas', 'Adminavitas', 'Admin', NULL),
(3, 'hahywowaso@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$bWh0MEcvQjR4YXB2aXo3cQ$ltY9KAcFBzUjE/+9CahtQa+Iez91AcyObhntDEX/GY4', 'Melinda', 'Holland', 'rolav', NULL),
(4, 'juho@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$ZE14Sng5Y09EVnhKZXM3aQ$OtmSkwKw4xGmythjxsazCue106eoPpUaQEapBxRssO8', 'Camilla', 'Carlson', 'xykacafi', NULL),
(5, 'teltonikatest1234@gmail.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$a2RZd0NMYy8vMVNhd3pDNw$CCp2krFmzBztOS24zvizWk0xc99u2osa3Acj6/Wd/5w', 'Jonas', 'Jonauskis', 'Jonukas', NULL),
(6, 'muku@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$YkxPYXVubGRMeUowbzRjZw$Os36WyxrDkNlfLTyqxAIHRO0O02PE3eexxLjq4AfCpI', 'Winter', 'Snider', 'tizyxy', NULL),
(7, 'tijuz@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$SEpnb1NmUVZaTy9JUU5KUQ$QS2AnkMxPrID9DWaN7XdZIZqNQ9sTWpJ8CKGoQenapI', 'Randall', 'Singleton', 'sefodafimu', NULL),
(8, 'cytila@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$TWhDRjhRaVoxcGNRdmdzNg$exM6JXt3QQ2P7mfzrYpq++LVUdiaF8k94yubdQyN72Y', 'Forrest', 'Banks', 'zigmas', NULL),
(9, 'pesasoq@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$b1oyNDBjNmY2N0x1cmVZeA$jl3Crrbb6oeJGHSnhkWFa2mBLKdEYvqX7tsew/E8h4Q', 'Daquan', 'White', 'fokekigoqa', NULL),
(10, 'dezadylifo@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$dWtKaWxncGZMTERBbnFmLw$KTLuCGf7oZHh700zIq02SgZgCBdqxR4MFBeg2l99PyY', 'Hiroko', 'Ramos', 'nimuzeco', NULL),
(11, 'vowikupezo@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$Ri9PN0JkeVZPLnRiU1VCVQ$abYM4Ebu0/OckXzg93r/VExRbiD2PkvfTMaE44EX9TM', 'Violet', 'Acosta', 'RoboNUT', NULL),
(12, 'vagoh@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$SjNBVTNQdFRQMVU3eEFnWQ$FoHwccnkkhUDPAvmIIrxBL3id5YpykRgkieT7SdZ8FU', 'Drake', 'Avila', 'ziluw', NULL),
(13, 'dobesy@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$UFcuYkJqT0Rta2xYOFB3bw$y6dGRUqENdCtQF8vPR5llIYUT9OL91jOMVKCPmlULw4', 'Alisa', 'Moore', 'xutad', NULL),
(14, 'zaqev@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$V0YuL1Bqa3dydzZTdWh2Ug$yiIRkRc9z80srZV5tdgK5FfHw/CyVWSjfLDqev/KC4w', 'Giacomo', 'Tyler', 'qejuhac', NULL),
(15, 'lohudupo@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$bmpXaXlCS1p3bDVYMnhwTw$QDgylLo3Eh59SNYHlWm5CvDR6S0a2o/ZbFfC7pkqh1c', 'Vera', 'Riddle', 'cyxyper', NULL),
(16, 'zycica@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$REs3bndUNElTNXNEdjBCcg$+L22FWD3qvR2rQsRnJ3ZMwMTJbMDNCVU4Pa6SyTNtdg', 'Ian', 'Glass', 'goribyhow', NULL),
(19, 'kb321@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=1024,t=2,p=2$ODRqdEZXYVE3OWtGWW1GSg$kSNQ8/QfWHWx/l7J0tSi730FcDxUnTeLIRYl6ukiGO4', 'Kietas', 'Bicas', 'KietasBicas321', NULL),
(20, 'mololokiq@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$NGt0c2p0ZUZBRVRvQVZoQw$33a6e2aear8SRrjSwFUH8HDUkjqVtssKCO3/gsCe7+w', 'Constance', 'Sullivan', 'dawowigut', NULL),
(21, 'goraxonec@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$T3hWRnRKeUxkU0dMbWhlQg$A5yfi9vTaXZRiADoH4phlkFXL5OsENuFr1cUVnH5M8A', 'Natalija', 'Hester', 'SuperMega', NULL),
(22, 'sasytonymo@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$THBXMkJNQy92SktORGU0Lg$psIsGTYVm0L0UMjEvkl8lvEzDQK20AhM9O5anU0T7IA', 'Hau', 'Newton', 'pewuhehuw', NULL),
(23, 'wukyjeqav@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$NFpaRkQ5MnZPSHRMUkgzMQ$8s8NTraWvpKSyWbeEL8/IPS7mYKvxTKa2bmJn0a/We4', 'Patricia', 'Whitehead', 'xupebedul', NULL),
(25, 'fizesabam@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$dndtL2M3THRBUDB2dFdMeA$405bmxcr3Q0glf5Qn73B7thmHZQMpWyI3morxzHc5CA', 'Jenette', 'Richardson', 'Zaibas', NULL),
(26, 'winubi@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$cEkuczVzSS5RNWdoYWVZYw$o5FP5cCWesHw/1A1RXQpw2Tv/04+8S1nxS/YszmohQg', 'Jonas', 'Jonaitis', 'GoldenJone', NULL),
(28, 'jorepewil@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$bXlxRmNybmRMMmdDckxZaQ$TjCDOyUWsN7r/bT+eT8V0iOTKF4+xS5AKsPxDh3VlQI', 'Garrison', 'Blake', 'jymusyxi', NULL),
(29, 'sesycy@mailinator.com', '[]', '$argon2i$v=19$m=1024,t=2,p=2$RHpzRE9hbkVYRzBpd1V5Lw$JOHEwMFNkkEenE7V1nle2rv2XtMBbQxZnVN0PBGRU74', 'Phyllisss', 'Diaz', 'xydug', NULL),
(30, 'rovaced@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$NFBaM2Q5dVF1bVpmdUxSQg$mhyY7QUbURtaK49WUlREFNoSoH3hxRZPZFhVM8cMhtA', 'Harriet', 'Drake', 'vyfuw', NULL),
(31, 'kexufe@mailinator.net', '[]', '$argon2i$v=19$m=1024,t=2,p=2$RkU4czguem5UVmJiVEhZeQ$Q0m5H3j2yxob2kNyxnhoNlbdZ9tGoFEmy6C/yGdVra8', 'Emmanuel', 'Knight', 'bycas', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_user`
--
ALTER TABLE `category_user`
  ADD PRIMARY KEY (`category_id`,`user_id`),
  ADD KEY `IDX_608AC0E12469DE2` (`category_id`),
  ADD KEY `IDX_608AC0EA76ED395` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526C71F7E88B` (`event_id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA7F675F31B` (`author_id`),
  ADD KEY `IDX_3BAE0AA712469DE2` (`category_id`);

--
-- Indexes for table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_user`
--
ALTER TABLE `category_user`
  ADD CONSTRAINT `FK_608AC0E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_608AC0EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA712469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA7F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
