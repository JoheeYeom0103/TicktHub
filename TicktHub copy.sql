-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2024 at 09:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TicktHub`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`AdminID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `BankTransfer`
--

CREATE TABLE `BankTransfer` (
  `BankID` int(11) NOT NULL,
  `SetDefault` tinyint(1) DEFAULT NULL,
  `BankName` varchar(16) DEFAULT NULL,
  `AccountHolderName` varchar(16) DEFAULT NULL,
  `AccountNumber` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `BankTransfer`
--

INSERT INTO `BankTransfer` (`BankID`, `SetDefault`, `BankName`, `AccountHolderName`, `AccountNumber`) VALUES
(1, 1, 'Bank of America', 'Alice Johns', '1234567890123456'),
(2, 0, 'Chase Bank', 'Bob Wills', '9876543210987654');

-- --------------------------------------------------------

--
-- Table structure for table `Buyer`
--

CREATE TABLE `Buyer` (
  `BuyerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Buyer`
--

INSERT INTO `Buyer` (`BuyerID`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `TicketID` int(11) NOT NULL,
  `TicketName` varchar(100) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`TicketID`, `TicketName`, `Quantity`, `Price`) VALUES
(1, 'Concert', 2, 50.00),
(2, 'Sports', 1, 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `CreditCard`
--

CREATE TABLE `CreditCard` (
  `CardID` int(11) NOT NULL,
  `SetDefault` tinyint(1) DEFAULT NULL,
  `CardNumber` varchar(16) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CardHolderName` varchar(16) DEFAULT NULL,
  `CVC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CreditCard`
--

INSERT INTO `CreditCard` (`CardID`, `SetDefault`, `CardNumber`, `ExpiryDate`, `CardHolderName`, `CVC`) VALUES
(1, 1, '1234567812345678', '2025-12-31', 'John Doe', 123),
(2, 0, '9876543298765432', '2024-11-30', 'Jane Smith', 456);

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE `Event` (
  `EventID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `Status` enum('Approved','Pending','Rejected') DEFAULT NULL,
  `EventName` varchar(100) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`EventID`, `AdminID`, `Status`, `EventName`, `Location`, `DateTime`) VALUES
(1, 1, 'Approved', 'Music Fest', 'Park A', '2024-05-20 18:00:00'),
(2, 1, 'Approved', 'Soccer Cup', 'Stadium B', '2024-06-10 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `TicketID` int(11) DEFAULT NULL,
  `TicketQuantity` int(11) DEFAULT NULL,
  `OrderCost` decimal(10,2) DEFAULT NULL,
  `OrderDateTime` datetime DEFAULT NULL,
  `OrderStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`OrderID`, `UserID`, `PaymentID`, `TicketID`, `TicketQuantity`, `OrderCost`, `OrderDateTime`, `OrderStatus`) VALUES
(1, 1, 1, 1, 2, 100.00, '2024-03-12 10:30:00', 1),
(2, 2, 2, 2, 1, 25.00, '2024-03-12 11:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `PayoutID` int(11) DEFAULT NULL,
  `BuyerID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `TransactionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Payment`
--

INSERT INTO `Payment` (`PaymentID`, `PaymentMethod`, `PayoutID`, `BuyerID`, `Amount`, `Status`, `TransactionID`) VALUES
(1, 'Credit Card', 1, 1, 100.00, 1, 123456),
(2, 'PayPal', 1, 2, 25.00, 1, 789012);

-- --------------------------------------------------------

--
-- Table structure for table `Seller`
--

CREATE TABLE `Seller` (
  `SellerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Seller`
--

INSERT INTO `Seller` (`SellerID`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `TicketInfo`
--

CREATE TABLE `TicketInfo` (
  `TicketID` int(11) NOT NULL,
  `SellerID` int(11) DEFAULT NULL,
  `EventID` int(11) DEFAULT NULL,
  `TicketName` varchar(100) DEFAULT NULL,
  `TicketDescription` varchar(255) DEFAULT NULL,
  `Price` decimal(65,2) DEFAULT NULL,
  `Seat` int(11) DEFAULT NULL,
  `OpeningDateTime` datetime DEFAULT NULL,
  `ClosingDateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TicketInfo`
--

INSERT INTO `TicketInfo` (`TicketID`, `SellerID`, `EventID`, `TicketName`, `TicketDescription`, `Price`, `Seat`, `OpeningDateTime`, `ClosingDateTime`) VALUES
(1, 1, 1, 'Concert', 'Music event', 50.00, 101, '2024-05-20 18:00:00', '2024-05-20 22:00:00'),
(2, 1, 2, 'Sports', 'Sports event', 25.00, 202, '2024-06-10 15:00:00', '2024-06-10 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `TicketInventory`
--

CREATE TABLE `TicketInventory` (
  `TicketID` int(11) NOT NULL,
  `SellerID` int(11) DEFAULT NULL,
  `TicketQty` int(11) DEFAULT NULL,
  `TicketStatus` tinyint(1) DEFAULT NULL,
  `IsOverdue` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `TicketInventory`
--

INSERT INTO `TicketInventory` (`TicketID`, `SellerID`, `TicketQty`, `TicketStatus`, `IsOverdue`) VALUES
(1, 1, 50, 1, 0),
(2, 1, 30, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(16) DEFAULT NULL,
  `FirstName` varchar(16) DEFAULT NULL,
  `MiddleName` varchar(16) DEFAULT NULL,
  `LastName` varchar(16) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Password` varchar(16) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Username`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Password`, `Email`) VALUES
(1, 'JohnMarkDoe', 'John', 'Mark', 'Doe', '1990-05-15', 'password1', 'john.doe@example.com'),
(2, 'AliceMarieSmith', 'Alice', 'Marie', 'Smith', '1985-08-20', 'password2', 'alice.smith@example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `BankTransfer`
--
ALTER TABLE `BankTransfer`
  ADD PRIMARY KEY (`BankID`);

--
-- Indexes for table `Buyer`
--
ALTER TABLE `Buyer`
  ADD PRIMARY KEY (`BuyerID`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD PRIMARY KEY (`CardID`);

--
-- Indexes for table `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `BuyerID` (`BuyerID`),
  ADD KEY `PayoutID` (`PayoutID`);

--
-- Indexes for table `Seller`
--
ALTER TABLE `Seller`
  ADD PRIMARY KEY (`SellerID`);

--
-- Indexes for table `TicketInfo`
--
ALTER TABLE `TicketInfo`
  ADD PRIMARY KEY (`TicketID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `TicketInventory`
--
ALTER TABLE `TicketInventory`
  ADD PRIMARY KEY (`TicketID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `BankTransfer`
--
ALTER TABLE `BankTransfer`
  ADD CONSTRAINT `banktransfer_ibfk_1` FOREIGN KEY (`BankID`) REFERENCES `Payment` (`PaymentID`);

--
-- Constraints for table `Buyer`
--
ALTER TABLE `Buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`BuyerID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `CreditCard`
--
ALTER TABLE `CreditCard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`CardID`) REFERENCES `Payment` (`PaymentID`);

--
-- Constraints for table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `Admin` (`AdminID`);

--
-- Constraints for table `Payment`
--
ALTER TABLE `Payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BuyerID`) REFERENCES `Buyer` (`BuyerID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`PayoutID`) REFERENCES `Seller` (`SellerID`);

--
-- Constraints for table `Seller`
--
ALTER TABLE `Seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `TicketInfo`
--
ALTER TABLE `TicketInfo`
  ADD CONSTRAINT `ticketinfo_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `Event` (`EventID`);

--
-- Constraints for table `TicketInventory`
--
ALTER TABLE `TicketInventory`
  ADD CONSTRAINT `ticketinventory_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `Seller` (`SellerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
