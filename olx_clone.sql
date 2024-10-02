-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: olx_clone
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `rating` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'Villa on Grand Avenue','Luxurious villa with a great view.',3000.00,'feature-1.jpg','Michael Bean','Electronics',5),(2,'Modern Apartment','Compact apartment in the city center.',2000.00,'feature-2.jpg','Sarah Smith','Electronics',4),(3,'Spacious House','A large house with a garden.',3500.00,'feature-3.jpg','John Doe','Electronics',5);
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `count` int NOT NULL,
  `shape1` varchar(255) NOT NULL,
  `shape2` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Property','icon-6',52,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(2,'Home Appliances','icon-7',20,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(3,'Electronics','icon-8',35,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(4,'Health & Beauty','icon-9',10,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(5,'Automotive','icon-10',27,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(6,'Furnitures','icon-11',52,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(7,'Real Estate','icon-12',20,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png'),(10,'Others','icon-15',27,'assets/images/shape/shape-1.png','assets/images/shape/shape-2.png');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Meeting with team','2024-08-16','2024-08-15 06:18:51'),(2,'Project Deadline','2024-08-20','2024-08-15 06:18:51'),(3,'Client Presentation','2024-08-25','2024-08-15 06:18:51'),(4,'r','2024-08-18','2024-08-15 07:08:51'),(5,'12A','2024-08-15','2024-08-15 19:43:02');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured_ads`
--

