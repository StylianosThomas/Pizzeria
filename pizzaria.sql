-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2019 at 06:34 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pizza`
--
CREATE DATABASE IF NOT EXISTS `pizzaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pizzaria`;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `Customer_ID` int(10) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Street_Address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `House_Number` int(10) NOT NULL,
  `City` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Customer_ID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`Customer_ID`, `First_Name`, `Last_Name`, `Email`, `Password`, `Street_Address`, `House_Number`, `City`) VALUES
(1, 'testname', 'testsurname', 'testemail@email.com', 'testpassword', 'teststreet', 10, 'testcity');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `Order_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Total_Price` float NOT NULL,
  `Order_Date` int(11) NOT NULL,
  `Customer` int(10) NOT NULL,
  PRIMARY KEY (`Order_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE IF NOT EXISTS `pizzas` (
  `Pizza_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Pizza_Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ingredients` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Price` float NOT NULL,
  PRIMARY KEY (`Pizza_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`Pizza_ID`, `Pizza_Name`, `Ingredients`, `Price`) VALUES
(1, 'Margarita', 'Mozzarella, gouda, tomato sauce', 5.90),
(2, 'Chicken Barbeque', 'Barbeque sauce, mozzarella, chicken, fresh mushrooms', 8.10),
(3, 'Siciliana', 'Mozzarella, fresh tomatoes, olive oil, corn, bacon, parsley, mix of spices', 6.25),
(4, 'Special', 'Gouda, tomato sauce, pepperoni, sausage, ham, bacon, fresh mushrooms, green peppers', 8.10),
(5, 'Chicken Philadelphia', 'Philadelphia cheese, mozzarella, chicken, caramelized onions', 6.50),
(6, 'Four Cheeses', 'White sauce, gouda, parmesan, mozzarella, blue cheese', 8.10),
(7, 'Texas Barbeque', 'Barbeque sauce, gouda, chicken, fresh mushrooms, fresh tomatoes, green peppers', 8.25),
(8, 'Madona', 'Mozzarella, fresh tomato, mix of spices, olive oil, parsley, oregano', 4.95),
(9, 'Pepperoni', 'Tomato sause, gouda, pepperoni', 6.75),
(10, 'English', 'Tomato sauce, gouda, bacon, eggs', 8.10),
(11, 'Barbeque Philadelphia', 'Philadelphia, mozzarella, chicken, barbeque sauce', 6.50),
(12, 'Gustosa', 'Tomato sauce, gouda, ham, bacon', 6.70),
(13, 'Mediterranean', 'Tomato sauce, gouda, onions, fresh mushrooms, fresh tomatoes, olives, feta cheese, brie', 8.10),
(14, 'Greek', 'Tomato sauce, gouda, feta cheese, fresh tomatoes, onions, olives, green peppers', 7.45),
(15, 'German', 'Tomato sause, gouda, smoked ham, pepperoni, sausage', 8.10),
(16, 'Ceasar', 'Gouda, chicken, bacon, ceasar sause, parsley', 8.10),
(17, 'Chicken Buffalo', 'Blue cheese sause, mozzarella, chicken nuggets, bacon, sriracha mild sauce', 8.00),
(18, 'Smoked', 'Tomato sause, gouda, turkey, smoked ham, onions', 7.80);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
