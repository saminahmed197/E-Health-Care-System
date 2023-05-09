-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 03:38 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Appointment_id` int(11) NOT NULL,
  `date_` date NOT NULL,
  `Patient_id` int(11) NOT NULL,
  `Doctorid` int(11) NOT NULL,
  `Chamber_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Appointment_id`, `date_`, `Patient_id`, `Doctorid`, `Chamber_id`) VALUES
(1000000006, '2020-05-27', 100016, 137, 7),
(1000000007, '2020-05-30', 100018, 137, 7),
(1000000008, '2020-06-06', 100018, 137, 7),
(1000000009, '2020-05-03', 100018, 137, 7),
(1000000010, '2020-06-05', 100016, 137, 7),
(1000000013, '2020-06-06', 100016, 137, 7);

-- --------------------------------------------------------

--
-- Table structure for table `chamber`
--

CREATE TABLE `chamber` (
  `Chamber_id` int(11) NOT NULL,
  `Doctorid` int(11) DEFAULT NULL,
  `Chamberinfo` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Contact` varchar(50) DEFAULT NULL,
  `FROM_TIME` time DEFAULT NULL,
  `TO_TIME` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chamber`
--

INSERT INTO `chamber` (`Chamber_id`, `Doctorid`, `Chamberinfo`, `Address`, `Contact`, `FROM_TIME`, `TO_TIME`) VALUES
(7, 137, 'Popular Hospital', 'Uttara', '016 111 222 333', '14:22:00', '15:34:00'),
(8, 136, 'Lab Aid Hospital', 'Mirpur', '016111222333', '14:00:00', '15:00:00'),
(9, 136, 'Popular Hospital', 'Uttara', '016222111333', '14:00:00', '17:00:00'),
(10, 136, 'Uttara Adhunik Medical College', 'Uttara', '016222111333', '14:09:00', '19:00:00'),
(11, 136, 'Mekka Eye Hosptial', 'Uttara', '016222111333', '14:00:00', '16:00:00'),
(12, 138, 'Uttara Mohila Medical College', 'Uttara', '016222111333', '14:00:00', '16:30:00'),
(13, 140, 'valo', 'ctg', '123456', '11:11:00', '23:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `Doctorid` int(11) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Designation` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`Doctorid`, `FirstName`, `LastName`, `Email`, `Pass`, `Designation`) VALUES
(136, 'Samina', 'Maraj', 'samina.maraj@gmail.com', '202cb962ac59075b964b07152d234b70', 'MBBS'),
(137, 'Samina', 'Maraj 2', 'samina.maraj2@gmail.com', '202cb962ac59075b964b07152d234b70', 'MBBS'),
(138, 'Mahfuza', 'Akter', 'mahfuza.akter@gmail.com', '202cb962ac59075b964b07152d234b70', 'MBBS'),
(139, 'joy', 'bal', 'sijoy5000@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'hi world'),
(140, 'joy', 'bal', 'akbar@joy.com', '202cb962ac59075b964b07152d234b70', 'MBBS');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(6) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Date_Of_Birth` date NOT NULL,
  `age` int(3) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `pass`, `FirstName`, `LastName`, `Email`, `Date_Of_Birth`, `age`, `mobile`, `address`) VALUES
(100016, '202cb962ac59075b964b07152d234b70', 'Shaila', 'Meraz', 'shaila.meraz@gmail.com', '2000-01-01', 20, '131412415141', 'Uttara'),
(100017, '202cb962ac59075b964b07152d234b70', 'Muhib', 'Opi', 'muhib.opi@gmail.com', '2020-05-06', 0, '016111222333', 'Uttara'),
(100018, '202cb962ac59075b964b07152d234b70', 'Shaila', 'Merajz 2', 'shaila.meraz2@gmail.com', '1995-05-29', 25, '016666666', 'Uttara'),
(100019, '202cb962ac59075b964b07152d234b70', 'Saiful', 'bal', 'j2019y@gmail.com', '2020-05-16', 0, '213213 324325 346', 'ctg');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE `prescription` (
  `prescription_id` int(15) NOT NULL,
  `file_patient_id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `upload_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`prescription_id`, `file_patient_id`, `file_name`, `upload_date`) VALUES
(3, 100016, ' uploads/user_100016/img_1590744389206.jpg', '2020-05-29'),
(4, 100016, ' uploads/user_100016/img_1590744724032.jpg', '2020-05-29'),
(5, 100016, ' uploads/user_100016/img_1590746813645.jpg', '2020-05-29'),
(6, 100017, ' uploads/user_100017/img_1590777587765.png', '2020-05-29'),
(7, 100017, ' uploads/user_100017/img_1590777615379.jpg', '2020-05-29'),
(8, 100017, ' uploads/user_100017/img_1590777901888.jpg', '2020-05-29'),
(9, 100016, ' uploads/user_100016/img_1590805184129.jpg', '2020-05-29'),
(10, 100018, ' uploads/user_100018/img_1590805584412.jpg', '2020-05-29'),
(11, 100018, ' uploads/user_100018/img_1590805602702.jpg', '2020-05-29'),
(12, 100018, ' uploads/user_100018/img_1590805609165.jpg', '2020-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `specilization`
--

CREATE TABLE `specilization` (
  `S_Name` varchar(50) NOT NULL,
  `Doctorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specilization`
--

INSERT INTO `specilization` (`S_Name`, `Doctorid`) VALUES
('Allergists', 0),
('Anesthesiologists', 136),
('Dermatologists', 136),
('Pathologists', 136),
('Neurologists', 136),
('Allergists', 137),
('Anesthesiologists', 138),
('Obstetricians and Gynecologists', 140);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Appointment_id`);

--
-- Indexes for table `chamber`
--
ALTER TABLE `chamber`
  ADD PRIMARY KEY (`Chamber_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`Doctorid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
  ADD PRIMARY KEY (`prescription_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000000014;

--
-- AUTO_INCREMENT for table `chamber`
--
ALTER TABLE `chamber`
  MODIFY `Chamber_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `Doctorid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100020;

--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
  MODIFY `prescription_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
