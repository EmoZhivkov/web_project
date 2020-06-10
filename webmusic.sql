CREATE DATABASE IF NOT EXISTS `webmusic` CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

USE `webmusic`;


CREATE TABLE `charts` (
  `id` int(11) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `vis` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `charts` (`id`, `ime`, `vis`) VALUES
(1, 'Най-слушани', 'Да'),
(2, 'По жанр', 'Да'),
(3, 'По потребител', 'Да');


CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `clients` (`id`, `email`, `pass`) VALUES
(507, 'admin@admin.com', '$2y$10$SSt9wvmmcA9v3IqHX5sUB.weWTU5IGeKtAdgFM5EsaJ7.JRio9ZWG'),
(511, 'test_second@gmail.com', '$2y$10$SSt9wvmmcA9v3IqHX5sUB.weWTU5IGeKtAdgFM5EsaJ7.JRio9ZWG'),
(521, 'test@test.com', '$2y$10$o506OLj77i3zleVaXYtLn.TF.kUP9PKnGX7/QjH.0.2JxEoKUncfO');


CREATE TABLE `dumi` (
  `id` int(11) NOT NULL,
  `t` varchar(250) DEFAULT NULL,
  `d` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `dumi` (`id`, `t`, `d`) VALUES
(1, 'WebMusic', 'Любимата ни музика');


CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `vid` int(11) DEFAULT 1,
  `ime` varchar(150) DEFAULT NULL,
  `youtube` longtext DEFAULT NULL,
  `played` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `products` (`id`, `clientid`, `vid`, `ime`, `youtube`, `played`) VALUES
(89, 507, 20, 'Ava Max - Kings & Queens', 'https://www.youtube.com/watch?v=jH1RNk8954Q', 1),
(90, 507, 20, 'Dua Lipa - Don\\\'t Start Now', 'https://www.youtube.com/watch?v=oygrmJFKYZY', 1),
(91, 507, 20, 'The Weeknd - Blinding Lights', 'https://www.youtube.com/watch?v=4NRXx6U8ABQ', 2),
(92, 507, 23, 'SAINt JHN - ROSES', 'https://www.youtube.com/watch?v=bNU_AA0aALM', 0),
(93, 507, 20, 'Doja Cat - Say So', 'https://www.youtube.com/watch?v=pok8H_KF1FA', 2),
(94, 507, 20, 'Justin Bieber - Intentions ft. Quavo', 'https://www.youtube.com/watch?v=9p2wMpVVtXg', 1),
(95, 507, 20, 'Roddy Ricch - The Box', 'https://www.youtube.com/watch?v=UNZqm3dxd2w', 2),
(96, 507, 20, 'Dua Lipa - Break My Heart', 'https://www.youtube.com/watch?v=Nj2U6rhnucI', 5),
(97, 507, 21, 'Queen – Bohemian Rhapsody', 'https://www.youtube.com/watch?v=fJ9rUzIMcZQ', 0),
(99, 507, 21, 'AC/DC - Highway to Hell', 'https://www.youtube.com/watch?v=gEPmA3USJdI', 0),
(100, 507, 21, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 10),
(101, 507, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 12),
(102, 507, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(103, 507, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(104, 507, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 25),
(105, 507, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(106, 507, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 10),
(107, 511, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 5),
(108, 511, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 6),
(109, 511, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(110, 511, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(111, 521, 24, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(112, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(113, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(114, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(115, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(116, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(117, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(118, 521, 23, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(119, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(120, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(121, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(122, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(123, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(124, 521, 25, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0),
(125, 511, 22, 'Metallica: Enter Sandman', 'https://www.youtube.com/watch?v=CD-E-LDc384', 0);



CREATE TABLE `vidove` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `nomer` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `vidove` (`id`, `ime`, `nomer`) VALUES
(20, 'Поп', 0),
(21, 'Рок', 0),
(22, 'Джаз', 0),
(23, 'Техно', 0),
(24, 'Попфолк', 0),
(25, 'Други', 0);


ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_products_vidove` (`vid`);

ALTER TABLE `vidove`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;


ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

ALTER TABLE `vidove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_vidove` FOREIGN KEY (`vid`) REFERENCES `vidove` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

