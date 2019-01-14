-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2019 at 11:26 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Perfumes');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(50) NOT NULL,
  `CustomerEmail` varchar(20) NOT NULL,
  `CustomerPhone` varchar(20) NOT NULL,
  `CustomerAddress` varchar(100) NOT NULL,
  `TRN` varchar(50) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `CustomerActive` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `CustomerName`, `CustomerEmail`, `CustomerPhone`, `CustomerAddress`, `TRN`, `ImageID`, `CustomerActive`) VALUES
(1, 'Test Customer', '', '', '', '', 0, '1'),
(2, 'Suhail', '', '0527947235', '', '', 0, '1'),
(3, 'Santhosh', '', '', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE `design` (
  `DesignID` int(11) NOT NULL,
  `DesignName` varchar(20) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `DesignPrice` float NOT NULL,
  `ImageID` int(11) NOT NULL,
  `DesignActive` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`DesignID`, `DesignName`, `ServiceID`, `DesignPrice`, `ImageID`, `DesignActive`) VALUES
(1, 'Latest Arabian Abaya', 1, 475, 14, '1'),
(4, 'New Style of Abaya', 1, 225, 16, '1'),
(5, 'Abaya Dubai Design', 1, 350, 17, '1'),
(6, 'Party Wear Formal Ab', 1, 550, 18, '1'),
(7, 'Amazing Abaya Design', 1, 250, 19, '1'),
(8, 'Shawl Design 1', 2, 60, 30, '1'),
(9, 'Shawl Design 2 ', 2, 75, 31, '1');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ImageID` int(11) NOT NULL,
  `ImageName` varchar(500) NOT NULL,
  `ImagePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ImageID`, `ImageName`, `ImagePath`) VALUES
(5, 'item_XL_9569013_18066409.jpg', 'img/product'),
(6, 'item_XL_6959551_4753405.jpg', 'img/product'),
(7, 'item_XL_7366568_5861683.jpg', 'img/product'),
(8, 'item_XL_5435870_2289263.jpg', 'img/product'),
(9, 'item_XL_4938818_73445105.jpg', 'img/product'),
(10, 'item_XL_5843258_73445331.jpg', 'img/product'),
(11, 'item_XL_4637177_16199259.jpg', 'img/product'),
(12, 'ch05.jpg', 'img/service'),
(13, 'img-thing.jpg', 'img/service'),
(14, 'Latest-Arabian-Abaya-Designs-With-Hijab.jpg', 'img/design'),
(16, 'New-Style-of-Abaya-Designs-2018.jpg', 'img/design'),
(17, 'Abaya-Dubai-Design-for-Women-with-Scarf.jpg', 'img/design'),
(18, 'Party-Wear-Formal-Abaya-Collection.jpg', 'img/design'),
(19, 'Amazing-Abaya-Design-Ideas.jpg', 'img/design'),
(30, 'wholesale-2016-Fashion-Brand-STUNNING-HEAD-PIECE-HIJAB-WEDDING-BRIDAL-silk-chiffon-SHAWL-abaya-niqab-scarf.jpg', 'img/design'),
(31, '7c70286b7b04d4bc6408e9c462367232--shawls-hindu.jpg', 'img/design'),
(32, 'abaya-fabric-500x500.jpg', 'img/product'),
(33, 'f08f3fef-907e-489e-b250-b18ccadc2bd9.jpg', 'img/staff');

-- --------------------------------------------------------

--
-- Table structure for table `manufacture`
--

CREATE TABLE `manufacture` (
  `ManufactureID` int(11) NOT NULL,
  `ManufactureName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`ManufactureID`, `ManufactureName`) VALUES
(1, 'CK');

-- --------------------------------------------------------

--
-- Table structure for table `order_assign`
--

