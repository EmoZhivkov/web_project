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
(503, 'office@webdesignbg.com', '$2y$10$QGE2oCepoo7MSNkWccpD6.BZlUMWK7tN1btAdMSvc4zn/7.6bOjFi'),
(504, 'webdesignbg@abv.bg', '$2y$10$zXgQ0dKo9qq5o4pQa3FDyuKu..Lzy3PbB6MgN4vRGJwumQlLzyVN6'),
(505, 'webdesignbg@mail.bg', '$2y$10$0fAeMpD2MpzaALHTuwPF7e0uoLYBG5LXBN/FEFNnWPDj0Ets6wbBy'),
(506, 'admin@admin.com', '$2y$10$WUXslW5gGZ1ewtRUXjDL8e5HvcfS3qclbrn2ZSUoCiDzoxJRIWU.K');


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
(67, 503, 20, 'Rainbow - I surrender', 'https://www.youtube.com/watch?v=iMmMqfQZkxA', 0),
(69, 503, 20, 'Веселин Маринов - Сняг', 'https://www.youtube.com/watch?v=caX68hR4PmM', 0),
(70, 503, 21, 'Till The Day I Die - Bernie Marsden + Micky Moody', 'https://www.youtube.com/watch?v=byRoosbUoaQ', 0),
(72, 503, 20, 'Rainbow - I surrender', 'https://www.youtube.com/watch?v=iMmMqfQZkxA', 0),
(73, 503, 20, 'Gary Moore & Phil Lynott- Out in the Fields', 'https://www.youtube.com/watch?v=xsKpazeA5L8', 0),
(74, 503, 20, 'Веселин Маринов - Сняг', 'https://www.youtube.com/watch?v=caX68hR4PmM', 1),
(75, 503, 21, 'Till The Day I Die - Bernie Marsden + Micky Moody', 'https://www.youtube.com/watch?v=byRoosbUoaQ', 0),
(76, 503, 21, 'Iron Maiden - The Trooper', 'https://www.youtube.com/watch?v=X4bgXH3sJ2Q', 0),
(77, 503, 20, 'Rainbow - I surrender', 'https://www.youtube.com/watch?v=iMmMqfQZkxA', 0),
(78, 503, 20, 'Gary Moore & Phil Lynott- Out in the Fields', 'https://www.youtube.com/watch?v=xsKpazeA5L8', 2),
(79, 503, 20, 'Веселин Маринов - Сняг', 'https://www.youtube.com/watch?v=caX68hR4PmM', 1),
(80, 503, 21, 'Till The Day I Die - Bernie Marsden + Micky Moody', 'https://www.youtube.com/watch?v=byRoosbUoaQ', 5),
(82, 503, 23, 'Avicii - Wake Me Up', 'https://www.youtube.com/watch?v=IcrbM1l_BoI', 0),
(83, 505, 20, 'Константин Живков', 'https://www.youtube.com/watch?v=sEiB2E_N3OA', 0),
(84, 505, 20, 'Политика на поверителност', 'https://www.youtube.com/watch?v=sEiB2E_N3OA', 0),
(85, 504, 20, 'Константин Живков', 'https://www.youtube.com/watch?v=sEiB2E_N3OA', 0),
(86, 504, 21, 'Константин Живков', 'https://www.youtube.com/watch?v=sEiB2E_N3OA', 0),
(87, 504, 20, 'Константин Живков', 'https://www.youtube.com/watch?v=sEiB2E_N3OA', 0);


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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;

ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;


ALTER TABLE `vidove`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_vidove` FOREIGN KEY (`vid`) REFERENCES `vidove` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;