DROP TABLE IF EXISTS `featured_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `featured_ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon_class` varchar(255) DEFAULT 'default-icon',
  `author_image` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_role` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `rating` int NOT NULL,
  `rating_count` int NOT NULL,
  `time_ago` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text,
  `reference_images` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured_ads`
--

LOCK TABLES `featured_ads` WRITE;
/*!40000 ALTER TABLE `featured_ads` DISABLE KEYS */;
INSERT INTO `featured_ads` VALUES (53,0,'clasifico/assets/uploads/ads/MI Tv.jpg','default-icon','clasifico/assets/uploads/authors/5 to 20kb (2).jpg','Aman Bahukhandi','For Sell','Electronics','Mi X Series 138 cm (55 inch) Ultra HD (4K) LED',5,0,'Just now','IT Park, Plot 21, SIIDCUL, Sahastradhara Rd, Dehradun, Uttarakhand 248001',37760.00,'The Xiaomi X Series TV presents an unparalleled home entertainment experience with its 4K clarity, bezel-less design, Dolby Vision, Vivid Picture Engine, extensive colour gamut, MEMC Engine Reality Flow, powerful sound, Google TV integration, Patchwall and Patchwall+ access, optimised performance, and future-ready connectivity. Elevate your entertainment journey with the Xiaomi X Series TV and embark on an extraordinary cinematic adventure within the comforts of your own home.',NULL),(115,26,'clasifico/assets/uploads/ads/image.jpeg','default-icon','assets/images/profiles/DP.jpeg','Aman Bahukhandi','For Sell','Automotive','maruti suzuki vitara brezza (2019)',0,0,'Just now','Purvi Patel Nagar, Dehradun',715000.00,'ADDITIONAL VEHICLE INFORMATION:\r\nColor: White\r\nInsurance Type: Comprehensive\r\nMake Month: June\r\nRegistration Place: UK','[\"clasifico\\/assets\\/uploads\\/reference_images\\/image (5).jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/image (4).jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/image (3).jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/image (2).jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/image (1).jpeg\"]'),(116,26,'clasifico/assets/uploads/ads/bike.jpeg','default-icon','assets/images/profiles/DP.jpeg','Aman Bahukhandi','For Sell','Automotive','Standard ABS model showroom condition Lone facility available',0,0,'Just now','CPWD Colony, Dehradun, Uttaranchal',179999.00,'Details\r\nBrand\r\nRoyal Enfield\r\nModel\r\nBullet Standard 350\r\nYear\r\n2022\r\nKM driven\r\n9,932 km\r\nDescription\r\nStandard in very good condition first owner all paper complete near Nagar Nigam Dehradun','[\"clasifico\\/assets\\/uploads\\/reference_images\\/bike 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/bike 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/bike 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/bike 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/bike.jpeg\"]'),(117,26,'clasifico/assets/uploads/ads/mobile.jpeg','default-icon','assets/images/profiles/DP.jpeg','Aman Bahukhandi','For Sell','Electronics','I phone 11 - 128 Gb White 1 hand used phone',0,0,'Just now','Chandralok Colony, Dehradun, Uttaranchal',27500.00,'Details\r\nBrand\r\niPhone\r\nDescription\r\nI phone 11 - 128 Gb White 1 hand used phone Battery Health 86% With Boll Box Original pcs','[\"clasifico\\/assets\\/uploads\\/reference_images\\/mobile 6.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/mobile 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/mobile 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/mobile 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/mobile 2.jpeg\"]'),(118,26,'clasifico/assets/uploads/ads/property.jpeg','default-icon','assets/images/profiles/DP.jpeg','Aman Bahukhandi','For Sell','Property','1BHK NEAR EKTA VIHAR 600sqft | MDDA APP | 25FT ROAD | 300MTR MAIN ROAD',0,0,'Just now','Ekta Vihar, Dehradun, Uttaranchal',2900000.00,'MORDERN 1BHK FLAT\r\n\r\nNEW CONSTRUCTION\r\n\r\nPOSSESSION WITHIN 30 DAYS\r\n\r\nLocation -\r\n\r\nMadhuban Enclave, Near Ekta Vihar Sahastradhara Road, Dehradun\r\n\r\nThis property includes -\r\n\r\n• ⁠Both Side Road\r\n\r\n• ⁠Seprate Store Room\r\n\r\n• 1 Bedroom\r\n\r\n• 1 Bathroom\r\n\r\n• Both Side Balcony\r\n\r\n• Open kitchen\r\n\r\n• Living Room\r\n\r\n• 1 Car Parking\r\n\r\n• 1 Two Wheeler Parking\r\n\r\n• MDDA Approved\r\n\r\n• 90% Loan Available\r\n\r\n• 25ft Wide Road\r\n\r\n• 300mtr From Main Road\r\n\r\n• Free Chimney\r\n\r\n• Free Designer Bed\r\n\r\nNearby -\r\n\r\n• Petrol Pump - 1.5Km\r\n\r\n• Beverly hills shalini school - 400Mtr\r\n\r\n• Hospital - 3Km','[\"clasifico\\/assets\\/uploads\\/reference_images\\/property 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/property 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/property 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/property 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/property 1.jpeg\"]'),(119,26,'clasifico/assets/uploads/ads/proper 1.jpeg','default-icon','assets/images/profiles/DP.jpeg','Aman Bahukhandi','For Sell','Property','3BHK Flats(Ready-to-move) for sale',0,0,'Just now','Chaman Vihar, Dehradun, Uttaranchal',9500000.00,'Flat Description (Fully furnished and semi-furnished):\r\n\r\n• Three big rooms with fall ceiling: 14 ft x 12 ft, 14 ft x 12 ft, 14 ft x 11 ft\r\n\r\n• Drawing room with fall ceiling: 20 ft x 15 ft\r\n\r\n• Kitchen: Modular kitchen with fall ceiling: 10 ft x 10.5 ft\r\n\r\n• Two Bathrooms 1: 9 ft x 7.5 ft and 9 ft x 7 ft\r\n\r\n• Two Balcony 1: 24 ft x 4 ft and 11 ft x 4 ft\r\n\r\n• Store: 6 ft x 6 ft\r\n\r\n• Two almirahs, Three LCD panels, two Big cabinets\r\n\r\nStilt parking (can be used as a party hall)\r\n\r\nElevators(Lift): Available\r\n\r\nCompany Fittings:\r\n\r\n• Bathroom and kitchen accessories (Wash Basin, Taps, Commode Seat): JAGUAR with 8-year warranty\r\n\r\n• Water pipes (PVC & CPVC) by ASTRAL\r\n\r\n• Electricity wires switches: GREAT WHITE and POLYCAB\r\n\r\n• Tile: Vermora, Kajaria\r\n\r\nNearby Key Points:\r\n\r\n• ISBT Bus Adda: 5 km\r\n\r\n• Railway station: 4 km\r\n\r\n• Balliwala Chowk: 1 km\r\n\r\n• Ballupur Chowk: 2 km\r\n\r\n• Forest Research Institute (FRI): 2 km\r\n\r\n• Chief Minister House: 7 km\r\n\r\n• Secretariat: 4.5 km','[\"clasifico\\/assets\\/uploads\\/reference_images\\/proper 6.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/proper 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/proper 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/proper 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/proper 2.jpeg\"]'),(120,57,'clasifico/assets/uploads/ads/scooter 1.jpeg','default-icon','assets/images/profiles/Passport_Photograph.jpg','Aman','For Sell','Automotive','Tvs ntorrq125 race addition first owner finance facility',0,0,'Just now','Race Course, Dehradun, Uttaranchal',75000.00,'Details\r\nBrand\r\nTVS\r\nModel\r\nNTORQ 125\r\nYear\r\n2023\r\nKM driven\r\n13,000 km\r\nDescription\r\nGood condition NTORQ 125 race edition good condition finance facility available','[\"clasifico\\/assets\\/uploads\\/reference_images\\/scooter 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/scooter 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/scooter 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/scooter 1.jpeg\"]'),(121,57,'clasifico/assets/uploads/ads/sofa 1.jpeg','default-icon','assets/images/profiles/Passport_Photograph.jpg','Aman Bahukhandi','For Sell','Furnitures','L shaped 6 seater sofa',0,0,'Just now','Patthribagh, Dehradun, Uttaranchal',18000.00,'It\'s a Lshaped 6 seater sofa in excellent condition. Very less used.','[\"clasifico\\/assets\\/uploads\\/reference_images\\/sofa 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofa 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofa 1.jpeg\"]'),(122,57,'clasifico/assets/uploads/ads/sofaa 1.jpeg','default-icon','assets/images/profiles/Passport_Photograph.jpg','Aman Bahukhandi','For Sell','Furnitures','Selling my recently refurbished sofa set',0,0,'Just now','GMS Road, Dehradun, Uttaranchal',25000.00,'Sofa set with dining table and side stools\r\n\r\nRelocating hence letting them go','[\"clasifico\\/assets\\/uploads\\/reference_images\\/sofaa 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofaa 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofaa 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofaa 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/sofaa 1.jpeg\"]'),(123,58,'clasifico/assets/uploads/ads/build 1.jpeg','default-icon','assets/images/profiles/dp.jpg','Aman Bahukhandi','For Sell','Property','3bhk flat gms road service class family',0,0,'Just now','GMS Road, Dehradun, Uttaranchal',22000.00,'Type\r\nApartments\r\nBedrooms\r\n3\r\nBathrooms\r\n3\r\nFurnishing\r\nSemi-Furnished\r\nListed by\r\nDealer\r\nSuper Builtup area (ft²)\r\n2100\r\nCarpet Area (ft²)\r\n2100\r\nBachelors Allowed\r\nNo\r\nMaintenance (Monthly)\r\n3000\r\nTotal Floors\r\n5\r\nFloor No\r\n5\r\nCar Parking\r\n1\r\nFacing\r\nEast\r\nProject Name\r\nJoshi property','[\"clasifico\\/assets\\/uploads\\/reference_images\\/build 6.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/build 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/build 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/build 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/build 2.jpeg\"]'),(124,58,'clasifico/assets/uploads/ads/health 1.jpeg','default-icon','assets/images/profiles/dp.jpg','Aman Bahukhandi','For Sell','Health & Beauty','All Fitness Cource',0,0,'Just now','Doiwala Chowk, Doiwala, Uttaranchal',15000.00,'All type Fitness Course Are Avilable Live Weight Loss And Weight Gain','[\"clasifico\\/assets\\/uploads\\/reference_images\\/health 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/health 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/health 1.jpeg\"]'),(125,58,'clasifico/assets/uploads/ads/plot 1.jpeg','default-icon','assets/images/profiles/dp.jpg','Aman Bahukhandi','For Sell','Real Estate','Residential Plot for Sale in MDDA RERA Approved Gated Society',0,0,'Just now','Dehrakhas, Dehradun, Uttaranchal',35000.00,'Project Name- VISHNU GARDEN\r\n\r\nRate 35000/ to 38000/Sqrd\r\n\r\nSPECIAL IN PROPERTY- MDDA/RERA APPROVED, GATED SOCIETY\r\n\r\nAMENITIES- 30 FEET WIDE RCC ROAD, Under Ground Sewer lines, Sewer Treatment Plant, Water Storage Tank, Own Borewell, Park, 24×7 SECURITY, Population and Pollution Free Area,\r\n\r\nPROPERTY USP- Near By Power Banking Society, Maussoorie Woods Enclave, IAS DISHA FOREST-II, Gurukul University, ReYansh Green R V Estate, Shilver Height Society. Cambridge School, Doon International School, Jaspal Rana Shooting Institute, Dev Bhumi Engineering college\r\n\r\nKey Distance-\r\n\r\n1 Clock Tower Distance 13km\r\n\r\n2 Premnagar Distance 5km\r\n\r\n3 Highway Distance 4km\r\n\r\n4 RAILWAY Station Distance 14km\r\n\r\n5 ISBT Distance 15km','[\"clasifico\\/assets\\/uploads\\/reference_images\\/plot 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/plot 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/plot 2.jpeg\"]'),(126,59,'clasifico/assets/uploads/ads/land 1.jpeg','default-icon','assets/images/profiles/itachi.jpeg','Don','For Sell','Real Estate','Farm house , investment land 20Lakh /bigha',0,0,'Just now','Ballupura, Dehradun, Uttaranchal',2000000.00,'Type\r\nFor Sale\r\nListed by\r\nOwner\r\nPlot Area\r\n900\r\nLength\r\n100\r\nBreadth\r\n80\r\nFacing\r\nNorth-East\r\nProject Name\r\nBadsahi bag','[\"clasifico\\/assets\\/uploads\\/reference_images\\/land 5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/land 4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/land 3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/land 2.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/land 1.jpeg\"]'),(127,59,'clasifico/assets/uploads/ads/1.jpeg','default-icon','assets/images/profiles/itachi.jpeg','Aman Bahukhandi','For Sell','Property','3bhk duplex for sale in chaman vihar PHESH 2',0,0,'Just now','Chaman Vihar, Dehradun, Uttaranchal',12500000.00,'Type\r\nFor Sale\r\nListed by\r\nOwner\r\nPlot Area\r\n110\r\nFacing\r\nWest\r\nProject Name\r\nChaman vihaar duplex','[\"clasifico\\/assets\\/uploads\\/reference_images\\/6.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/5.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/4.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/3.jpeg\",\"clasifico\\/assets\\/uploads\\/reference_images\\/2.jpeg\"]');
/*!40000 ALTER TABLE `featured_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,55,1,'hi','2024-08-15 09:12:48'),(2,55,1,'r','2024-08-15 09:12:55'),(3,55,1,'r','2024-08-15 09:15:34'),(4,55,1,'r','2024-08-15 09:20:35'),(5,55,18,'hi a','2024-08-15 09:20:44'),(6,55,18,'hi a','2024-08-15 09:20:47'),(9,26,43,'x','2024-08-15 12:18:18'),(10,26,53,'d','2024-08-15 12:18:29'),(11,26,55,'sss','2024-08-15 13:10:06'),(12,55,26,'hello','2024-08-15 13:11:23'),(13,26,55,'im user','2024-08-15 13:13:12'),(14,55,26,'im admin','2024-08-15 13:14:17'),(15,60,53,'helloo','2024-08-15 20:22:39'),(16,60,22,'checking multiple','2024-08-15 20:32:41'),(17,60,24,'qwety','2024-08-15 20:34:35'),(18,51,60,'testing inbox','2024-08-15 20:39:19'),(19,51,60,'testing multiple messages in inbox','2024-08-15 20:41:40'),(20,26,60,'test','2024-08-15 21:19:50'),(21,26,60,'test','2024-08-15 21:20:34'),(22,26,60,'test','2024-08-15 21:24:40'),(23,26,60,'test','2024-08-15 21:25:10'),(24,26,60,'qwerbvcxznm','2024-08-15 21:25:32'),(25,26,60,'qwerbvcxznm','2024-08-15 21:26:18'),(26,60,60,'heyyy','2024-08-16 08:18:12');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `date_published` date NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (11,'assets/images/news/news-1.jpg','assets/images/news/admin-1.png','Electronics','Including animation in your design system','Lorem ipsum dolor sit amet consectur adipisicing sed do eiusmod tempor incididunt labore.','Eva Green','2020-10-13','blog-details.php'),(12,'assets/images/news/news-2.jpg','assets/images/news/admin-2.png','Electronics','A digital prescription for the industry.','Lorem ipsum dolor sit amet consectur adipisicing sed do eiusmod tempor incididunt labore.','Eva Green','2020-10-13','blog-details.php'),(13,'assets/images/news/news-3.jpg','assets/images/news/admin-3.png','Electronics','Strategic & commercial approach with issues.','Lorem ipsum dolor sit amet consectur adipisicing sed do eiusmod tempor incididunt labore.','Eva Green','2020-10-13','blog-details.php'),(14,'assets/images/news/news-4.jpg','assets/images/news/admin-4.png','Technology','The future of AI in everyday life','Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.','John Doe','2021-02-22','blog-details.php'),(15,'assets/images/news/news-5.jpg','assets/images/news/admin-5.png','Technology','How quantum computing is changing the landscape','Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','Jane Smith','2021-05-15','blog-details.php'),(16,'assets/images/news/news-6.jpg','assets/images/news/admin-6.png','Technology','Virtual reality: A new way to experience entertainment','Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.','Alice Brown','2021-07-30','blog-details.php'),(17,'assets/images/news/news-7.jpg','assets/images/news/admin-7.png','Health','Advancements in personalized medicine','Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','Bob White','2021-08-25','blog-details.php'),(18,'assets/images/news/news-8.jpg','assets/images/news/admin-8.png','Health','The impact of diet on mental health','Curabitur pretium tincidunt lacus. Nulla gravida orci a odio imperdiet imperdiet.','Sarah Black','2021-10-10','blog-details.php'),(19,'assets/images/news/news-9.jpg','assets/images/news/admin-9.png','Travel','Top 10 destinations to visit in 2022','Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.','Michael Green','2021-12-05','blog-details.php'),(20,'assets/images/news/news-10.jpg','assets/images/news/admin-10.png','Travel','How to travel on a budget','Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.','Emily Johnson','2022-01-18','blog-details.php'),(21,'assets/images/news/news1.jpg','assets/images/news/admin1.jpg','Technology','New Tech Innovations in 2024','Explore the latest technology innovations that are set to shape the future of our digital world in 2024.','John Doe','2024-08-15','https://example.com/news/tech-innovations-2024'),(22,'assets/images/news/news2.jpg','assets/images/news/admin2.jpg','Health','Advancements in Healthcare Technology','Discover the recent advancements in healthcare technology that promise to improve patient care and outcomes.','Jane Smith','2024-08-14','https://example.com/news/healthcare-advancements'),(23,'assets/images/news/news3.jpg','assets/images/news/admin3.jpg','Travel','Top Destinations to Visit in 2024','Get inspired by our list of top travel destinations you should consider for your 2024 vacation.','Emily Johnson','2024-08-13','https://example.com/news/top-destinations-2024'),(24,'assets/images/news/news4.jpg','assets/images/news/admin4.jpg','Finance','Financial Tips for the Coming Year','Prepare for the upcoming year with these essential financial tips to help you manage your money effectively.','Michael Brown','2024-08-12','https://example.com/news/financial-tips-2024'),(25,'assets/images/news/news5.jpg','assets/images/news/admin5.jpg','Health','Must-Watch Movies of 2024','Check out our list of must-watch movies that are set to be released in 2024 and make your movie nights unforgettable.','Sarah Wilson','2024-08-11','https://example.com/news/must-watch-movies-2024'),(26,'assets/images/news/news1.jpg','assets/images/news/admin1.jpg','Technology','New Tech Innovations in 2024','Explore the latest technology innovations that are set to shape the future of our digital world in 2024.','John Doe','2024-08-15','https://example.com/news/tech-innovations-2024'),(27,'assets/images/news/news2.jpg','assets/images/news/admin2.jpg','Health','Advancements in Healthcare Technology','Discover the recent advancements in healthcare technology that promise to improve patient care and outcomes.','Jane Smith','2024-08-14','https://example.com/news/healthcare-advancements'),(28,'assets/images/news/news3.jpg','assets/images/news/admin3.jpg','Travel','Top Destinations to Visit in 2024','Get inspired by our list of top travel destinations you should consider for your 2024 vacation.','Emily Johnson','2024-08-13','https://example.com/news/top-destinations-2024'),(29,'assets/images/news/news4.jpg','assets/images/news/admin4.jpg','Finance','Financial Tips for the Coming Year','Prepare for the upcoming year with these essential financial tips to help you manage your money effectively.','Michael Brown','2024-08-12','https://example.com/news/financial-tips-2024'),(30,'assets/images/news/news5.jpg','assets/images/news/admin5.jpg','Health','Must-Watch Movies of 2024','Check out our list of must-watch movies that are set to be released in 2024 and make your movie nights unforgettable.','Sarah Wilson','2024-08-11','https://example.com/news/must-watch-movies-2024');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `otp_verification`
--

