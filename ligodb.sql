-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Aug 2020 um 11:52
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ligodb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `NR` int(6) NOT NULL,
  `Firma` varchar(40) NOT NULL,
  `Vorname` varchar(30) NOT NULL,
  `Nachname` varchar(30) NOT NULL,
  `Strasse` varchar(30) NOT NULL,
  `Hausnummer` int(4) NOT NULL,
  `PLZ` int(5) NOT NULL,
  `Ort` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kunde`
--

INSERT INTO `kunde` (`NR`, `Firma`, `Vorname`, `Nachname`, `Strasse`, `Hausnummer`, `PLZ`, `Ort`) VALUES
(1, 'Christoph Schmid', 'Christoph', 'Schmid', 'Max-Prinstner-Straße', 1, 92339, 'Beilngries'),
(2, 'Bayerische Staatsforsten', 'Christine', 'Götz', 'Hienheimer Straße', 14, 93309, 'Kehlheim');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `leistung`
--

CREATE TABLE `leistung` (
  `LNR` int(6) NOT NULL,
  `Leistung` varchar(255) NOT NULL,
  `Stundensatz` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `leistung`
--

INSERT INTO `leistung` (`LNR`, `Leistung`, `Stundensatz`) VALUES
(1, 'Logoerstellung', 60),
(2, 'Briefing', 60),
(3, 'Abstimmung', 60),
(4, 'Gestaltung', 60),
(5, 'Konzeption', 60),
(6, 'Programmierung', 70);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE `rechnung` (
  `RNR` int(6) NOT NULL,
  `KNR` int(6) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `rechnung`
--

INSERT INTO `rechnung` (`RNR`, `KNR`, `Datum`) VALUES
(1, 2, '2020-03-30 00:00:00'),
(3, 1, '2020-02-11 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnungsposition`
--

CREATE TABLE `rechnungsposition` (
  `PNR` int(6) NOT NULL,
  `RNR` int(6) NOT NULL,
  `LNR` int(6) NOT NULL,
  `Aufwand` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `rechnungsposition`
--

INSERT INTO `rechnungsposition` (`PNR`, `RNR`, `LNR`, `Aufwand`) VALUES
(1, 1, 1, 3),
(2, 1, 2, 5);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`NR`);

--
-- Indizes für die Tabelle `leistung`
--
ALTER TABLE `leistung`
  ADD PRIMARY KEY (`LNR`);

--
-- Indizes für die Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD PRIMARY KEY (`RNR`),
  ADD KEY `Kundennummer` (`KNR`);

--
-- Indizes für die Tabelle `rechnungsposition`
--
ALTER TABLE `rechnungsposition`
  ADD PRIMARY KEY (`PNR`),
  ADD KEY `Rechnungsnummer` (`RNR`),
  ADD KEY `Leistungsnummer` (`LNR`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `NR` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `leistung`
--
ALTER TABLE `leistung`
  MODIFY `LNR` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  MODIFY `RNR` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `rechnungsposition`
--
ALTER TABLE `rechnungsposition`
  MODIFY `PNR` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rechnung`
--
ALTER TABLE `rechnung`
  ADD CONSTRAINT `rechnung_ibfk_1` FOREIGN KEY (`KNR`) REFERENCES `kunde` (`NR`);

--
-- Constraints der Tabelle `rechnungsposition`
--
ALTER TABLE `rechnungsposition`
  ADD CONSTRAINT `rechnungsposition_ibfk_1` FOREIGN KEY (`RNR`) REFERENCES `rechnung` (`RNR`),
  ADD CONSTRAINT `rechnungsposition_ibfk_2` FOREIGN KEY (`LNR`) REFERENCES `leistung` (`LNR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
