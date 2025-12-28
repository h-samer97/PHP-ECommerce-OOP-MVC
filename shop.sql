-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2025 at 05:02 PM
-- Server version: 10.11.11-MariaDB
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(4) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Order` int(11) NOT NULL,
  `Visibility` tinyint(4) DEFAULT 0,
  `Allow_Comment` tinyint(4) DEFAULT 0,
  `Allow_Ads` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `Order`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(1, 'Electronics', 'Electronic devices and gadgets', 1, 1, 1, 1),
(5, 'Books', 'All kinds of books', 5, 1, 1, 0),
(11, 'Computers', 'PCs and laptops', 11, 1, 1, 1),
(12, 'Phones', 'Mobile phones', 12, 1, 1, 1),
(16, 'Movies', 'DVDs and Blu-rays', 16, 1, 0, 1),
(54, 'Home Appliances', 'Refrigerators, washing machines, microwaves', 3, 1, 1, 1),
(55, 'Fashion', 'Clothing, shoes, accessories', 4, 1, 1, 1),
(56, 'Beauty & Health', 'Cosmetics, skincare, vitamins', 5, 1, 1, 0),
(57, 'Sports & Outdoors', 'Fitness equipment, camping gear', 6, 1, 1, 1),
(58, 'Automotive', 'Car parts, accessories, tools', 7, 1, 1, 1),
(59, 'Gaming', 'Video games, consoles, accessories', 8, 1, 1, 0),
(60, 'Office Supplies', 'Stationery, furniture, equipment', 9, 1, 0, 1),
(61, 'Pet Supplies', 'Pet food, toys, accessories', 10, 1, 1, 1),
(62, 'Baby & Kids', 'Toys, clothes, baby gear', 11, 1, 1, 0),
(63, 'Jewelry', 'Rings, necklaces, watches', 12, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `status_com` tinyint(4) DEFAULT 0,
  `Added_date` date DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comments`, `status_com`, `Added_date`, `item_id`, `user_id`) VALUES
(1, 'Great article! Learned a lot.', 0, '2025-11-01', 1, 1),
(7, 'Very helpful, bookmarked!', 1, '2025-11-07', 1, 1),
(8, 'Spam comment here', 0, '2025-11-08', 1, 1),
(9, 'Looking forward to more posts like this.', 1, '2025-11-09', 1, 1),
(10, 'Typo in the second paragraph.', 1, '2025-11-10', 1, 1),
(11, 'Can I reuse this code?', 1, '2025-11-11', 1, 1),
(12, 'h.samer97', 0, '2025-12-03', 121, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Item_id` int(11) NOT NULL,
  `Item_name` varchar(100) NOT NULL,
  `Item_description` text DEFAULT NULL,
  `Price` varchar(100) NOT NULL,
  `Add_Date` datetime NOT NULL,
  `Country_Made` varchar(100) NOT NULL,
  `Image` blob DEFAULT NULL,
  `Status_Item` varchar(255) NOT NULL,
  `Rating` tinyint(4) DEFAULT NULL,
  `Cat_ID` int(11) DEFAULT NULL,
  `Member_ID` int(11) DEFAULT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Item_id`, `Item_name`, `Item_description`, `Price`, `Add_Date`, `Country_Made`, `Image`, `Status_Item`, `Rating`, `Cat_ID`, `Member_ID`, `Approve`) VALUES
