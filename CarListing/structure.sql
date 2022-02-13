SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `Cars` (
  `Id` int(11) NOT NULL,
  `Brand` varchar(80) NOT NULL,
  `Model` varchar(250) NOT NULL,
  `Year` varchar(11) NOT NULL,
  `Picture` mediumblob DEFAULT NULL,
  `Thumbnail` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `Cars`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `Cars`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