DROP TABLE IF EXISTS `otp_verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `otp_verification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `otp` varchar(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `otp_verification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `otp_verification`
--

LOCK TABLES `otp_verification` WRITE;
/*!40000 ALTER TABLE `otp_verification` DISABLE KEYS */;
INSERT INTO `otp_verification` VALUES (23,53,'117599','2024-08-13 17:18:13','2024-08-13 17:28:13'),(24,51,'571259','2024-08-13 17:53:23','2024-08-13 18:03:23'),(25,51,'371672','2024-08-13 17:55:34','2024-08-13 18:05:34'),(26,53,'638636','2024-08-13 18:01:30','2024-08-13 18:11:30'),(27,51,'972165','2024-08-13 18:44:13','2024-08-13 18:54:13'),(28,51,'362041','2024-08-13 20:00:18','2024-08-13 20:10:18'),(29,60,'925848','2024-08-16 05:50:05','2024-08-16 06:00:05');
/*!40000 ALTER TABLE `otp_verification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `places` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `listing_count` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `places`
--

LOCK TABLES `places` WRITE;
/*!40000 ALTER TABLE `places` DISABLE KEYS */;
INSERT INTO `places` VALUES (1,'Los Angeles','assets/images/resource/place-1.jpg',10),(2,'San Francisco','assets/images/resource/place-2.jpg',15),(3,'California City','assets/images/resource/place-3.jpg',8),(4,'New York City','assets/images/resource/place-4.jpg',5),(5,'Brooklyn City','assets/images/resource/place-5.jpg',2);
/*!40000 ALTER TABLE `places` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banner`
--

DROP TABLE IF EXISTS `tbl_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `descr` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `align` varchar(10) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banner`
--

LOCK TABLES `tbl_banner` WRITE;
/*!40000 ALTER TABLE `tbl_banner` DISABLE KEYS */;
INSERT INTO `tbl_banner` VALUES (7,'Reimagine Digital Experience 1','Reimagine Digital Experience 1','banner.jpg','left',1),(8,'Reimagine Digital Experience 2','Reimagine Digital Experience 2','car4.jpg','left',1);
/*!40000 ALTER TABLE `tbl_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_brand` (
  `bid` int NOT NULL AUTO_INCREMENT,
  `bname` varchar(20) DEFAULT NULL,
  `bcat` int DEFAULT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_brand`
--

LOCK TABLES `tbl_brand` WRITE;
/*!40000 ALTER TABLE `tbl_brand` DISABLE KEYS */;
INSERT INTO `tbl_brand` VALUES (1,'Samsung',1),(2,'Mi',1),(3,'Lenovo',6),(4,'iPhone',1),(5,'Vivo',1),(6,'Oppo',1),(7,'Honda',16),(8,'Hyundai',16),(9,'Toyota',16),(10,'Cars',16),(11,'Maruti Suzuki',16),(12,'Acer',6),(13,'Apple',6);
/*!40000 ALTER TABLE `tbl_brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_category` (
  `cid` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) DEFAULT NULL,
  `cat_img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (19,'Electronics','1635763923PngItem2474633.png'),(20,'Cars','1635763946910602979bda92b9f88144d313f52725.png'),(21,'Furniture','1635765515fff.png'),(22,'Fashion','1635764498PngItem306363.png'),(23,'Books','1635764691book-transparent-background-1155036359433bem9zcgx.png'),(24,'Mobiles','1635764802country-wise-mobile-phones-import.png');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_city`
--

DROP TABLE IF EXISTS `tbl_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `state_id` int DEFAULT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_city`
--

LOCK TABLES `tbl_city` WRITE;
/*!40000 ALTER TABLE `tbl_city` DISABLE KEYS */;
INSERT INTO `tbl_city` VALUES (1,2,'Delhi'),(2,4,'Bengaluru'),(3,3,'Chennai'),(4,3,'Tirupur'),(5,1,'Nagpur'),(6,1,'Mumbai');
/*!40000 ALTER TABLE `tbl_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_custom_fields`
--

DROP TABLE IF EXISTS `tbl_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_custom_fields` (
  `cfid` int NOT NULL AUTO_INCREMENT,
  `cf_name` varchar(50) NOT NULL,
  `cf_type` varchar(50) NOT NULL,
  `cf_options` text,
  `cf_length` varchar(50) DEFAULT NULL,
  `cf_default` varchar(50) DEFAULT NULL,
  `cf_required` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`cfid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_custom_fields`
--

LOCK TABLES `tbl_custom_fields` WRITE;
/*!40000 ALTER TABLE `tbl_custom_fields` DISABLE KEYS */;
INSERT INTO `tbl_custom_fields` VALUES (21,'Km driven','text','','','',1),(20,'Modal','text','','','',1),(22,'Fuel Type','select','Petrol,Diesel,electric,CNG,','','',1);
/*!40000 ALTER TABLE `tbl_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_featured_ads`
--

DROP TABLE IF EXISTS `tbl_featured_ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_featured_ads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post` int NOT NULL,
  `package` int NOT NULL,
  `from_date` varchar(100) NOT NULL,
  `to_date` varchar(100) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_featured_ads`
--

LOCK TABLES `tbl_featured_ads` WRITE;
/*!40000 ALTER TABLE `tbl_featured_ads` DISABLE KEYS */;
INSERT INTO `tbl_featured_ads` VALUES (1,11,2,'2022-02-22','2022-03-09',0),(2,9,2,'2022-02-22','2022-03-09',0);
/*!40000 ALTER TABLE `tbl_featured_ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_follower`
--

DROP TABLE IF EXISTS `tbl_follower`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_follower` (
  `srno` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `follower` int DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_follower`
--

LOCK TABLES `tbl_follower` WRITE;
/*!40000 ALTER TABLE `tbl_follower` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_follower` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_following`
--

DROP TABLE IF EXISTS `tbl_following`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_following` (
  `srno` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `following` int DEFAULT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_following`
--

LOCK TABLES `tbl_following` WRITE;
/*!40000 ALTER TABLE `tbl_following` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_following` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_messages`
--

DROP TABLE IF EXISTS `tbl_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_messages` (
  `s_no` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` text NOT NULL,
  `m_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_messages`
--

LOCK TABLES `tbl_messages` WRITE;
/*!40000 ALTER TABLE `tbl_messages` DISABLE KEYS */;
INSERT INTO `tbl_messages` VALUES (21,9,9,'hello',NULL),(22,9,9,'hello',NULL),(23,9,9,'hello user','2022-03-11');
/*!40000 ALTER TABLE `tbl_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_package`
--

DROP TABLE IF EXISTS `tbl_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `duration` int NOT NULL,
  `status` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_package`
--

LOCK TABLES `tbl_package` WRITE;
/*!40000 ALTER TABLE `tbl_package` DISABLE KEYS */;
INSERT INTO `tbl_package` VALUES (2,'Weekly',10,7,1),(3,'Monthly',15,30,1);
/*!40000 ALTER TABLE `tbl_package` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_payments`
--

DROP TABLE IF EXISTS `tbl_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `payment_gross` varchar(255) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_payments`
--

LOCK TABLES `tbl_payments` WRITE;
/*!40000 ALTER TABLE `tbl_payments` DISABLE KEYS */;
INSERT INTO `tbl_payments` VALUES (2,11,'6c6b6de3b19b4f929c9152197a4c6138','15','credit','2022-02-22'),(3,9,'bb7dac6af99b4b3aa7ed4f1f40b9ce24','15','credit','2022-02-22'),(4,9,'f0df788652c04c679d11d27d6e1cf091','15','credit','2022-02-22'),(5,9,'7630091ede654f42a92c8f948bcb1e8a','10','credit','2022-02-22'),(6,11,'2f916f5ef94f4038b3b311402ae59e81','10','credit','2022-02-22'),(7,9,'fa5aca77c4524c8aacbfadf013426d53','10','credit','2022-03-11');
/*!40000 ALTER TABLE `tbl_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_settings`
--

DROP TABLE IF EXISTS `tbl_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_desc` text NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `cur_format` varchar(10) DEFAULT NULL,
  `approve_ad` tinyint DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_settings`
--

LOCK TABLES `tbl_settings` WRITE;
/*!40000 ALTER TABLE `tbl_settings` DISABLE KEYS */;
INSERT INTO `tbl_settings` VALUES (1,'logo.png','favicon.png','Classified ADS','Classified Ads','Classified Ads','www.facebook.com','www.twitter.com','www.instagram.com','INR',0,'Copyright 2021. Classfied Ads');
/*!40000 ALTER TABLE `tbl_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_state`
--

DROP TABLE IF EXISTS `tbl_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_state` (
  `state_id` int NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_state`
--

LOCK TABLES `tbl_state` WRITE;
/*!40000 ALTER TABLE `tbl_state` DISABLE KEYS */;
INSERT INTO `tbl_state` VALUES (1,'Maharashtra'),(2,'Delhi'),(3,'Tamilnadu'),(4,'Karnataka');
/*!40000 ALTER TABLE `tbl_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_subcategory`
--

DROP TABLE IF EXISTS `tbl_subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_subcategory` (
  `sid` int NOT NULL AUTO_INCREMENT,
  `subcat_name` varchar(100) DEFAULT NULL,
  `cat_id` int DEFAULT NULL,
  `cus_fields` varchar(255) DEFAULT NULL,
  `show_in_header` tinyint NOT NULL DEFAULT '0',
  `show_in_footer` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_subcategory`
--

LOCK TABLES `tbl_subcategory` WRITE;
/*!40000 ALTER TABLE `tbl_subcategory` DISABLE KEYS */;
INSERT INTO `tbl_subcategory` VALUES (1,'Mobile Phones',24,'',1,0),(2,'Accessories',19,'',0,0),(3,'Tablets',24,'',0,0),(4,'Cameras',19,'',0,0),(5,'fridges',19,'',0,0),(6,'Computers & Laptops',19,'',0,0),(7,'ACs',19,'',0,0),(8,'Washing Machines',19,'',0,0),(9,'Sofa & Dining',21,'',1,0),(10,'Beds & Wardrobes',21,'',0,0),(11,'Kids Furniture',21,'',0,0),(12,'Men',22,'',0,0),(13,'women',22,'',0,0),(14,'Kids',22,'',0,0),(15,'Books',23,'',0,0),(16,'Cars',20,'21,20,22',1,0);
/*!40000 ALTER TABLE `tbl_subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_ui_login`
--

DROP TABLE IF EXISTS `tbl_ui_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_ui_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `fav` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state_id` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `aboutme` text,
  `join_date` varchar(50) DEFAULT NULL,
  `profile_img` varchar(200) DEFAULT NULL,
  `show_phone` tinyint NOT NULL DEFAULT '1',
  `status` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ui_login`
--

LOCK TABLES `tbl_ui_login` WRITE;
/*!40000 ALTER TABLE `tbl_ui_login` DISABLE KEYS */;
INSERT INTO `tbl_ui_login` VALUES (1,'Ramesh','6fc42c4388ed6f0c5a91257f096fef3c','8956231047',NULL,'ramesh47@gmail.com',3,4,'','2021-11-01',NULL,1,1),(2,'Karan Sharma','db068ce9f744fbb35eedc9a883f91085','7894561230',NULL,'karan30@gmail.com',1,5,'','2021-11-01',NULL,1,1),(3,'Rupali','96a7810cc225f9043d6066c947fa09e0','8562310478',NULL,'rupali78@gmail.com',1,6,'','2021-11-01',NULL,1,1),(4,'Shubham','3b6beb51e76816e632a40d440eab0097','7891230456',NULL,'shubham@gmail.com',3,3,'','2021-11-01',NULL,1,1),(5,'Suman','1533c67e5e70ae7439a9aa993d6a3393','7788995623',NULL,'suman23@gmail.com',4,2,'','2021-11-01',NULL,1,1),(6,'Gagan Shah','cc18a19beff0bdf874861a4dae6124b6','8956410596',NULL,'gagan96@gmail.com',1,1,NULL,'2021-11-01',NULL,1,1),(7,'Daksh','879c8e97dd5961fdcc7dcaf24e98f75d','9856231047',NULL,'daksh47@gmail.com',1,6,'','2021-11-02',NULL,1,1),(8,'Rajeev','03346657feea0490a4d4f677faa0583d','5623104789',NULL,'rajeev89@gmail.com',2,1,'','2021-11-24',NULL,1,1),(9,'Salmaan Khan','03346657feea0490a4d4f677faa0583d','8952012354','11,10,','salmaankhan@gmail.com',4,2,'','2021-11-24','1647004327-cross_img.png',1,1),(10,'Gurpreet Singh','a10cf416e455eafc2629576171e58ad7','7892013456',NULL,'gurpreetsingh@gmail.com',1,5,'','2021-11-24',NULL,1,1),(12,'new name','22af645d1859cb5ca6da0c484f1f37ea','5623104789',NULL,'new@gmail.com',4,2,NULL,'2021-11-27',NULL,1,1);
/*!40000 ALTER TABLE `tbl_ui_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) DEFAULT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (7,'admin','21232f297a57a5a743894a0e4a801fc3','9999999999','admin@admin.com');
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_photo` varchar(255) DEFAULT 'assets/images/default-profile.png',
  `address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'aman','a@gmail.com','$2y$10$NifCUWH8myw3AMDuthzsiOuCHOI9nDOEnFIslR8cLN4wh1pxYQgOq','2024-08-01 19:06:35','assets/images/profiles/5 to 20kb (2).jpg',NULL,'911','user'),(17,'abd','test3@gmail.com','$2y$10$K/spQDu3BSYxp6C5LSrbCOg28PXE9d7A/47JUlaOmD2zx9cRNWdU.','2024-08-02 10:10:51','assets/images/default-profile.png',NULL,NULL,'user'),(18,'aman','a2@gmail.com','$2y$10$btr6JJaHc3cVaXpPqYfuNeGlKNCIsA.uDy4po.RV4p/U.2l.HS5me','2024-08-02 10:27:36','assets/images/default-profile.png',NULL,NULL,'user'),(21,'aaaa','aaaa@gmail.com','$2y$10$wSrcp6MzOKSYnwZpe7zY9eai/eJFgo.Up2IBYqFE2rLjCBDKG2pBW','2024-08-02 11:16:22','assets/images/default-profile.png',NULL,NULL,'user'),(22,'aman','test5@gmail.com','$2y$10$etD2GUK3QOvYWacQOQhoPuh2gynQZVcc8Oszkea9Wg2fcFaU5FUqG','2024-08-02 11:43:56','assets/images/default-profile.png',NULL,NULL,'user'),(23,'aman','test6@gmail.com','$2y$10$P2J4xbZqTi6OfcK9lzmBTusFLL6Q3BQtHfPH4.5xK344FOrii4pI6','2024-08-02 12:01:19','assets/images/default-profile.png',NULL,NULL,'user'),(24,'aaa','aa@gmail.com','$2y$10$9f4yzOdUTjDenhRTKySuxuZscdGkeGX/yL2YNoI7p9FYt3xJU7ZfC','2024-08-03 12:14:45','assets/images/default-profile.png',NULL,NULL,'user'),(25,'aa','aaaaa@gmai.com','$2y$10$5Kt0ZgAiqrzpk8psccrHZuuSHo5vUZlC638aPQW.CnWAu6ja1LwnW','2024-08-03 12:46:17','assets/images/default-profile.png',NULL,NULL,'user'),(26,'Aman Bahukhandi','test@gmail.com','$2y$10$hCJYwtJbRlll0h7CkRKwkOGwRo5YZirG5ZgnUk.7csLLuMIAGfECG','2024-08-03 13:04:39','assets/images/profiles/DP.jpeg','LANE NO.4 , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','9971818206','user'),(27,'s','surbhibahukhandi1999@gmail.com','$2y$10$JgyCfnzG3wXr2vkHO0if..S00CmEeM40zslHxVNWqLcv4uM8I06rS','2024-08-12 06:01:46','assets/images/default-profile.png',NULL,NULL,'user'),(28,'aman','abd@gmail.com','$2y$10$i4wSGrk2Ubuj9S3Ijxkf2OW6ZVYeADRVE2/Wkr6YGJ4mUpPIpKhT2','2024-08-12 06:05:47','assets/images/default-profile.png',NULL,NULL,'user'),(29,'d','d@gmail.com','$2y$10$QqoR7VqZBsLZYUhDo3DLg.ZZRhs.95LSCi//IKmn54a7NKYPlGFS2','2024-08-12 06:15:17','assets/images/default-profile.png',NULL,NULL,'user'),(30,'sssssssss','ssssssssss@gmail.com','$2y$10$qIqYrZeh2iCKH47AHTzROu2Wnlhjno10hSQ9n4INBPx2bxD.B0/Sy','2024-08-12 06:23:49','assets/images/default-profile.png',NULL,NULL,'user'),(31,'ffffffffff','f@gmail.com','$2y$10$29NEM58c9vvEDKwZT6qY2.5Xlpvc.h2tFPrwh2a04fwJyB40Zp14i','2024-08-12 06:29:44','assets/images/default-profile.png',NULL,NULL,'user'),(32,'kkkkkkkkkk','k@gmail.com','$2y$10$kuue4QPphwBsMFUicuwoF.SPAS9KAtllEDVsSkzaCPdrF5ReY3YsG','2024-08-12 06:49:52','assets/images/default-profile.png',NULL,NULL,'user'),(33,'nn','surbhibahukhandi199928@gmail.com','$2y$10$1W9YaEEiXIc95MzXmINwsejrSYXOJgYsDYpJrm5Zq9RHEtE0LuB7W','2024-08-12 06:52:45','assets/images/default-profile.png',NULL,NULL,'user'),(34,'yoooooooooo','yoooooooo@gmail.com','$2y$10$uIbmjkZKIs42Z/7UldmoGOfMuHWvyBDX2c4Su98eG8pnKazy4J0ZC','2024-08-12 06:55:37','assets/images/default-profile.png',NULL,NULL,'user'),(35,'n','n@gmail.com','$2y$10$zKwP0c346kxTVZdkfTgB7e4gGBc4DM5/8QjqYdudhUzs7uuB2cOaC','2024-08-12 06:59:40','assets/images/default-profile.png',NULL,NULL,'user'),(36,'nnm','nm@gmail.com','$2y$10$B7CmOVlHl9/61uB.LwQX9uUBA2QAqra0wkjFPfh5qv/iMcacvB1kW','2024-08-12 07:03:20','assets/images/default-profile.png',NULL,NULL,'user'),(37,'aman','aman1234@gmail.com','$2y$10$VfiT.DHccJzTPmw2YzpEU.0muUu.lRflpRURve16jtvRLc8TN9Dmi','2024-08-12 07:24:27','assets/images/default-profile.png',NULL,NULL,'user'),(38,'nnnnn','nt@gmail.com','$2y$10$J9svU5UImfsMXUf3mfRptOuTLakdVJeve1sRw64AxU8mtuNQFXwzS','2024-08-12 07:31:59','assets/images/default-profile.png',NULL,NULL,'user'),(39,'mmmmmmmmmmmm','m@gmail.com','$2y$10$.co9w.1bY36CVREjM336MODiRcL9/Ayf3c0EaVZwWSr3oCL/acgmm','2024-08-12 07:33:29','assets/images/default-profile.png',NULL,NULL,'user'),(40,'piiii','piii@gmail.com','$2y$10$2B2BVO/DHS9RZ1rg0z0nLOIDUL3NofhQATARJGmXoYKxo2NDNjHZC','2024-08-12 07:37:27','assets/images/default-profile.png',NULL,NULL,'user'),(41,'n','n','$2y$10$dm6mtI3RU0Oe7/kuNASgcOTNacHxfc02DU093Olme./YZdDk9DMZS','2024-08-12 08:42:21','assets/images/default-profile.png',NULL,NULL,'user'),(42,'l','l','$2y$10$cOrX89Q3nPKDAu88a5Lk1eSxBGXznSVZnyZqUa.Fk6hFXl/CqF6gG','2024-08-12 09:05:05','assets/images/default-profile.png',NULL,NULL,'user'),(43,'g','ghhg@gmail.com','$2y$10$GsPsD90Um6Neegi3Gel0/uNrunOFWQk6naeB3AEiAMRdX8Niv0TLu','2024-08-12 09:26:37','assets/images/default-profile.png',NULL,NULL,'admin'),(44,'oo','o@gmail.com','$2y$10$jRjleJ7wQjCCMcqDlFkGoeAKWRlfgHIwePbKIAnAvrNJjlcLwenXG','2024-08-12 09:55:22','assets/images/default-profile.png',NULL,NULL,'admin'),(45,'j','j@gmail.com','$2y$10$DLgCor9pV0pz/H.IfO4WQuCQyRIglx5Sp4tRWBZX2de6DK2i2Snqm','2024-08-12 10:02:07','assets/images/default-profile.png',NULL,NULL,'admin'),(46,'Kl','Kl@gmail.com','$2y$10$NLQB47pjoaoXGgBV.F0zWejgroYbJdqKrnt4GY9Y54gFKZONc1RKK','2024-08-12 10:05:19','assets/images/default-profile.png',NULL,NULL,'admin'),(47,'test','tset@test.com','$2y$10$ClsvZx91.GNLUHhcIDUwJOSmlzcWEwW6tOHgyeRuhVXIjYCQnz9ze','2024-08-12 11:18:13','assets/images/default-profile.png',NULL,NULL,'user'),(48,'ttest','test@test.com','$2y$10$CY1l8f3u6wiYADxEHdHGTekQtcfZKfc47ShwNTSCVMRf.5BMIHvuS','2024-08-12 11:20:50','assets/images/default-profile.png',NULL,NULL,'user'),(49,'test1','test1@test.com','$2y$10$G.JUnv3wLrT7Ox2xBuTC7.6uCQnHtTQ1VB4LRUSnoajnPuOWRapGy','2024-08-12 11:34:26','assets/images/default-profile.png',NULL,NULL,'user'),(51,'Aman Bahukhandi','testing123@gmail.com','$2y$10$09Ka6Sv7qCeaFH6C.4.Iz.5U0.0.wOkzQ6fkw3/3goeGkaePZha62','2024-08-12 11:52:26','./assets/images6.jpeg','LANE NO.4 , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','9971818206','admin'),(52,'admin','admin123@gmail.com','$2y$10$UFfKSYoWfq//YvZjDkojh.PYLrqQY94DcdVreyP1HRT2wiQPZrHaa','2024-08-12 12:22:09','assets/images/default-profile.png',NULL,NULL,'user'),(53,'admin123','amanbahukhandi07@gmail.com','$2y$10$vgVeWJam5wFkze75P4GPOuHmcmcefz7AiXDh8XeUlaVMsuaUo5yQC','2024-08-12 12:38:39','assets/images/profiles/Passport_Photograph.jpg','Delhi','123456789','admin'),(54,'aman','abd123456@gmail.co','$2y$10$FqVRxFfIVP1bYvvxeL6Q6.DX5gCUwvDsJ689Jd8A5S0myJOZGA85G','2024-08-13 14:39:17','assets/images/default-profile.png',NULL,NULL,'user'),(55,'hi','hi@gmail.com','$2y$10$JFutggyLwgaoo1jsKjPH6.pa3R27U7DftXC42dOv9GRO0LLWO0g8i','2024-08-15 03:05:09','./assets/images5 to 20kb (2).jpg',NULL,NULL,'admin'),(56,'d','ddd@gmail.com','$2y$10$Owu8zRZ95O8UrG2O1Xl7XeApKLH/JseJ9h5pmeH5PSQKdKPd1aJT2','2024-08-15 11:40:39','assets/images/default-profile.png',NULL,NULL,'admin'),(57,'Aman Bahukhandi','aman@gmail.com','$2y$10$cid3z.7rkrCD26HgQIXPX.8Dd8KSgEMuzwLJG0e2AYq0mGzj9tYJa','2024-08-15 13:45:35','assets/images/profiles/Passport_Photograph.jpg','LANE NO.4E , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','9971818206','user'),(58,'Aman Bahukhandi','abd123@gmail.com','$2y$10$MmYXaO.znCn3ewDP6Dh3mOU1OcoRMEX3MbUepDDZ1FR9sPz.jvUHC','2024-08-15 13:55:01','assets/images/profiles/dp.jpg','LANE NO.4E , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','9971818206','user'),(59,'Aman Bahukhandi','don@gmail.com','$2y$10$bTpavk9N/vm8rOaEAEz.Aeg1/psab4PmTyuvMoovyXbdBTlQ/NAey','2024-08-15 14:05:19','assets/images/profiles/itachi.jpeg','LANE NO.4E , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','9971818206','user'),(60,'Aman Bahukhandi1','master@gmail.com','$2y$10$j5iUakeZJWHFLJ7mWiaBBeYDVYwk2KANAkw6/O8T..jEa7wdmpEIy','2024-08-15 14:36:18','./assets/imagesluffy.jpeg','LANE NO.4E , SHIVRAJ NAGAR, BADOWALA, DEHRADOON, UT','09971818206','admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-17 18:45:01
