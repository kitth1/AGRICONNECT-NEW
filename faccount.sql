-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 11:16 PM
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
-- Database: `faccount`
--

-- --------------------------------------------------------

--
-- Table structure for table `agusipan_report`
--

CREATE TABLE `agusipan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agusipan_report`
--

INSERT INTO `agusipan_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(3, 'batong bakal farm', 'undhfsifsndvhad adpuigndiug hnadpgi udsnpg iudh unh siudhgsndkl hibkusdnizuhg', '2023-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `agutayan_report`
--

CREATE TABLE `agutayan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agutayan_report`
--

INSERT INTO `agutayan_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(2, 'melon farm', 'signsd87ct587tw5yb78 b78 b478by498ney98 ', '2023-11-07'),
(3, 'melon farm', 's dxbhfdsd advh dffg asx ghga dhs es gadrg asd gs dg', '2023-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `bagumbayan_report`
--

CREATE TABLE `bagumbayan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bagumbayan_report`
--

INSERT INTO `bagumbayan_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(3, 'sugar farm', 'usfnae8yct8t4o8eab7aynsd', '2023-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `balabag_report`
--

CREATE TABLE `balabag_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `balabag_report`
--

INSERT INTO `balabag_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(2, 'eggplantation', 'somjg89eya87ey498wy 8ey a894y', '2023-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `banan_report`
--

CREATE TABLE `banan_report` (
  `ID` int(255) NOT NULL,
  `farm_name` varchar(255) NOT NULL,
  `week_report` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banan_report`
--

INSERT INTO `banan_report` (`ID`, `farm_name`, `week_report`, `date`) VALUES
(2, 'corn farm', 'qn9c8yaep98tsyp598tay49p8gey gp9a8y4 p94sy', '2023-11-07');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_location`
--

CREATE TABLE `brgy_location` (
  `ID` int(255) NOT NULL,
  `barangay_location` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy_location`
--

INSERT INTO `brgy_location` (`ID`, `barangay_location`, `lat`, `lng`) VALUES
(1, 'Balabag', '10.774410392164286', '122.51156989802008'),
(2, 'Agusipan', '10.810473166449876', '122.56296577151409'),
(3, 'Agutayan', '10.813910097823298', '122.54295103922347'),
(4, 'Ban-ag', '10.850365477920635', '122.54500144650837'),
(5, 'Bagumbayan', '10.845277423381159', '122.52433770320872');

-- --------------------------------------------------------

--
-- Table structure for table `crop_status_icons`
--

CREATE TABLE `crop_status_icons` (
  `ID` int(255) NOT NULL,
  `crop_status` varchar(255) NOT NULL,
  `icon_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crop_status_icons`
--

INSERT INTO `crop_status_icons` (`ID`, `crop_status`, `icon_url`) VALUES
(1, 'seedling', 'https://www.dropbox.com/scl/fi/55dqr08byxr1u2j33kks7/seedling.jpg?rlkey=pk3w49eoore49jtryfsdy4g8z&dl=0'),
(2, 'sprouting', 'https://www.dropbox.com/scl/fi/adhcmw81wwhbwrt44ycjv/sprouting.jpg?rlkey=wsj4p4s70sj99l77jxbmom5jf&dl=0'),
(3, 'ripening', 'https://www.dropbox.com/scl/fi/7rnfeb8u2a3oilvgmk9i8/ripening.jpg?rlkey=w3dujhj7ebfhrbaox9xxlcbdw&dl=0'),
(4, 'harvesting', 'https://www.dropbox.com/scl/fi/paprq4kqrf5hrf0ofmo91/harvesting.jpg?rlkey=mfpogqv9y3k82mrers4gqaun8&dl=0');

-- --------------------------------------------------------

--
-- Table structure for table `distribute`
--

CREATE TABLE `distribute` (
  `ID` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `cropseed_n` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `farmer_acc`
--

CREATE TABLE `farmer_acc` (
  `ID` int(255) NOT NULL,
  `farmer_n` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL DEFAULT 'sex',
  `farm_n` varchar(255) NOT NULL,
  `area` int(255) NOT NULL,
  `barangay` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `fcontact` varchar(255) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_status` varchar(255) NOT NULL DEFAULT 'sprouting',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `cn_recieved` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `date_distri` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmer_acc`
--

INSERT INTO `farmer_acc` (`ID`, `farmer_n`, `age`, `sex`, `farm_n`, `area`, `barangay`, `fcontact`, `crop_name`, `crop_status`, `latitude`, `longitude`, `last_update`, `fname`, `cn_recieved`, `quantity`, `date_distri`) VALUES
(32, 'bolences', '21', 'male', 'e2', 2, 'Bagumbayan', '886575463456', 'Tomato', 'harvesting', 10.809798706093805, 122.56159248049846, '2023-12-15', '', '', 0, NULL),
(33, 'faro', '22', 'male', 'ricee', 2, 'Agutayan', '09687847321', 'Banana', 'ripening', 10.813067031799292, 122.54320853128888, '2023-12-22', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tech_acc`
--

CREATE TABLE `tech_acc` (
  `ID` int(255) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL DEFAULT 'sex',
  `tcontact` varchar(255) NOT NULL,
  `tdesignation` varchar(255) NOT NULL DEFAULT 'Agusipan',
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `tech_username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tech_acc`
--

INSERT INTO `tech_acc` (`ID`, `tname`, `age`, `sex`, `tcontact`, `tdesignation`, `role`, `tech_username`, `password`, `confirm_pass`) VALUES
(24, 'default', '1', 'male', '0987564432', 'Agusipan', 'admin', 'admin', 'admin', 'admin'),
(25, 'gimo', '22', 'female', '09388732118', 'Agutayan', 'technician', 'gimo', '123', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agusipan_report`
--
ALTER TABLE `agusipan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `agutayan_report`
--
ALTER TABLE `agutayan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `bagumbayan_report`
--
ALTER TABLE `bagumbayan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `balabag_report`
--
ALTER TABLE `balabag_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `banan_report`
--
ALTER TABLE `banan_report`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `brgy_location`
--
ALTER TABLE `brgy_location`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `crop_status_icons`
--
ALTER TABLE `crop_status_icons`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `distribute`
--
ALTER TABLE `distribute`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `farmer_acc`
--
ALTER TABLE `farmer_acc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tech_acc`
--
ALTER TABLE `tech_acc`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agusipan_report`
--
ALTER TABLE `agusipan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agutayan_report`
--
ALTER TABLE `agutayan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bagumbayan_report`
--
ALTER TABLE `bagumbayan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `balabag_report`
--
ALTER TABLE `balabag_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banan_report`
--
ALTER TABLE `banan_report`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brgy_location`
--
ALTER TABLE `brgy_location`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `crop_status_icons`
--
ALTER TABLE `crop_status_icons`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distribute`
--
ALTER TABLE `distribute`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmer_acc`
--
ALTER TABLE `farmer_acc`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tech_acc`
--
ALTER TABLE `tech_acc`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
