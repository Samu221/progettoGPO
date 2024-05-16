-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 16, 2024 alle 15:30
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progettogpo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `immagine` longblob DEFAULT NULL,
  `artigiano` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`username`, `email`, `password`, `immagine`, `artigiano`) VALUES
('pucciartigiano', 'ergwagar@email.coc', '123stella', '', 1),
('samu', 'samuele@mail.com', 'd9f1ce0aaae4a62a86fe0defd96479bae188ddde', NULL, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `bottega`
--

CREATE TABLE `bottega` (
  `ID_bottega` int(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `orario` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `città` varchar(60) NOT NULL,
  `descrizione` varchar(2000) NOT NULL,
  `num_like` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bottega`
--

INSERT INTO `bottega` (`ID_bottega`, `email`, `orario`, `nome`, `indirizzo`, `città`, `descrizione`, `num_like`) VALUES
(1, 'ergwagar@email.coc', '19-20', 'legno e botte', 'via roma 2', 'Milano', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse lorem lacus, condimentum vitae hendrerit nec, dignissim quis libero. Sed consectetur scelerisque interdum. Nullam elementum vitae dolor in pretium. Sed quis nibh velit. Sed sit amet placerat orci, ut ultrices nulla. Cras varius fringilla velit, eget dictum velit aliquet pharetra. Nullam vel faucibus dui. Nam interdum dolor eget convallis consequat. Aliquam euismod vitae odio non vulputate. Proin quam lacus, mattis non tincidunt dictum, sollicitudin ut nisi. Nam neque ipsum, congue in tellus ac, efficitur fermentum est.  Sed finibus odio velit, nec ullamcorper turpis semper vel. Nam ut massa vehicula, commodo ipsum non, posuere ipsum. Suspendisse et magna sit amet dolor laoreet tempus vel id elit. Vestibulum in arcu vel urna mollis sagittis et id dolor. Suspendisse eu ex bibendum, laoreet ante ac, fringilla massa. Fusce eu mattis urna, id molestie nisi. Aliquam consectetur turpis in euismod luctus. Donec quis sodales ante, in venenatis mauris. Sed rhoncus ex lacus, non vehicula libero lobortis a. Sed et libero pretium, tincidunt nulla sit amet, consequat mi. Phasellus efficitur augue ullamcorper, ullamcorper ex in, vulputate purus.  Etiam varius libero risus, non sagittis ex eleifend nec. Aliquam nisl leo, molestie vitae consequat et, maximus id elit. Duis cursus tellus sit amet vestibulum aliquet. Praesent nulla lorem, rhoncus non elit et, finibus consequat lacus. Fusce et lorem tellus. Duis porttitor nisi in finibus luctus. Maecenas dapibus nisl quis felis scelerisque, et viverra eros ornare. Integer id gravida tellus.  Nunc eu scelerisque nibh. Duis interdum hendrerit posuere. Donec accumsan pharetra lorem, nec iaculis dolor tincidunt quis. Morbi varius arcu non odio egestas, ac scelerisque odio maximus. Etiam', 100);

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

CREATE TABLE `immagine` (
  `ID_image` int(30) NOT NULL,
  `image` longblob NOT NULL,
  `ID_bottega` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `salvati`
--

CREATE TABLE `salvati` (
  `email` varchar(50) NOT NULL,
  `ID_bottega` int(30) NOT NULL,
  `ID_save` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `salvati`
--

INSERT INTO `salvati` (`email`, `ID_bottega`, `ID_save`) VALUES
('ergwagar@email.coc', 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tag`
--

CREATE TABLE `tag` (
  `ID_bottega` int(30) NOT NULL,
  `caratteristica` varchar(30) NOT NULL,
  `ID_tag` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tag`
--

INSERT INTO `tag` (`ID_bottega`, `caratteristica`, `ID_tag`) VALUES
(1, 'falegnameria', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indici per le tabelle `bottega`
--
ALTER TABLE `bottega`
  ADD PRIMARY KEY (`ID_bottega`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `immagine`
--
ALTER TABLE `immagine`
  ADD PRIMARY KEY (`ID_image`),
  ADD KEY `ID_bottega` (`ID_bottega`);

--
-- Indici per le tabelle `salvati`
--
ALTER TABLE `salvati`
  ADD PRIMARY KEY (`ID_save`),
  ADD KEY `ID_bottega` (`ID_bottega`),
  ADD KEY `email` (`email`);

--
-- Indici per le tabelle `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`ID_tag`),
  ADD KEY `ID_bottega` (`ID_bottega`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bottega`
--
ALTER TABLE `bottega`
  MODIFY `ID_bottega` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `immagine`
--
ALTER TABLE `immagine`
  MODIFY `ID_image` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `salvati`
--
ALTER TABLE `salvati`
  MODIFY `ID_save` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `tag`
--
ALTER TABLE `tag`
  MODIFY `ID_tag` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bottega`
--
ALTER TABLE `bottega`
  ADD CONSTRAINT `bottega_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`ID_bottega`) REFERENCES `bottega` (`ID_bottega`);

--
-- Limiti per la tabella `salvati`
--
ALTER TABLE `salvati`
  ADD CONSTRAINT `salvati_ibfk_1` FOREIGN KEY (`ID_bottega`) REFERENCES `bottega` (`ID_bottega`),
  ADD CONSTRAINT `salvati_ibfk_2` FOREIGN KEY (`email`) REFERENCES `account` (`email`);

--
-- Limiti per la tabella `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`ID_bottega`) REFERENCES `bottega` (`ID_bottega`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
