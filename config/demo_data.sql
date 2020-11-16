-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 11:14 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_events_demo`
--
CREATE DATABASE IF NOT EXISTS `php_events_demo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `php_events_demo`;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `event`:
--

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(1, 'Containers & Kubernetes Conference', 'Hempstead', '7734 Fremont Street', '2020-09-18 14:30:00', 'Pellentesque a suscipit velit, a eleifend urna. Curabitur et purus dapibus lorem elementum semper sed ornare tortor. Ut volutpat, massa sed vulputate egestas, purus mauris finibus eros, sit amet semper quam lacus vitae massa. Donec gravida vulputate ipsum nec ultricies. Phasellus sem magna, vehicula id libero vitae, consequat aliquam massa. Integer euismod leo ut fermentum vestibulum. Donec eu malesuada dui, quis placerat erat. Vestibulum congue auctor nisl, a varius leo. Cras erat sapien, consequat vitae aliquam vitae, imperdiet eu dui. Morbi id ante eget tortor scelerisque laoreet sit amet et lectus. Duis non libero fermentum, sollicitudin odio at, fermentum libero. In ante nunc, interdum rutrum nulla a, iaculis rutrum sem.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(2, 'BlockDev Conference', 'Woodside', '751 West Brewery St.', '2020-10-11 08:00:00', 'Nam vel felis interdum, ultrices nibh in, mattis orci. In hac habitasse platea dictumst. In id dui turpis. Proin sem lacus, facilisis id leo quis, vehicula aliquet magna. Etiam mollis metus non dui consectetur, et sodales nunc ullamcorper. Mauris ut sem a augue semper aliquet sit amet ut enim. Aenean placerat mauris non odio convallis, at eleifend arcu rutrum. Vestibulum at sollicitudin erat.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(3, 'API & Microservices Conference', 'New York', '8926 Bishop Dr.', '2020-09-25 11:00:00', 'Vestibulum a arcu turpis. Quisque consectetur nibh a dui tincidunt hendrerit. Cras ac neque mattis, fermentum velit sit amet, ultricies tortor. Pellentesque a porttitor ligula. Etiam ullamcorper semper gravida. Curabitur eget libero ut ligula bibendum mattis. Suspendisse scelerisque lorem at urna vulputate, scelerisque rutrum mi laoreet. Vestibulum condimentum, eros at fermentum luctus, eros ex scelerisque quam, posuere tincidunt turpis mi non lectus. Integer dignissim tempor odio, vel dictum metus mollis id. Praesent elementum est metus, eu bibendum elit scelerisque nec. Fusce quis aliquam ex. Nunc molestie consequat laoreet. Nam eget massa elit. Praesent vulputate ligula in scelerisque porttitor.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(4, 'DevOps Summit', 'Brooklyn', '8687 Studebaker St.', '2020-11-23 19:00:00', 'Proin scelerisque purus vitae ipsum tristique, et blandit ipsum pretium. Nulla ullamcorper faucibus risus non venenatis. Vestibulum purus mi, consequat porttitor neque ac, efficitur pretium libero. Aenean id ex nec magna molestie tristique. Proin non tellus sed sem molestie blandit. Morbi dui velit, posuere sit amet maximus nec, porttitor quis ipsum. Nam vel suscipit tellus. Etiam non pretium felis, tincidunt dignissim dolor. Aenean eget mattis dui. Donec sagittis lectus velit, vitae eleifend urna cursus id. Pellentesque vehicula, neque vel accumsan tristique, ipsum diam pellentesque magna, sed iaculis lorem mi vel lectus. Integer mollis efficitur diam, vel elementum lectus faucibus nec.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(5, 'JavaScript Conference', 'Bronx', '7496 Shadow Brook Street', '2020-09-20 15:00:00', 'Cras ullamcorper arcu a fermentum elementum. Sed condimentum posuere sem, id finibus nisl posuere eget. Aliquam mollis, metus id vehicula dictum, neque lorem fringilla massa, et tempor enim augue sed justo. Cras sit amet eros nec quam blandit venenatis. Aenean sapien mi, facilisis ac metus porttitor, consectetur rutrum tellus. Vestibulum convallis ex in ante condimentum pharetra. Fusce auctor nisi ex, ac rutrum sapien mollis a. In hac habitasse platea dictumst.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(6, 'ProductWorld', 'Bay Shore', '355 Shirley Court', '2020-12-18 14:00:00', 'Duis aliquam tellus ac turpis aliquam, at dapibus dui varius. Ut dignissim ex a lacinia vestibulum. Maecenas consequat purus volutpat, posuere orci sed, dignissim enim. Fusce rutrum rutrum pulvinar. Integer eget libero tellus. Nullam suscipit sagittis nunc id fermentum. Duis eget elit sem. Duis interdum orci mauris, in mattis ligula tincidunt sed.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(7, 'DeveloperWeek Hackathlon', 'Staten Island', '736 S. Temple Lane', '2020-09-01 09:30:00', 'Cras aliquet ornare purus, nec tincidunt tortor porttitor in. Curabitur vestibulum ipsum non quam ornare consectetur. Suspendisse fringilla pharetra massa. Mauris suscipit, leo vitae viverra sodales, lectus tellus fermentum sem, porttitor vestibulum ligula risus sit amet lacus. Aliquam scelerisque mollis sem eget dignissim. Etiam faucibus hendrerit cursus. Nulla gravida purus vel nisi molestie consectetur. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras iaculis viverra tellus id bibendum. Phasellus eu arcu at ligula tincidunt luctus. Duis porta est a suscipit luctus. Praesent metus odio, rutrum a hendrerit a, condimentum in ipsum. Pellentesque pulvinar porta augue vitae euismod. Vestibulum non sollicitudin nulla.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(8, 'IoT & Hardware', 'Levittown', '421 Birchpond St.', '2020-12-01 10:45:00', 'Aenean justo risus, mollis id dictum nec, maximus convallis lacus. Phasellus blandit velit et augue faucibus aliquam. In tempor volutpat quam et aliquet. Morbi eu mollis eros, in ultricies nibh. Duis dapibus tristique mauris. Vestibulum a blandit lectus, et egestas tellus. Morbi eu ex ligula. Praesent vulputate euismod justo, in laoreet velit efficitur id. Phasellus tellus metus, suscipit non dignissim a, egestas a tellus. Phasellus vitae interdum nisi, sed auctor arcu. Morbi vel hendrerit mauris. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin id tellus dictum est sagittis pretium. Vivamus vel tortor fringilla, pharetra risus eu, placerat nibh.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(9, 'BlockDev Conference', 'Buffalo', '6 Adams Drive', '2020-12-15 14:00:00', 'Maecenas velit lectus, pharetra eu dapibus id, cursus vehicula tellus. Nunc ipsum leo, finibus at augue ac, imperdiet dictum purus. Fusce nec nisl at nibh auctor tempus. Vivamus sollicitudin nisl ipsum, a ornare nisi semper porttitor. Duis nibh erat, tincidunt nec ullamcorper eu, vestibulum non leo. Duis dictum luctus pulvinar. Sed dui lacus, egestas sed ultricies vitae, sodales a ipsum. Duis sit amet tempus orci. Praesent malesuada purus in mi ultrices sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi eget maximus lorem.', '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `event` (`id`, `name`, `city`, `address`, `date`, `description`, `created_at`, `updated_at`) VALUES(10, 'QAFFNY', 'Bronx', '3 Mammoth Ave.', '2020-11-28 12:00:00', 'Cras in ornare arcu. Duis iaculis rhoncus neque, in dapibus elit tincidunt sed. Cras tincidunt imperdiet mauris, molestie posuere nisi volutpat placerat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec maximus non arcu quis scelerisque. Nunc gravida porttitor enim sed lacinia. Etiam luctus condimentum tempor.', '2020-11-16 11:07:57', '2020-11-16 11:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(10) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `member`:
--   `event_id`
--       `event` -> `id`
--

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(1, 'Lee', 'Barton', 'barton.l@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(2, 'Alicia', 'Norris', 'norris.a@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(3, 'Margie', 'Johnson', 'johnson.margie@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(4, 'Isabelle', 'Parsons', 'parsons.i@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(5, 'Cerys', 'Newman', 'newman.c@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(6, 'Ellie', 'Hart', 'hart.e@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(7, 'Kalin', 'Davidson', 'davidson.k@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(8, 'Tommy', 'Maldonado', 'maldonado.tommy@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(9, 'Bradley', 'Stephens', 'stephens.b@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(10, 'Nicholas', 'Woods', 'woods.n@email.com', 1, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(11, 'Ted', 'Houston', 'houston.t@email.com', 2, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(12, 'Oscar', 'Armstrong', 'armstrong.o@email.com', 2, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(13, 'Dominic', 'Cole', 'cole.dominic@email.com', 2, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(14, 'Molly', 'Owens', 'owens.m@email.com', 3, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(15, 'Tina', 'Burgess', 'burgess.t@email.com', 3, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(16, 'Darcie', 'Webb', 'webb.d@email.com', 3, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(17, 'Christina', 'Nelson', 'nelson.christina@email.com', 3, '2020-11-16 11:07:57', '2020-11-16 11:07:57');
INSERT INTO `member` (`id`, `first_name`, `last_name`, `email`, `event_id`, `created_at`, `updated_at`) VALUES(18, 'Emmie', 'Patton', 'patton.e@email.com', 3, '2020-11-16 11:07:57', '2020-11-16 11:07:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_event_id` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
