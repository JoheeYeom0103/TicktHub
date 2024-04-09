-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 12:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tickethub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `banktransfer`
--

CREATE TABLE `banktransfer` (
  `BankID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `BankName` varchar(50) DEFAULT NULL,
  `AccountHolderName` varchar(50) DEFAULT NULL,
  `AccountNumber` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banktransfer`
--

INSERT INTO `banktransfer` (`BankID`, `UserID`, `BankName`, `AccountHolderName`, `AccountNumber`) VALUES
(1, 2, 'Bank X', 'jane_smith', '1234567890123456'),
(2, 3, 'Bank Y', 'mike_jones', '9876543210987654'),
(3, 1, 'Bank Z', 'john_doe', '9876123456789012');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `BuyerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`BuyerID`) VALUES
(1),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `UserID` int(11) NOT NULL,
  `TicketID` int(11) NOT NULL,
  `TicketName` varchar(100) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`UserID`, `TicketID`, `TicketName`, `Quantity`, `Price`) VALUES
(1, 1, 'Concert', 2, 50.00),
(1, 2, 'Sports', 1, 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `creditcard`
--

CREATE TABLE `creditcard` (
  `CardID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CardNumber` varchar(16) DEFAULT NULL,
  `ExpiryDate` date DEFAULT NULL,
  `CardHolderName` varchar(50) DEFAULT NULL,
  `CVC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creditcard`
--

INSERT INTO `creditcard` (`CardID`, `UserID`, `CardNumber`, `ExpiryDate`, `CardHolderName`, `CVC`) VALUES
(1, 1, '1234567890123456', '2025-12-01', 'john_doe', 123),
(2, 1, '9876543210987654', '2024-10-01', 'john_doe', 456),
(3, 2, '1111222233334444', '2026-06-01', 'jane_smith', 789),
(4, 3, '4444333322221111', '2025-08-01', 'mike_jones', 246);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `EventID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `Status` enum('Approved','Pending','Rejected') DEFAULT NULL,
  `EventName` varchar(100) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `DateTime` datetime DEFAULT NULL,
  `SellerID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`AdminID`, `Status`, `EventName`, `Location`, `DateTime`, `SellerID`) VALUES
(4, 'Pending', 'Jane\'s Event', 'My House', '2024-04-04 15:32:00', NULL),
(4, 'Approved', 'Concert', 'Venue A', '2024-04-10 18:00:00', 2),
(4, 'Approved', 'Music Festival', 'Venue B', '2024-05-20 16:00:00', 2),
(4, 'Approved', 'Comedy Show', 'Venue C', '2024-06-15 19:30:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
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
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `PaymentID`, `TicketID`, `TicketQuantity`, `OrderCost`, `OrderDateTime`, `OrderStatus`) VALUES
(1, 1, 1, 1, 2, 100.00, '2024-03-12 10:30:00', 1),
(2, 2, 2, 2, 1, 25.00, '2024-03-12 11:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT NULL,
  `TransactionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentMethod`, `UserID`, `Amount`, `Status`, `TransactionID`) VALUES
(1, 'Credit Card', 1, 100.00, 1, 123456),
(2, 'Credit Card', 2, 50.00, 1, 789012),
(3, 'Bank Transfer', 3, 75.00, 1, 345678),
(4, 'Bank Transfer', 1, 150.00, 1, 456789),
(5, 'Credit Card', 3, 75.00, 1, 901234);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `SellerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`SellerID`) VALUES
(2);

-- --------------------------------------------------------

--
-- Table structure for table `ticketinfo`
--

CREATE TABLE `ticketinfo` (
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
-- Dumping data for table `ticketinfo`
--

INSERT INTO `ticketinfo` (`TicketID`, `SellerID`, `EventID`, `TicketName`, `TicketDescription`, `Price`, `Seat`, `OpeningDateTime`, `ClosingDateTime`) VALUES
(0, 1, 0, 'Jane\'s Event', 'This is a super fn event!', 1.00, NULL, NULL, NULL),
(1, 2, 1, 'Concert Ticket', 'VIP Seat', 100.00, 101, '2024-04-01 10:00:00', '2024-04-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ticketinventory`
--

CREATE TABLE `ticketinventory` (
  `TicketID` int(11) NOT NULL,
  `SellerID` int(11) DEFAULT NULL,
  `TicketQty` int(11) DEFAULT NULL,
  `TicketStatus` tinyint(1) DEFAULT NULL,
  `IsOverdue` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticketinventory`
--

INSERT INTO `ticketinventory` (`TicketID`, `SellerID`, `TicketQty`, `TicketStatus`, `IsOverdue`) VALUES
(1, 2, 50, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(16) DEFAULT NULL,
  `FirstName` varchar(16) DEFAULT NULL,
  `MiddleName` varchar(16) DEFAULT NULL,
  `LastName` varchar(16) DEFAULT NULL,
  `Birthdate` date DEFAULT NULL,
  `Password` varchar(16) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `FirstName`, `MiddleName`, `LastName`, `Birthdate`, `Password`, `Email`, `Phone`) VALUES
(1, 'john_doe', 'John', '', 'Doe', '1990-05-15', 'password1', 'john.doe@example.com', '403-123-4567'),
(2, 'jane_smith', 'Jane', '', 'Smith', '1985-08-22', 'password2', 'jane.smith@example.com', '404-234-5678'),
(3, 'mike_jones', 'Mike', '', 'Jones', '1995-11-10', 'password3', 'mike.jones@example.com', '403-345-6789'),
(4, 'admin_user', 'Admin', '', 'User', '1980-01-01', 'adminpass', 'admin@example.com', '587-456-7890');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `banktransfer`
--
ALTER TABLE `banktransfer`
  ADD PRIMARY KEY (`BankID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`BuyerID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`UserID`),
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`CardID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);
  ADD PRIMARY KEY (`TicketID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SellerID`);

--
-- Indexes for table `ticketinfo`
--
ALTER TABLE `ticketinfo`
  ADD PRIMARY KEY (`TicketID`),
  ADD KEY `EventID` (`EventID`);

--
-- Indexes for table `ticketinventory`
--
ALTER TABLE `ticketinventory`
  ADD PRIMARY KEY (`TicketID`),
  ADD KEY `SellerID` (`SellerID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banktransfer`
--
ALTER TABLE `banktransfer`
  MODIFY `BankID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `CardID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `banktransfer`
--
ALTER TABLE `banktransfer`
  ADD CONSTRAINT `banktransfer_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `buyer`
--
ALTER TABLE `buyer`
  ADD CONSTRAINT `buyer_ibfk_1` FOREIGN KEY (`BuyerID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `creditcard`
--
ALTER TABLE `creditcard`
  ADD CONSTRAINT `creditcard_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `seller`
--
ALTER TABLE `seller`
  ADD CONSTRAINT `seller_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `ticketinfo`
--
ALTER TABLE `ticketinfo`
  ADD CONSTRAINT `ticketinfo_ibfk_1` FOREIGN KEY (`EventID`) REFERENCES `event` (`EventID`);

--
-- Constraints for table `ticketinventory`
--
ALTER TABLE `ticketinventory`
  ADD CONSTRAINT `ticketinventory_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