CREATE TABLE `order_assign` (
  `OrderAssignID` int(11) NOT NULL,
  `OrderAssignDate` date NOT NULL,
  `ReadyDate` date NOT NULL,
  `DeliveredDate` date NOT NULL,
  `OrderItemID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_assign`
--

INSERT INTO `order_assign` (`OrderAssignID`, `OrderAssignDate`, `ReadyDate`, `DeliveredDate`, `OrderItemID`, `StaffID`, `Status`) VALUES
(1, '2019-01-03', '2019-01-03', '2019-01-03', 3, 1, 'delivered'),
(2, '2019-01-03', '2019-01-03', '2019-01-03', 2, 1, 'delivered'),
(3, '2019-01-03', '2019-01-03', '2019-01-03', 6, 1, 'delivered'),
(4, '2019-01-03', '2019-01-03', '0000-00-00', 7, 1, 'ready');

-- --------------------------------------------------------

--
-- Table structure for table `order_form`
--

CREATE TABLE `order_form` (
  `OrderFormID` int(11) NOT NULL,
  `ReferenceNo` varchar(20) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `Type` varchar(20) NOT NULL,
  `Discount` float NOT NULL,
  `TotalTax` float NOT NULL,
  `TotalWD` float NOT NULL,
  `TotalAmount` float NOT NULL,
  `ItemNo` int(5) NOT NULL,
  `ItemCount` int(5) NOT NULL,
  `CompleteDate` date DEFAULT NULL,
  `Sale` enum('0','1') NOT NULL DEFAULT '0',
  `Status` varchar(25) NOT NULL DEFAULT 'new',
  `OrderFormActive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_form`
--

INSERT INTO `order_form` (`OrderFormID`, `ReferenceNo`, `CustomerID`, `OrderDate`, `DeliveryDate`, `Type`, `Discount`, `TotalTax`, `TotalWD`, `TotalAmount`, `ItemNo`, `ItemCount`, `CompleteDate`, `Sale`, `Status`, `OrderFormActive`) VALUES
(1, '1500', 1, '2018-04-25', '2018-04-30', 'Normal', 0, 17.5, 367.5, 367.5, 1, 1, NULL, '0', 'new', '1'),
(2, '123', 1, '2019-01-03', NULL, 'Urgent', 8.75, 133.75, 2808.75, 2800, 2, 2, NULL, '0', 'Partial Complete', '1'),
(3, '578', 2, '2019-01-03', NULL, 'Normal', 0, 46.66, 980, 980, 3, 3, NULL, '0', 'Partial Complete', '1'),
(4, '512', 2, '2019-01-03', NULL, 'Normal', 0, 4.76, 100, 100, 1, 1, '2019-01-14', '1', 'Complete', '1'),
(5, '512', 2, '2019-01-14', NULL, 'Normal', 0, 16.67, 350, 350, 1, 1, NULL, '0', 'new', '1');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `OrderItemID` int(20) NOT NULL,
  `OrderFormID` int(11) NOT NULL,
  `OrderNo` varchar(10) NOT NULL,
  `BookNo` varchar(10) NOT NULL,
  `ItemSl` int(11) NOT NULL,
  `ItemName` varchar(20) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `DesignID` int(11) NOT NULL,
  `WFQuantity` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `TaxRate` float NOT NULL,
  `TaxMethod` varchar(20) NOT NULL,
  `Rate` float NOT NULL,
  `Quantity` float NOT NULL,
  `TaxValue` float NOT NULL,
  `Amount` float NOT NULL,
  `LEN` float DEFAULT NULL,
  `CHE` float DEFAULT NULL,
  `WE` float DEFAULT NULL,
  `HIP` float DEFAULT NULL,
  `SLEE` float DEFAULT NULL,
  `RIGA` float DEFAULT NULL,
  `FAR` float DEFAULT NULL,
  `BOX` float DEFAULT NULL,
  `NOR` float DEFAULT NULL,
  `BOT` float DEFAULT NULL,
  `NECK` float DEFAULT NULL,
  `AssignDate` date DEFAULT NULL,
  `ReadyDate` date DEFAULT NULL,
  `DeliveredDate` date DEFAULT NULL,
  `SaleDate` date DEFAULT NULL,
  `Ready` enum('1','0') NOT NULL DEFAULT '0',
  `Sale` enum('1','0') NOT NULL DEFAULT '0',
  `Status` varchar(25) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`OrderItemID`, `OrderFormID`, `OrderNo`, `BookNo`, `ItemSl`, `ItemName`, `ServiceID`, `DesignID`, `WFQuantity`, `ImageID`, `TaxRate`, `TaxMethod`, `Rate`, `Quantity`, `TaxValue`, `Amount`, `LEN`, `CHE`, `WE`, `HIP`, `SLEE`, `RIGA`, `FAR`, `BOX`, `NOR`, `BOT`, `NECK`, `AssignDate`, `ReadyDate`, `DeliveredDate`, `SaleDate`, `Ready`, `Sale`, `Status`) VALUES
(1, 1, '1500', '30', 1, 'Test Customer', 1, 5, 2, 17, 5, 'exclusive', 350, 1, 17.5, 367.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'new'),
(2, 2, '123', '3', 1, 'Test Customer', 1, 7, 2, 19, 5, 'exclusive', 250, 5, 62.5, 1312.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-03', '2019-01-03', '2019-01-03', NULL, '1', '0', 'delivered'),
(3, 2, '124', '3', 2, 'Item No 2', 1, 1, 1, 14, 5, 'exclusive', 475, 3, 71.25, 1496.25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-03', '2019-01-03', '2019-01-03', NULL, '1', '0', 'delivered'),
(4, 3, '578', '12', 1, 'Suhail', 1, 7, 1, 19, 5, 'exclusive', 238.1, 1, 11.9, 250, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'new'),
(5, 3, '579', '12', 2, 'Item No 2', 1, 4, 1, 16, 5, 'exclusive', 219.05, 1, 10.95, 230, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'new'),
(6, 3, '580', '12', 3, 'Item No 3', 1, 1, 1, 14, 5, 'exclusive', 476.19, 1, 23.81, 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-03', '2019-01-03', '2019-01-03', '2019-01-14', '1', '1', 'delivered'),
(7, 4, '512', '11', 1, 'Suhail', 3, 0, 0, 0, 5, 'inclusive', 100, 1, 4.76, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-03', '2019-01-03', NULL, '2019-01-14', '1', '1', 'ready'),
(8, 5, '512', '11', 1, 'Suhail', 1, 5, 2, 17, 5, 'exclusive', 333.33, 1, 16.67, 350, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `Type` enum('received','given') NOT NULL,
  `PaymentTypeID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `ReferenceNo` varchar(50) NOT NULL,
  `SaleID` int(11) NOT NULL,
  `PurchaseID` int(11) NOT NULL,
  `OrderFormID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `Amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `Type`, `PaymentTypeID`, `PaymentDate`, `ReferenceNo`, `SaleID`, `PurchaseID`, `OrderFormID`, `CustomerID`, `SupplierID`, `Amount`) VALUES
(1, 'received', 1, '2018-04-25', '1500', 0, 0, 1, 1, 0, 100),
(2, 'received', 1, '2019-01-03', '123', 0, 0, 2, 1, 0, 800),
(3, 'received', 2, '2019-01-03', '1250', 4, 0, 3, 2, 0, 500),
(4, 'received', 1, '2019-01-03', '512', 0, 0, 4, 2, 0, 50),
(5, 'received', 1, '2019-01-13', '512', 0, 0, 4, 2, 0, 10),
(7, 'received', 1, '2019-01-14', '512', 0, 0, 5, 2, 0, 150),
(11, 'received', 2, '2019-01-14', '1250', 4, 0, 0, 2, 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `payment_type`
--

CREATE TABLE `payment_type` (
  `PaymentTypeID` int(11) NOT NULL,
  `PaymentTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_type`
--

INSERT INTO `payment_type` (`PaymentTypeID`, `PaymentTypeName`) VALUES
(1, 'Order Advance'),
(2, 'Sale Amount'),
(3, 'Purchase Amount');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductCode` varchar(50) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `UnitsID` int(11) NOT NULL,
  `TaxID` int(11) NOT NULL,
  `TaxMethod` enum('inclusive','exclusive') NOT NULL DEFAULT 'exclusive',
  `ProductCost` float NOT NULL,
  `ProductPrice` float NOT NULL,
  `ImageID` int(11) NOT NULL,
  `UseExpireDate` enum('0','1') NOT NULL DEFAULT '0',
  `ReferenceNo` varchar(50) NOT NULL,
  `ReOrderLevel` int(11) NOT NULL,
  `ManufactureID` int(11) NOT NULL,
  `ProductActive` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductCode`, `ProductName`, `CategoryID`, `UnitsID`, `TaxID`, `TaxMethod`, `ProductCost`, `ProductPrice`, `ImageID`, `UseExpireDate`, `ReferenceNo`, `ReOrderLevel`, `ManufactureID`, `ProductActive`) VALUES
(7, '1008', 'The One Royal Night by Dolc', 1, 7, 7, 'inclusive', 250, 300, 5, '0', '', 0, 0, '1'),
(8, '1007', 'Hugo Boss Just Different Eau de', 1, 7, 7, 'exclusive', 100, 130, 6, '0', '', 0, 0, '1'),
(9, '1006', 'Versace Man Eau Fraiche', 1, 7, 7, 'exclusive', 150, 200, 7, '0', '', 0, 0, '1'),
(10, '1005', 'Hypnose Homme By Lancome For Men', 1, 7, 7, 'exclusive', 180, 220, 8, '0', '', 0, 0, '1'),
(11, '1004', 'La Vie Est Belle by Lancome for Women', 1, 7, 7, 'exclusive', 250, 320, 9, '0', '', 0, 0, '1'),
(12, '1002', 'Black XS for her by Paco Rabanne for Women', 1, 7, 7, 'exclusive', 140, 170, 10, '0', '', 0, 0, '1'),
(13, '1001', 'Euphoria by Calvin Klein for Women', 1, 7, 7, 'exclusive', 100, 130, 11, '0', '', 0, 0, '1'),
(14, 'AB01', 'Abaya Cloth Grade A', 1, 9, 7, 'exclusive', 8, 12, 32, '0', '', 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_batch`
--

CREATE TABLE `product_batch` (
  `ProductBatchID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `BatchNo` varchar(100) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `Status` enum('new','old') NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_mu`
--

CREATE TABLE `product_mu` (
  `ProductMUID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Barcode` varchar(50) NOT NULL,
  `UnitsID` int(11) NOT NULL,
  `Quantity` float NOT NULL,
  `Cost` float NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_mu`
--

INSERT INTO `product_mu` (`ProductMUID`, `ProductID`, `Barcode`, `UnitsID`, `Quantity`, `Cost`, `Price`) VALUES
(1, 14, 'ab02', 10, 80, 60, 85);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `PurchaseID` int(11) NOT NULL,
  `ItemNo` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `WarehouseID` int(11) NOT NULL,
  `ReferenceNo` varchar(100) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `Discount` float NOT NULL,
  `Amount` float NOT NULL,
  `TaxRate` float NOT NULL,
  `TaxAmount` float NOT NULL,
  `TotalAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`PurchaseID`, `ItemNo`, `SupplierID`, `WarehouseID`, `ReferenceNo`, `PurchaseDate`, `Discount`, `Amount`, `TaxRate`, `TaxAmount`, `TotalAmount`) VALUES
(1, 2, 1, 2, 'dsfdsf', '2018-11-19', 4, 180, 5, 9, 185);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `PurchaseItemID` int(11) NOT NULL,
  `ItemSl` int(11) NOT NULL,
  `PurchaseID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductBatchID` int(11) NOT NULL DEFAULT '0',
  `ProductMUID` int(11) NOT NULL DEFAULT '0',
  `ProductCost` float NOT NULL,
  `Quantity` float NOT NULL,
  `Price` float NOT NULL,
  `MUStat` varchar(10) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`PurchaseItemID`, `ItemSl`, `PurchaseID`, `ProductID`, `ProductBatchID`, `ProductMUID`, `ProductCost`, `Quantity`, `Price`, `MUStat`) VALUES
(1, 2, 1, 10, 0, 0, 180, 1, 180, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `SaleID` int(11) NOT NULL,
  `ReferenceNo` varchar(50) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `SaleDate` date NOT NULL,
  `Total` float NOT NULL,
  `TaxAmount` float NOT NULL,
  `Discount` float NOT NULL,
  `TotalAmount` float NOT NULL,
  `ItemNo` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`SaleID`, `ReferenceNo`, `CustomerID`, `SaleDate`, `Total`, `TaxAmount`, `Discount`, `TotalAmount`, `ItemNo`, `Status`) VALUES
(4, '1250', 2, '2019-01-14', 571.43, 28.57, 10, 590, 3, 'new');

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `SaleItemID` int(11) NOT NULL,
  `SaleID` int(11) NOT NULL,
  `ItemType` enum('order','product') NOT NULL,
  `ProductID` int(20) NOT NULL DEFAULT '0',
  `OrderItemID` int(20) NOT NULL DEFAULT '0',
  `CheckOrderItem` int(20) NOT NULL DEFAULT '0',
  `ItemSl` int(11) NOT NULL,
  `TaxRate` float NOT NULL,
  `TaxMethod` enum('inclusive','exclusive') NOT NULL,
  `Rate` float NOT NULL,
  `Quantity` float NOT NULL,
  `TaxValue` float NOT NULL,
  `Amount` float NOT NULL,
  `MUStat` enum('yes','no') NOT NULL DEFAULT 'no',
  `ProductMUID` int(11) NOT NULL,
  `ProductBatchID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`SaleItemID`, `SaleID`, `ItemType`, `ProductID`, `OrderItemID`, `CheckOrderItem`, `ItemSl`, `TaxRate`, `TaxMethod`, `Rate`, `Quantity`, `TaxValue`, `Amount`, `MUStat`, `ProductMUID`, `ProductBatchID`) VALUES
(10, 4, 'order', 0, 6, 0, 2, 5, 'exclusive', 476.19, 1, 23.81, 500, 'no', 0, 0),
(11, 4, 'order', 0, 7, 0, 3, 5, 'inclusive', 100, 1, 4.76, 100, 'no', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(100) NOT NULL,
  `TaxID` int(11) NOT NULL,
  `TaxMethod` enum('inclusive','exclusive') NOT NULL DEFAULT 'exclusive',
  `ServicePrice` float NOT NULL,
  `ImageID` int(11) NOT NULL,
  `WFServiceID` int(11) NOT NULL DEFAULT '0',
  `ServiceActive` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`ServiceID`, `ServiceName`, `TaxID`, `TaxMethod`, `ServicePrice`, `ImageID`, `WFServiceID`, `ServiceActive`) VALUES
(1, 'Abaya', 7, 'exclusive', 300, 12, 2, '1'),
(2, 'Shawl', 7, 'inclusive', 50, 13, 0, '1'),
(3, 'Test Service', 7, 'inclusive', 100, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `StaffName` varchar(50) NOT NULL,
  `StaffPhone` varchar(20) NOT NULL,
  `StaffEmail` varchar(20) NOT NULL,
  `FullTimeStaff` enum('1','0') NOT NULL DEFAULT '1',
  `UserTypeID` int(11) NOT NULL,
  `UserActive` enum('1','0') NOT NULL DEFAULT '0',
  `UserID` int(11) NOT NULL DEFAULT '0',
  `StaffAddress` varchar(100) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `StaffActive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `StaffPhone`, `StaffEmail`, `FullTimeStaff`, `UserTypeID`, `UserActive`, `UserID`, `StaffAddress`, `ImageID`, `StaffActive`) VALUES
(1, 'Test Tailor', '0557558585', '', '1', 5, '0', 0, '', 33, '1');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `StockID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductBatchID` int(11) NOT NULL DEFAULT '0',
  `Quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`StockID`, `ProductID`, `ProductBatchID`, `Quantity`) VALUES
(1, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(50) NOT NULL,
  `SupplierEmail` varchar(20) NOT NULL,
  `SupplierPhone` varchar(20) NOT NULL,
  `SupplierAddress` varchar(100) NOT NULL,
  `TRN` varchar(50) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `SupplierActive` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `SupplierEmail`, `SupplierPhone`, `SupplierAddress`, `TRN`, `ImageID`, `SupplierActive`) VALUES
(1, 'test', '', '055', '', '', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `TaxID` int(11) NOT NULL,
  `TaxName` varchar(20) NOT NULL,
  `TaxRate` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`TaxID`, `TaxName`, `TaxRate`) VALUES
(7, 'Vat 5%', 5),
(9, 'No Vat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `UnitsID` int(11) NOT NULL,
  `UnitsName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`UnitsID`, `UnitsName`) VALUES
(7, 'Nos'),
(8, 'Box'),
(9, 'MTR'),
(10, 'ROOLL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(50) NOT NULL,
  `UserTypeID` int(11) NOT NULL,
  `ImageID` int(11) NOT NULL,
  `UserActive` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `UserPassword`, `UserTypeID`, `ImageID`, `UserActive`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `UserTypeID` int(11) NOT NULL,
  `UserTypeName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`UserTypeID`, `UserTypeName`) VALUES
(1, 'admin'),
(2, 'manager'),
(3, 'superwiser'),
(4, 'salesman'),
(5, 'tailor');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `WarehouseID` int(11) NOT NULL,
  `WarehouseName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`WarehouseID`, `WarehouseName`) VALUES
(2, 'Main Shop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `design`
--
ALTER TABLE `design`
  ADD PRIMARY KEY (`DesignID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ImageID`);

--
-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
  ADD PRIMARY KEY (`ManufactureID`);

--
-- Indexes for table `order_assign`
--
ALTER TABLE `order_assign`
  ADD PRIMARY KEY (`OrderAssignID`);

--
-- Indexes for table `order_form`
--
ALTER TABLE `order_form`
  ADD PRIMARY KEY (`OrderFormID`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `payment_type`
--
ALTER TABLE `payment_type`
  ADD PRIMARY KEY (`PaymentTypeID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `product_batch`
--
ALTER TABLE `product_batch`
  ADD PRIMARY KEY (`ProductBatchID`);

--
-- Indexes for table `product_mu`
--
ALTER TABLE `product_mu`
  ADD PRIMARY KEY (`ProductMUID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`PurchaseID`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`PurchaseItemID`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`SaleID`);

--
-- Indexes for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`SaleItemID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`StockID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`TaxID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`UnitsID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`UserTypeID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`WarehouseID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `design`
--
ALTER TABLE `design`
  MODIFY `DesignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
  MODIFY `ManufactureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_assign`
--
ALTER TABLE `order_assign`
  MODIFY `OrderAssignID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_form`
--
ALTER TABLE `order_form`
  MODIFY `OrderFormID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `OrderItemID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `payment_type`
--
ALTER TABLE `payment_type`
  MODIFY `PaymentTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `product_batch`
--
ALTER TABLE `product_batch`
  MODIFY `ProductBatchID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_mu`
--
ALTER TABLE `product_mu`
  MODIFY `ProductMUID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `PurchaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `PurchaseItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `SaleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `SaleItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `TaxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `UnitsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `UserTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `WarehouseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