(1, 'LG OLED C1', '55\" 4K Smart TV', '1499.99', '2023-07-10 16:00:00', 'South Korea', NULL, 'New', 5, 1, 1, 1),
(2, 'Microsoft Surface Pro 8', '2-in-1 laptop with Windows 11', '1099.99', '2023-07-15 10:30:00', 'China', NULL, 'New', 4, 11, 1, 1),
(3, 'Ring Video Doorbell', 'WiFi enabled doorbell with camera', '99.99', '2023-09-10 11:45:00', 'USA', NULL, 'New', 4, 1, 1, 1),
(27, 'Samsung Galaxy Watch 4', 'Smartwatch with Wear OS', '249.99', '2023-09-15 16:15:00', 'South Korea', NULL, 'New', 4, 1, 1, 1),
(38, 'Echo Dot (4th Gen)', 'Smart speaker with Alexa', '49.99', '2024-01-10 09:45:00', 'China', NULL, 'New', 4, 1, 39, 1),
(41, 'Google Nest Hub', 'Smart display with Google Assistant', '89.99', '2024-02-10 16:30:00', 'China', NULL, 'New', 4, 1, 42, 1),
(44, 'Jabra Elite 85VvVvVvV', 'True wireless earbuds', '229.999', '2024-03-10 14:30:00', 'Denmark', NULL, '0', 2, 16, 25, 1),
(51, 'Razer Blade 15', 'Gaming laptop with RTX 3070', '2299.99', '2024-05-15 12:15:00', 'China', NULL, 'New', 5, 11, 52, 1),
(52, 'Samsung The Frame', '55\" 4K QLED Smart TV', '1499.99', '2024-06-01 14:30:00', 'South Korea', NULL, 'New', 5, 1, 53, 1),
(54, 'TCL 6-Series', '65\" 4K QLED Smart TV', '999.99', '2024-06-15 09:00:00', 'China', NULL, 'New', 4, 1, 55, 1),
(56, 'Vizio M-Series', '', '699.99', '2024-07-10 13:30:00', 'USA', NULL, 'New', 4, 1, 57, 1),
(70, '', '', '', '2025-11-25 08:25:29', '', NULL, '', 3, NULL, NULL, 0),
(71, 'sfsgf', 'fsgs', '43535', '2025-11-26 11:08:37', 'gdfg', NULL, '0', 3, 12, 30, 0),
(114, 'Samsung Galaxy S24 Ultra', '6.8-inch smartphone with 200MP camera, 12GB RAM', '1299.99', '2024-06-03 09:15:00', 'South Korea', NULL, 'New', 4, 12, 46, 1),
(115, 'Bose SoundLink Flex', 'Portable Bluetooth speaker with waterproof design', '149', '2024-06-04 14:20:00', 'USA', NULL, '0', 4, 58, 50, 1),
(116, 'Microsoft Xbox Series X', '1TB gaming console with 4K gaming capability', '499.99', '2024-06-05 16:45:00', 'China', NULL, 'New', 5, 1, 48, 1),
(117, 'Dell XPS 15', '15.6-inch laptop, Intel i7, 16GB RAM, 512GB SSD', '1599.99', '2024-06-06 10:00:00', 'USA', NULL, 'New', 5, 11, 49, 1),
(118, 'ASUS ROG Strix G16', 'Gaming laptop with RTX 4060, 16GB RAM, 1TB SSD', '1499.99', '2024-06-07 11:30:00', 'Taiwan', NULL, 'New', 4, 11, 50, 1),
(119, 'HP Spectre x360', '2-in-1 convertible laptop, 13.5-inch OLED display', '1349.99', '2024-06-08 13:45:00', 'China', NULL, 'New', 4, 11, 51, 1),
(120, 'Lenovo ThinkPad X1 Carbon', 'Business laptop with Intel i5, 16GB RAM', '1499.00', '2024-06-09 15:20:00', 'China', NULL, 'New', 5, 11, 52, 1),
(121, 'Apple iMac 24-inch', 'All-in-one computer with M3 chip, 8GB RAM', '1299.00', '2024-06-10 09:30:00', 'USA', NULL, 'New', 5, 11, 53, 1),
(122, 'iPhone 15 Pro Max', '6.7-inch Super Retina XDR display, 256GB', '1199.00', '2024-06-11 10:15:00', 'China', NULL, 'New', 5, 12, 54, 1),
(123, 'Google Pixel 8 Pro', '6.7-inch smartphone with Tensor G3 chip', '999.00', '2024-06-12 11:45:00', 'China', NULL, 'New', 4, 12, 55, 1),
(124, 'OnePlus 12', '6.82-inch AMOLED display, Snapdragon 8 Gen 3', '799.99', '2024-06-13 14:30:00', 'China', NULL, 'New', 4, 12, 56, 1),
(125, 'Samsung Galaxy Z Fold5', 'Foldable smartphone with 7.6-inch main display', '1799.99', '2024-06-14 16:00:00', 'South Korea', NULL, 'New', 5, 12, 57, 1),
(126, 'Nothing Phone 2', 'Glyph interface, Snapdragon 8+ Gen 1', '599.00', '2024-06-15 09:45:00', 'China', NULL, 'New', 4, 12, 59, 1),
(128, 'Samsung Front Load Washeryyyy', '4.5 cu.ft. capacity with steam sanitize.............', '1099.99', '2024-06-17 11:15:00', 'South Korea', NULL, '0', 4, 57, 50, 1),
(131, 'Breville Barista Express', 'Espresso machine with built-in grinder', '699.95', '2024-06-20 09:00:00', 'Australia', NULL, 'New', 5, 1, 64, 1),
(132, 'Nike Air Force 1', 'Classic leather sneakers in white', '110.00', '2024-06-21 10:45:00', 'Vietnam', NULL, 'New', 5, 5, 65, 1),
(133, 'Levi\'s 501 Original Jeans', 'Classic straight fit jeans', '89.50', '2024-06-22 12:30:00', 'Mexico', NULL, 'New', 4, 5, 66, 1),
(134, 'Ray-Ban Aviator Sunglasses', 'Classic aviator style with green lenses', '153.00', '2024-06-23 14:15:00', 'Italy', NULL, 'New', 5, 5, 67, 1),
(135, 'Patagonia Nano Puff Jacket', 'Lightweight insulated jacket', '229.00', '2024-06-24 16:00:00', 'Vietnam', NULL, 'New', 5, 5, 68, 1),
(136, 'Rolex Submariner Date', 'Stainless steel dive watch with black dial', '13500.00', '2024-06-25 09:30:00', 'Switzerland', NULL, 'New', 5, 5, 69, 1),
(137, 'Yeti Tundra 65 Cooler', 'Hard cooler with 65-quart capacity', '399.99', '2024-06-26 11:00:00', 'USA', NULL, 'New', 5, 16, 70, 1),
(138, 'Peloton Bike+', 'Indoor cycling bike with rotating screen', '2495.00', '2024-06-27 13:45:00', 'USA', NULL, 'New', 4, 16, 71, 1),
(139, 'Coleman Sundome Tent', '4-person dome tent with weatherproof design', '89.99', '2024-06-28 15:30:00', 'USA', NULL, 'New', 4, 16, 72, 1),
(140, 'Wilson NFL Official Football', 'Official size and weight football', '99.99', '2024-06-29 10:15:00', 'USA', NULL, 'New', 4, 16, 73, 1),
(141, 'Specialized Allez Sport Bike', 'Road bike with Shimano Claris groupset', '1200.00', '2024-06-30 14:00:00', 'Taiwan', NULL, 'New', 5, 16, 75, 1),
(142, 'The Hobbit by J.R.R. Tolkien', 'Hardcover edition with illustrated maps', '25.99', '2024-07-01 09:45:00', 'UK', NULL, 'New', 5, 5, 76, 1),
(143, 'Atomic Habits by James Clear', 'Paperback edition about habit formation', '16.99', '2024-07-02 11:30:00', 'USA', NULL, 'New', 5, 5, 77, 1),
(144, 'Harry Potter Box Set', 'Complete 7-book set in hardcover', '189.99', '2024-07-03 13:15:00', 'UK', NULL, 'New', 5, 5, 78, 1),
(145, 'Project Hail Mary by Andy Weir', 'Science fiction novel hardcover', '28.99', '2024-07-04 15:00:00', 'USA', NULL, 'New', 5, 5, 79, 1),
(146, 'The Silent Patient by Alex Michaelides', 'Psychological thriller paperback', '14.99', '2024-07-05 10:45:00', 'UK', NULL, 'New', 4, 5, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE `item_tags` (
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `item_tags`
--

INSERT INTO `item_tags` (`item_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 3),
(3, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `item_tags_view`
-- (See below for the actual view)
--
CREATE TABLE `item_tags_view` (
`Item_id` int(11)
,`Item_name` varchar(100)
,`tag_id` int(11)
,`tag_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `type` enum('info','warning','success','error') DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `type`, `is_read`, `created_at`) VALUES
(1, 1, 'Your order #ORD-2025-12345 has been shipped', 'success', 0, '2025-12-17 05:30:00'),
(2, 1, 'New order #ORD-2025-12346 has been received', 'info', 1, '2025-12-17 04:45:00'),
(3, 1, 'Payment for order #ORD-2025-12344 has been confirmed', 'success', 1, '2025-12-16 11:20:00'),
(4, 44, 'Your item \"Sony WH-1000XM5\" has been approved and published', 'success', 1, '2025-12-16 07:15:00'),
(5, 45, 'New comment on your item \"Apple MacBook Air M2\"', 'info', 0, '2025-12-17 05:00:00'),
(6, 46, 'Your item \"Samsung Galaxy S24 Ultra\" received 5-star rating', 'success', 1, '2025-12-15 13:30:00'),
(7, 18, 'Welcome to our platform! Complete your profile to get started', 'info', 0, '2025-12-17 05:44:00'),
(8, 29, 'Your account has been verified successfully', 'success', 1, '2025-12-16 06:15:00'),
(9, 35, 'Security alert: New login detected from new device', 'warning', 0, '2025-12-17 05:20:00'),
(10, 1, 'System maintenance scheduled for tonight 2:00 AM - 4:00 AM', 'warning', 0, '2025-12-17 05:40:00'),
(11, 1, 'Backup completed successfully', 'success', 1, '2025-12-17 00:00:00'),
(12, 1, 'New user registration requires approval', 'info', 0, '2025-12-17 05:35:00'),
(13, 30, 'Special 20% discount on all electronics this weekend!', 'info', 0, '2025-12-17 05:30:00'),
(14, 25, 'Flash sale starts in 1 hour! Be ready for amazing deals', 'info', 1, '2025-12-16 17:00:00'),
(15, 50, 'Your wishlist item \"iPhone 15 Pro Max\" is now back in stock', 'success', 0, '2025-12-17 05:15:00'),
(16, 45, 'Your comment on \"LG OLED C1\" has received a reply', 'info', 0, '2025-12-17 04:30:00'),
(17, 1, 'New review pending approval for item \"Microsoft Surface Pro 8\"', 'info', 0, '2025-12-17 05:10:00'),
(18, 53, 'Your package will be delivered today between 2:00 PM - 4:00 PM', 'info', 0, '2025-12-17 05:25:00'),
(19, 60, 'Delivery attempted but no one was home. Please reschedule', 'warning', 0, '2025-12-17 05:05:00'),
(20, 44, 'Low stock alert: Only 3 units left of \"Sony WH-1000XM5\"', 'warning', 0, '2025-12-17 05:00:00'),
(21, 55, 'Your item \"TCL 6-Series\" is out of stock', 'error', 0, '2025-12-17 04:45:00'),
(22, 65, 'Payment method updated successfully', 'success', 1, '2025-12-16 15:30:00'),
(23, 70, 'Payment failed for order #ORD-2025-12347. Please update payment method', 'error', 0, '2025-12-17 05:35:00'),
(24, 1, 'New support ticket #TKT-78901 received', 'info', 0, '2025-12-17 05:42:00'),
(25, 80, 'Your support ticket #TKT-78895 has been resolved', 'success', 1, '2025-12-16 14:00:00'),
(26, 1, 'High server load detected. Current usage: 85%', 'warning', 0, '2025-12-17 05:38:00'),
(27, 1, 'Database backup in progress', 'info', 0, '2025-12-17 00:30:00'),
(28, 75, 'Refer a friend and get $20 credit!', 'info', 0, '2025-12-17 05:28:00'),
(29, 68, 'Happy Birthday! Here\'s a special gift for you', 'success', 0, '2025-12-17 05:00:00'),
(30, 1, '5 new items are pending approval', 'info', 0, '2025-12-17 05:44:00'),
(31, 57, 'Your item \"Samsung Galaxy Z Fold5\" has been rejected. Reason: Incomplete description', 'error', 1, '2025-12-16 08:20:00'),
(32, 42, 'Your premium subscription will expire in 7 days', 'warning', 0, '2025-12-17 05:22:00'),
(33, 33, 'You have earned Gold Seller badge!', 'success', 0, '2025-12-17 05:18:00'),
(34, 1, 'طلب جديد من مستخدم عربي يحتاج إلى موافقة', 'info', 0, '2025-12-17 05:40:00'),
(35, 30, 'خصم ٣٠٪ على المنتجات الكهربائية هذا الأسبوع', 'success', 0, '2025-12-17 05:32:00'),
(36, 45, 'User \"john_smith\" is viewing your item \"Apple MacBook Air M2\"', 'info', 0, '2025-12-17 05:44:00'),
(37, 1, '10 new users registered in the last hour', 'info', 0, '2025-12-17 05:30:00'),
(38, 52, 'You have 5 new followers this week', 'success', 1, '2025-12-16 06:00:00'),
(39, 47, 'Your review was helpful to 15 customers', 'success', 0, '2025-12-17 05:10:00'),
(40, 1, 'Daily sales report has been generated', 'info', 1, '2025-12-16 21:30:00'),
(41, 1, 'Monthly analytics report is ready for download', 'info', 0, '2025-12-17 05:33:00'),
(42, 1, 'Failed to process 3 orders. Check error logs', 'error', 0, '2025-12-17 05:15:00'),
(43, 63, 'Unable to upload product images. Please try again', 'error', 0, '2025-12-17 05:05:00'),
(44, 71, 'Congratulations! You\'ve made your first sale', 'success', 1, '2025-12-16 12:45:00'),
(45, 76, 'Your store has reached 1000 followers!', 'success', 0, '2025-12-17 05:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(1, 'الكترونيات'),
(2, 'مستعمل'),
(3, 'جديد'),
(4, 'تخفيض'),
(5, 'شحن مجاني'),
(6, 'wireless'),
(7, 'noise-canceling'),
(8, 'waterproof'),
(9, 'smart'),
(10, 'gaming'),
(11, 'portable'),
(12, 'professional'),
(13, 'luxury'),
(14, 'bestseller'),
(15, 'discount'),
(16, 'new-arrival'),
(17, 'limited-edition'),
(18, 'eco-friendly'),
(19, 'organic'),
(20, 'premium'),
(21, 'budget-friendly'),
(22, 'high-performance'),
(23, 'compact'),
(24, 'energy-efficient'),
(25, 'multifunctional');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `FullName` varchar(40) DEFAULT NULL,
  `UserType` int(11) DEFAULT NULL,
  `TrustStatus` int(11) DEFAULT NULL,
  `RegStatus` int(11) DEFAULT NULL,
  `Date_Reg` date DEFAULT NULL,
  `Avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `FullName`, `UserType`, `TrustStatus`, `RegStatus`, `Date_Reg`, `Avatar`) VALUES
(1, 'rooty', '$2y$10$zixZqNfUoWm53JDvvEbKBOMnGtb/bLHrS.iCzak1I5BoN4NX9pVf2', 'root@ecom.local', 'ali', 0, 0, 1, '2025-11-12', NULL),
(18, 'barbara_white', '5f4dcc3b5aa765d61d8327deb882cf99', 'barbara@example.com', 'Barbara White', 2, 1, 1, '2020-09-01', 'barbara.jpg'),
(19, 'joseph_harris', '5f4dcc3b5aa765d61d8327deb882cf99', 'joseph@example.com', 'Joseph Harris', 2, 1, 1, '2020-09-15', 'joseph.jpg'),
(21, 'thomas_thompson', '5f4dcc3b5aa765d61d8327deb882cf99', 'thomas@example.com', 'Thomas Thompson', 2, 1, 1, '2020-10-15', 'thomas.jpg'),
(22, 'jessica_garcia', '5f4dcc3b5aa765d61d8327deb882cf99', 'jessica@example.com', 'Jessica Garcia', 2, 1, 1, '2020-11-01', 'jessica.jpg'),
(23, 'charles_martinez', '5f4dcc3b5aa765d61d8327deb882cf99', 'charles@example.com', 'Charles Martinez', 2, 1, 1, '2020-11-15', 'charles.jpg'),
(24, 'karen_robinson', '5f4dcc3b5aa765d61d8327deb882cf99', 'karen@example.com', 'Karen Robinson', 2, 1, 1, '2020-12-01', 'karen.jpg'),
(25, 'christopher_clark', '5f4dcc3b5aa765d61d8327deb882cf99', 'christopher@example.com', 'Christopher Clark', 2, 1, 1, '2020-12-15', 'christopher.jpg'),
(26, 'nancy_rodriguez', '5f4dcc3b5aa765d61d8327deb882cf99', 'nancy@example.com', 'Nancy Rodriguez', 2, 1, 1, '2021-01-01', 'nancy.jpg'),
(27, 'daniel_lewis', '5f4dcc3b5aa765d61d8327deb882cf99', 'daniel@example.com', 'Daniel Lewis', 2, 1, 1, '2021-01-15', 'daniel.jpg'),
(28, 'betty_lee', '5f4dcc3b5aa765d61d8327deb882cf99', 'betty@example.com', 'Betty Lee', 2, 1, 1, '2021-02-01', 'betty.jpg'),
(29, 'paul_walker', '5f4dcc3b5aa765d61d8327deb882cf99', 'paul@example.com', 'Paul Walker', 2, 1, 1, '2021-02-15', 'paul.jpg'),
(30, 'dorothy_hall', '5f4dcc3b5aa765d61d8327deb882cf99', 'dorothy@example.com', 'Dorothy Hall', 2, 1, 1, '2021-03-01', 'dorothy.jpg'),
(31, 'mark_allen', '5f4dcc3b5aa765d61d8327deb882cf99', 'mark@example.com', 'Mark Allen', 2, 1, 1, '2021-03-15', 'mark.jpg'),
(32, 'sandra_young', '5f4dcc3b5aa765d61d8327deb882cf99', 'sandra@example.com', 'Sandra Young', 2, 1, 1, '2021-04-01', 'sandra.jpg'),
(33, 'donald_hernandez', '5f4dcc3b5aa765d61d8327deb882cf99', 'donald@example.com', 'Donald Hernandez', 2, 1, 1, '2021-04-15', 'donald.jpg'),
(34, 'ashley_king', '5f4dcc3b5aa765d61d8327deb882cf99', 'ashley@example.com', 'Ashley King', 2, 1, 1, '2021-05-01', 'ashley.jpg'),
(35, 'george_wright', '5f4dcc3b5aa765d61d8327deb882cf99', 'george@example.com', 'George Wright', 2, 1, 1, '2021-05-15', 'george.jpg'),
(36, 'kimberly_lopez', '5f4dcc3b5aa765d61d8327deb882cf99', 'kimberly@example.com', 'Kimberly Lopez', 2, 1, 1, '2021-06-01', 'kimberly.jpg'),
(37, 'matthew_hill', '5f4dcc3b5aa765d61d8327deb882cf99', 'matthew@example.com', 'Matthew Hill', 2, 1, 1, '2021-06-15', 'matthew.jpg'),
(38, 'emma_scott', '5f4dcc3b5aa765d61d8327deb882cf99', 'emma@example.com', 'Emma Scott', 2, 1, 1, '2021-07-01', 'emma.jpg'),
(39, 'anthony_green', '5f4dcc3b5aa765d61d8327deb882cf99', 'anthony@example.com', 'Anthony Green', 2, 1, 1, '2021-07-15', 'anthony.jpg'),
(40, 'melissa_adams', '5f4dcc3b5aa765d61d8327deb882cf99', 'melissa@example.com', 'Melissa Adams', 2, 1, 1, '2021-08-01', 'melissa.jpg'),
(41, 'steven_baker', '5f4dcc3b5aa765d61d8327deb882cf99', 'steven@example.com', 'Steven Baker', 2, 1, 1, '2021-08-15', 'steven.jpg'),
(42, 'debbie_gonzalez', '5f4dcc3b5aa765d61d8327deb882cf99', 'debbie@example.com', 'Debbie Gonzalez', 2, 1, 1, '2021-09-01', 'debbie.jpg'),
(43, 'kevin_nelson', '5f4dcc3b5aa765d61d8327deb882cf99', 'kevin@example.com', 'Kevin Nelson', 2, 1, 1, '2021-09-15', 'kevin.jpg'),
(46, 'rebecca_roberts', '5f4dcc3b5aa765d61d8327deb882cf99', 'rebecca@example.com', 'Rebecca Roberts', 2, 1, 1, '2021-11-01', 'rebecca.jpg'),
(47, 'ronald_turner', '5f4dcc3b5aa765d61d8327deb882cf99', 'ronald@example.com', 'Ronald Turner', 2, 1, 1, '2021-11-15', 'ronald.jpg'),
(48, 'shirley_phillips', '5f4dcc3b5aa765d61d8327deb882cf99', 'shirley@example.com', 'Shirley Phillips', 2, 1, 1, '2021-12-01', 'shirley.jpg'),
(49, 'edward_campbell', '5f4dcc3b5aa765d61d8327deb882cf99', 'edward@example.com', 'Edward Campbell', 2, 1, 1, '2021-12-15', 'edward.jpg'),
(50, 'cynthia_parker', '5f4dcc3b5aa765d61d8327deb882cf99', 'cynthia@example.com', 'Cynthia Parker', 2, 1, 1, '2022-01-01', 'cynthia.jpg'),
(51, 'jason_evans', '5f4dcc3b5aa765d61d8327deb882cf99', 'jason@example.com', 'Jason Evans', 2, 1, 1, '2022-01-15', 'jason.jpg'),
(52, 'angela_edwards', '5f4dcc3b5aa765d61d8327deb882cf99', 'angela@example.com', 'Angela Edwards', 2, 1, 1, '2022-02-01', 'angela.jpg'),
(53, 'jeffrey_collins', '5f4dcc3b5aa765d61d8327deb882cf99', 'jeffrey@example.com', 'Jeffrey Collins', 2, 1, 1, '2022-02-15', 'jeffrey.jpg'),
(54, 'margaret_stewart', '5f4dcc3b5aa765d61d8327deb882cf99', 'margaret@example.com', 'Margaret Stewart', 2, 1, 1, '2022-03-01', 'margaret.jpg'),
(55, 'ryan_sanchez', '5f4dcc3b5aa765d61d8327deb882cf99', 'ryan@example.com', 'Ryan Sanchez', 2, 1, 1, '2022-03-15', 'ryan.jpg'),
(56, 'stephanie_morris', '5f4dcc3b5aa765d61d8327deb882cf99', 'stephanie@example.com', 'Stephanie Morris', 2, 1, 1, '2022-04-01', 'stephanie.jpg'),
(57, 'jacob_rogers', '5f4dcc3b5aa765d61d8327deb882cf99', 'jacob@example.com', 'Jacob Rogers', 2, 1, 1, '2022-04-15', 'jacob.jpg'),
(59, 'gary_cook', '5f4dcc3b5aa765d61d8327deb882cf99', 'gary@example.com', 'Gary Cook', 2, 1, 1, '2022-05-15', 'gary.jpg'),
(60, 'katherine_morgan', '5f4dcc3b5aa765d61d8327deb882cf99', 'katherine@example.com', 'Katherine Morgan', 2, 1, 1, '2022-06-01', 'katherine.jpg'),
(61, 'timothy_bell', '5f4dcc3b5aa765d61d8327deb882cf99', 'timothy@example.com', 'Timothy Bell', 2, 1, 1, '2022-06-15', 'timothy.jpg'),
(62, 'christine_murphy', '5f4dcc3b5aa765d61d8327deb882cf99', 'christine@example.com', 'Christine Murphy', 2, 1, 1, '2022-07-01', 'christine.jpg'),
(63, 'samuel_bailey', '5f4dcc3b5aa765d61d8327deb882cf99', 'samuel@example.com', 'Samuel Bailey', 2, 1, 1, '2022-07-15', 'samuel.jpg'),
(64, 'rachel_rivera', '5f4dcc3b5aa765d61d8327deb882cf99', 'rachel@example.com', 'Rachel Rivera', 2, 1, 1, '2022-08-01', 'rachel.jpg'),
(65, 'patrick_cooper', '5f4dcc3b5aa765d61d8327deb882cf99', 'patrick@example.com', 'Patrick Cooper', 2, 1, 1, '2022-08-15', 'patrick.jpg'),
(66, 'carol_richardson', '5f4dcc3b5aa765d61d8327deb882cf99', 'carol@example.com', 'Carol Richardson', 2, 1, 1, '2022-09-01', 'carol.jpg'),
(67, 'peter_cox', '5f4dcc3b5aa765d61d8327deb882cf99', 'peter@example.com', 'Peter Cox', 2, 1, 1, '2022-09-15', 'peter.jpg'),
(68, 'janet_howard', '5f4dcc3b5aa765d61d8327deb882cf99', 'janet@example.com', 'Janet Howard', 2, 1, 1, '2022-10-01', 'janet.jpg'),
(69, 'harry_ward', '5f4dcc3b5aa765d61d8327deb882cf99', 'harry@example.com', 'Harry Ward', 2, 1, 1, '2022-10-15', 'harry.jpg'),
(70, 'denise_torres', '5f4dcc3b5aa765d61d8327deb882cf99', 'denise@example.com', 'Denise Torres', 2, 1, 1, '2022-11-01', 'denise.jpg'),
(71, 'kenneth_peterson', '5f4dcc3b5aa765d61d8327deb882cf99', 'kenneth@example.com', 'Kenneth Peterson', 2, 1, 1, '2022-11-15', 'kenneth.jpg'),
(72, 'pamela_gray', '5f4dcc3b5aa765d61d8327deb882cf99', 'pamela@example.com', 'Pamela Gray', 2, 1, 1, '2022-12-01', 'pamela.jpg'),
(73, 'scott_ramirez', '5f4dcc3b5aa765d61d8327deb882cf99', 'scott@example.com', 'Scott Ramirez', 2, 1, 1, '2022-12-15', 'scott.jpg'),
(75, 'brandon_watson', '5f4dcc3b5aa765d61d8327deb882cf99', 'brandon@example.com', 'Brandon Watson', 2, 1, 1, '2023-01-15', 'brandon.jpg'),
(76, 'martha_brooks', '5f4dcc3b5aa765d61d8327deb882cf99', 'martha@example.com', 'Martha Brooks', 2, 1, 1, '2023-02-01', 'martha.jpg'),
(77, 'benjamin_kelly', '5f4dcc3b5aa765d61d8327deb882cf99', 'benjamin@example.com', 'Benjamin Kelly', 2, 1, 1, '2023-02-15', 'benjamin.jpg'),
(78, 'cheryl_sanders', '5f4dcc3b5aa765d61d8327deb882cf99', 'cheryl@example.com', 'Cheryl Sanders', 2, 1, 1, '2023-03-01', 'cheryl.jpg'),
(79, 'gregory_price', '5f4dcc3b5aa765d61d8327deb882cf99', 'gregory@example.com', 'Gregory Price', 2, 1, 1, '2023-03-15', 'gregory.jpg'),
(80, 'joyce_bennett', '5f4dcc3b5aa765d61d8327deb882cf99', 'joyce@example.com', 'Joyce Bennett', 2, 1, 1, '2023-04-01', 'joyce.jpg'),
(324, 'saso', '1233321', 'sam@sam.com', 'sfsd', 3, 1, 1, '2025-11-13', ''),
(341, 'Sally', '$2y$10$jLhoYmDeljON5m9l01CqCOtnhvUdZggio3go4jwGPXxRiwnFZ.S.6', 'Sally@gmail.com', 'Sally', 0, 0, 0, '2025-11-12', NULL),
(342, 'ssssssss', '$2y$10$LXYzm9mJeZG93x0oDh79sOmn5jxA5TF7oiNBV.Khhq9QYGX2cLk6G', 'sssss@ss.ss', 'ssssss', 0, 0, 1, '2025-11-12', NULL),
(343, 'sssssss', '$2y$10$Dxw7oqnROB7MA1DAoOZ.2.Kv07Qfg9P5k.2c3e/l46txoBIYIyoSy', 'sssss@ss.sss', 'as', 0, 0, 1, '2025-11-12', NULL),
(344, 'john_smith', '$2y$10$ZxV7MkLpQrT9NwFgHjKl2u', 'john.smith@email.com', 'John Smith', 2, 1, 1, '2024-01-15', NULL),
(345, 'sarah_jones', '$2y$10$AbC8dEfGhIj1K2LmNoPqRs', 'sarah.jones@email.com', 'Sarah Jones', 2, 1, 1, '2024-01-20', NULL),
(346, 'mike_wilson', '$2y$10$TuV3WxYzA1B2C3D4E5F6G7', 'mike.wilson@email.com', 'Mike Wilson', 2, 1, 1, '2024-02-05', NULL),
(347, 'emily_davis', '$2y$10$H8I9J0K1L2M3N4O5P6Q7R8', 'emily.davis@email.com', 'Emily Davis', 2, 1, 1, '2024-02-10', NULL),
(348, 'david_brown', '$2y$10$S9T0U1V2W3X4Y5Z6A7B8C9', 'david.brown@email.com', 'David Brown', 2, 1, 1, '2024-02-25', NULL),
(349, 'lisa_miller', '$2y$10$D0E1F2G3H4I5J6K7L8M9N0', 'lisa.miller@email.com', 'Lisa Miller', 2, 1, 1, '2024-03-03', NULL),
(350, 'robert_taylor', '$2y$10$O1P2Q3R4S5T6U7V8W9X0Y1', 'robert.taylor@email.com', 'Robert Taylor', 2, 1, 1, '2024-03-12', NULL),
(351, 'jennifer_lee', '$2y$10$Z2A3B4C5D6E7F8G9H0I1J2', 'jennifer.lee@email.com', 'Jennifer Lee', 2, 1, 1, '2024-03-18', NULL),
(352, 'william_clark', '$2y$10$K3L4M5N6O7P8Q9R0S1T2U3', 'william.clark@email.com', 'William Clark', 2, 1, 1, '2024-03-25', NULL),
(354, 'james_anderson', '$2y$10$G5H6I7J8K9L0M1N2O3P4Q5', 'james.anderson@email.com', 'James Anderson', 2, 1, 1, '2024-04-08', NULL),
(355, 'jessica_thomas', '$2y$10$R6S7T8U9V0W1X2Y3Z4A5B6', 'jessica.thomas@email.com', 'Jessica Thomas', 2, 1, 1, '2024-04-15', NULL),
(356, 'christopher_martin', '$2y$10$C7D8E9F0G1H2I3J4K5L6M7', 'christopher.martin@email.com', 'Christopher Martin', 2, 1, 1, '2024-04-22', NULL),
(357, 'ashley_king', '$2y$10$N8O9P0Q1R2S3T4U5V6W7X8', 'ashley.king@email.com', 'Ashley King', 2, 1, 1, '2024-04-30', NULL),
(358, 'matthew_scott', '$2y$10$Y9Z0A1B2C3D4E5F6G7H8I9', 'matthew.scott@email.com', 'Matthew Scott', 2, 1, 1, '2024-05-05', NULL),
(359, 'olivia_young', '$2y$10$J0K1L2M3N4O5P6Q7R8S9T0', 'olivia.young@email.com', 'Olivia Young', 2, 1, 1, '2024-05-12', NULL),
(360, 'daniel_hall', '$2y$10$U1V2W3X4Y5Z6A7B8C9D0E1', 'daniel.hall@email.com', 'Daniel Hall', 2, 1, 1, '2024-05-20', NULL),
(361, 'sophia_adams', '$2y$10$F2G3H4I5J6K7L8M9N0O1P2', 'sophia.adams@email.com', 'Sophia Adams', 2, 1, 1, '2024-05-28', NULL),
(362, 'joseph_nelson', '$2y$10$Q3R4S5T6U7V8W9X0Y1Z2A3', 'joseph.nelson@email.com', 'Joseph Nelson', 2, 1, 1, '2024-06-04', NULL),
(363, 'megan_carter', '$2y$10$B4C5D6E7F8G9H0I1J2K3L4', 'megan.carter@email.com', 'Megan Carter', 2, 1, 1, '2024-06-10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `item_comments` (`item_id`),
  ADD KEY `comments_users` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Item_id`),
  ADD UNIQUE KEY `Item_name` (`Item_name`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD PRIMARY KEY (`item_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

-- --------------------------------------------------------

--
-- Structure for view `item_tags_view`
--
DROP TABLE IF EXISTS `item_tags_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `item_tags_view`  AS SELECT `items`.`Item_id` AS `Item_id`, `items`.`Item_name` AS `Item_name`, `tags`.`tag_id` AS `tag_id`, `tags`.`tag_name` AS `tag_name` FROM ((`items` join `item_tags` on(`items`.`Item_id` = `item_tags`.`item_id`)) join `tags` on(`item_tags`.`tag_id` = `tags`.`tag_id`)) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_comments` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_tags`
--
ALTER TABLE `item_tags`
  ADD CONSTRAINT `item_tags_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`Item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
