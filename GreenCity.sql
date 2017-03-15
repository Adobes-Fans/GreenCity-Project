-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-03-15 22:57:50
-- 服务器版本： 5.6.34-log
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GreenCity`
--

-- --------------------------------------------------------

--
-- 表的结构 `basement`
--

CREATE TABLE IF NOT EXISTS `basement` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `projectID` int(11) NOT NULL,
  `projectName` varchar(64) NOT NULL,
  `floor` int(11) NOT NULL,
  `airShelter` tinyint(1) NOT NULL,
  `airShelterArea` float NOT NULL,
  `basementArea` float NOT NULL,
  `basementStructure` enum('无梁楼盖','普通梁板','大板结构','') NOT NULL,
  `designStartDay` date NOT NULL,
  `designEndDay` date NOT NULL,
  `waterLevel` float NOT NULL,
  `coveredDepth` float NOT NULL,
  `basementDescription` varchar(256) NOT NULL,
  `rebarAirShelter` float NOT NULL,
  `rebarNoAirShelter` float NOT NULL,
  `rebarTower` float NOT NULL,
  `rebarNoTower` float NOT NULL,
  `rebarIntegrated` float NOT NULL,
  `concreteAirShelter` float NOT NULL,
  `concreteNoAirShelter` float NOT NULL,
  `concreteTower` float NOT NULL,
  `concreteNoTower` float NOT NULL,
  `concreteIntegrated` float NOT NULL,
  `steelAirShelter` float NOT NULL,
  `steelNoAirShelter` float NOT NULL,
  `steelTower` float NOT NULL,
  `steelNoTower` float NOT NULL,
  `steelIntegrated` float NOT NULL,
  `authorName` varchar(256) NOT NULL,
  `authorID` varchar(256) NOT NULL,
  `authorIP` varchar(256) NOT NULL,
  `isExisting` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Project`
--

CREATE TABLE IF NOT EXISTS `Project` (
  `projectID` int(11) NOT NULL,
  `projectName` varchar(64) NOT NULL,
  `buildingType` enum('别墅','合院','排屋','多高层普通住宅','酒店式公寓','办公楼','商业','酒店','学校','综合体','其它') NOT NULL,
  `city` varchar(32) DEFAULT NULL,
  `seismicPreIntensity` enum('非抗震','6度','7度','7.5度','8度','8.5度','9度') NOT NULL,
  `developer` varchar(128) DEFAULT NULL,
  `basicWindPressure` varchar(16) DEFAULT NULL,
  `basicSnowPressure` varchar(16) DEFAULT NULL,
  `inputerID` int(8) NOT NULL,
  `inputerName` varchar(64) NOT NULL,
  `inputerIP` varchar(32) NOT NULL,
  `inputTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isExisting` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `superStructure`
--

CREATE TABLE IF NOT EXISTS `superStructure` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `projectID` int(11) NOT NULL,
  `projectName` varchar(64) NOT NULL,
  `mainType` varchar(64) NOT NULL,
  `mainMeterial` enum('钢筋混凝土','钢-混凝土混合','钢') NOT NULL,
  `floor` int(11) NOT NULL,
  `havaLoft` tinyint(1) NOT NULL,
  `height` float NOT NULL,
  `deepWidthRadioMin` float DEFAULT NULL,
  `deepWidthRadioMax` float DEFAULT NULL,
  `deepLengthRadioMin` float DEFAULT NULL,
  `deepLengthRadioMax` float DEFAULT NULL,
  `seismicOverrun` tinyint(1) NOT NULL,
  `seismicPerformance` enum('B','C','D','C+D') NOT NULL,
  `fileName` varchar(64) NOT NULL,
  `designBegin` date DEFAULT NULL,
  `designEnd` date DEFAULT NULL,
  `softwaveAndVer` varchar(64) DEFAULT NULL,
  `rebarPodiumReal` float DEFAULT NULL,
  `rebarPodiumTheo` float DEFAULT NULL,
  `rebarStandardReal` float DEFAULT NULL,
  `rebarStandardTheo` float DEFAULT NULL,
  `concretePodiumReal` float DEFAULT NULL,
  `concretePodiumTheo` float DEFAULT NULL,
  `concreteStandardReal` float DEFAULT NULL,
  `concreteStandardTheo` float DEFAULT NULL,
  `steelPodiumReal` float DEFAULT NULL,
  `steelPodiumTheo` float DEFAULT NULL,
  `steelStandardReal` float DEFAULT NULL,
  `steelStandardTheo` float DEFAULT NULL,
  `inputerID` int(4) NOT NULL,
  `inputerName` varchar(64) NOT NULL,
  `inputerIP` varchar(32) NOT NULL,
  `inputTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isExisting` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basement`
--
ALTER TABLE `basement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`projectID`),
  ADD KEY `inputerID` (`inputerID`);

--
-- Indexes for table `superStructure`
--
ALTER TABLE `superStructure`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basement`
--
ALTER TABLE `basement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `projectID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `superStructure`
--
ALTER TABLE `superStructure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
