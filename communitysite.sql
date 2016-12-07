-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Gegenereerd op: 07 dec 2016 om 21:32
-- Serverversie: 5.6.25
-- PHP-versie: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communitysite`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `chatbox`
--

CREATE TABLE IF NOT EXISTS `chatbox` (
  `ChatID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ChatBody` text NOT NULL,
  `ChatDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(64) NOT NULL,
  `EventCategory` varchar(64) NOT NULL,
  `EventAuthorID` int(11) NOT NULL,
  `EventStartDateTime` datetime NOT NULL,
  `EventEndDateTime` datetime NOT NULL,
  `EventDescription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `event_attendance`
--

CREATE TABLE IF NOT EXISTS `event_attendance` (
  `EventID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AttendanceStatus` int(1) NOT NULL DEFAULT '0' COMMENT '0 = Not Attending, 1 = Maybe, 9 = Attending.',
  `AttendanceDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(128) NOT NULL,
  `UserEmail` varchar(128) NOT NULL,
  `UserHash` varchar(64) NOT NULL,
  `UserLevel` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`ChatID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexen voor tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `EventAuthorID` (`EventAuthorID`);

--
-- Indexen voor tabel `event_attendance`
--
ALTER TABLE `event_attendance`
  ADD UNIQUE KEY `EventID_2` (`EventID`,`UserID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserName` (`UserName`),
  ADD KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `chatbox`
--
ALTER TABLE `chatbox`
  MODIFY `ChatID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
