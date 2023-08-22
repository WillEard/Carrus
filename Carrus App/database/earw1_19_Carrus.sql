-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 172.16.11.22:3306
-- Generation Time: Apr 20, 2022 at 02:26 AM
-- Server version: 10.5.15-MariaDB-0+deb11u1
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earw1_19_Carrus`
--

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int(9) NOT NULL,
  `UserID` int(4) NOT NULL,
  `CarID` int(6) NOT NULL,
  `Registration` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderID`, `UserID`, `CarID`, `Registration`) VALUES
(42, 35, 22, 'AB21ABC');

-- --------------------------------------------------------

--
-- Table structure for table `PaymentInformation`
--

CREATE TABLE `PaymentInformation` (
  `PaymentID` int(6) NOT NULL,
  `UserID` int(6) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `HouseName` varchar(255) NOT NULL,
  `PostCode` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `CardNum` varchar(255) NOT NULL,
  `CVC` varchar(255) NOT NULL,
  `Expiry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PaymentInformation`
--

INSERT INTO `PaymentInformation` (`PaymentID`, `UserID`, `Street`, `HouseName`, `PostCode`, `City`, `FullName`, `CardNum`, `CVC`, `Expiry`) VALUES
(34, 35, '$2y$10$RQQgFsVSpqQWzsMqfUeG6eq7DZ.swsJlPu2n/244IVMLaukTdT982', '$2y$10$j6V7/aUNn4bSxY4bwadfbOhF42QVIT7cvKfCERegjJMi52dFi1QGK', '$2y$10$gINOW5RsEkLlC0pyMbc44uPMxi6fIavobLp927huonD/5lekOjiO2', '$2y$10$FS6svv1riY6W4XjEKTfR0uCz54BSk89ZhAmBQnCNnQwuHr6wgP8M.', '$2y$10$Jq/uyOejGJqbjQqUvGYDpuS4bMpDWku7Kf59vcWZYj5ScOkEKY.eq', '$2y$10$jX7rzdz27VtpPLHUBwmZE.Y.OPBzCsJWLXhAbMSXqIsB1PPjAfJNi', '$2y$10$Etp/QOkrs1JkWzn3XB.cnuEWUNf6egiwM.Sud.6LawgpxpeTYqYWG', '$2y$10$f8qe0VgD7IzPoL68lWrXSe8sAJGM2LewOVR4nlAjPlnjC3nVma7kC');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `UserID` int(4) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNo` varchar(11) DEFAULT NULL,
  `Pass` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`UserID`, `FirstName`, `Surname`, `Username`, `Email`, `PhoneNo`, `Pass`, `Date`) VALUES
(34, 'Test', 'Tester', 'TestAccount1', 'Test1@gmail.com', '12345678900', '$2y$10$ZX4YQyr1dZfX48NMwmZfQ.ak3W5NNdZxk0b1I64k1g1RL8FYfII0i', '2022-04-18 19:58:23'),
(35, 'Test', 'Tester', 'TestAccount2', 'Test2@gmail.com', '12345678911', '$2y$10$WjmgdYj7DflmsWsGByn5SOIQ0JY027N7cC6NjynrxHWR88ImxuUkm', '2022-04-18 19:58:58');

-- --------------------------------------------------------

--
-- Table structure for table `Vehicles`
--

CREATE TABLE `Vehicles` (
  `CarID` int(6) NOT NULL,
  `UserID` int(6) NOT NULL,
  `Registration` varchar(7) NOT NULL,
  `Manufacturer` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Variant` varchar(255) NOT NULL,
  `Transmission` varchar(255) NOT NULL,
  `FuelType` varchar(255) NOT NULL,
  `EngineSize` decimal(65,0) NOT NULL,
  `VehicleAge` varchar(255) NOT NULL,
  `Mileage` int(255) NOT NULL,
  `PrevOwners` int(255) NOT NULL,
  `Price` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Vehicles`
--

INSERT INTO `Vehicles` (`CarID`, `UserID`, `Registration`, `Manufacturer`, `Model`, `Variant`, `Transmission`, `FuelType`, `EngineSize`, `VehicleAge`, `Mileage`, `PrevOwners`, `Price`) VALUES
(22, 34, 'AB21ABC', 'Audi', 'A6', 'RS6 Avant', 'Automatic', 'Petrol', '40', '2021', 4000, 1, '75000'),
(23, 34, 'AB22FDK', 'BMW', '2 Series', 'M2 Competition', 'Automatic', 'Petrol', '30', '2021', 7000, 1, '42000'),
(24, 34, 'FF19GFK', 'Volkswagen', 'Golf', 'GTI', 'Automatic', 'Petrol', '20', '2019', 11000, 2, '21000'),
(25, 35, 'AA12GFK', 'Volkswagen', 'Polo', 'R WRC', 'Manual', 'Petrol', '20', '2013', 32000, 3, '20000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK1_Orders` (`UserID`),
  ADD KEY `FK2_Orders` (`CarID`);

--
-- Indexes for table `PaymentInformation`
--
ALTER TABLE `PaymentInformation`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `FK_PaymentInformation` (`UserID`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `PhoneNo` (`PhoneNo`);

--
-- Indexes for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD PRIMARY KEY (`CarID`),
  ADD KEY `FK_Vehicles` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `OrderID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `PaymentInformation`
--
ALTER TABLE `PaymentInformation`
  MODIFY `PaymentID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `UserID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Vehicles`
--
ALTER TABLE `Vehicles`
  MODIFY `CarID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `FK1_Orders` FOREIGN KEY (`UserID`) REFERENCES `user_accounts` (`UserID`),
  ADD CONSTRAINT `FK2_Orders` FOREIGN KEY (`CarID`) REFERENCES `Vehicles` (`CarID`) ON DELETE CASCADE;

--
-- Constraints for table `PaymentInformation`
--
ALTER TABLE `PaymentInformation`
  ADD CONSTRAINT `FK_PaymentInformation` FOREIGN KEY (`UserID`) REFERENCES `user_accounts` (`UserID`) ON DELETE CASCADE;

--
-- Constraints for table `Vehicles`
--
ALTER TABLE `Vehicles`
  ADD CONSTRAINT `FK_Vehicles` FOREIGN KEY (`UserID`) REFERENCES `user_accounts` (`UserID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
