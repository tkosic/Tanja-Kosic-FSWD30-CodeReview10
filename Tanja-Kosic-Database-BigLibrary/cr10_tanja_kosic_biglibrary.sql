-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2018 at 04:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr10_tanja_kosic_biglibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `media_list` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `media_list`) VALUES
(1, 'Clean Bandit', '3 EP | New Eyes'),
(2, 'Ed Sheeran', 'You need me | Divide | X'),
(3, 'Bozo Vreco', 'Pandora'),
(4, 'Coldplay', 'Mylo Xyloto | Ghost Stories | Parachutes'),
(5, 'Friedrich Nietzsche', 'The Antichrist | Beyond Good and Evil'),
(6, 'Milan Kundera', 'The Unbearable Lightness of Being | Ignorance'),
(7, 'Giulia Enders', 'Gut: The Inside Story of Our Body\'s Most Underrated Organ'),
(8, 'Fjodor Dostojewski', 'The Brothers Karamazov | The Idiot'),
(9, 'T.E.Lawrence', 'Lawrence of Arabia'),
(10, 'Roman Polanski', 'The Pianist'),
(11, 'Frank Darabont', 'The Shawshank Redemption'),
(12, 'Olivier Nakache | Eric Toledano', 'The Intouchables');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_media_id` int(11) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `fk_author_id` int(11) NOT NULL,
  `fk_publisher_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `title` varchar(55) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `ISBN` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `fk_author_id`, `fk_publisher_id`, `type`, `title`, `img`, `description`, `ISBN`) VALUES
(1, 1, 1, 'CD', 'New Eyes', 'https://upload.wikimedia.org/wikipedia/en/6/60/Clean_Bandit_-_New_Eyes.png', 'New Eyes is the debut studio album by English electronic music group Clean Bandit, released on 30 May 2014 by Atlantic Records in Germany and Ireland, and 2 June 2014 in the United Kingdom, after suffering from several setbacks.', 50),
(2, 2, 2, 'CD', 'Divide', 'https://t2.genius.com/unsafe/300x0/https%3A%2F%2Fimages.genius.com%2Ffc44439c55552eb23d4a9ecb28a21f06.1000x1000x1.jpg', 'Divide is the third studio album by English singer-songwriter Ed Sheeran. It was released on 3 March 2017 through Asylum Records and Atlantic Records.', 46),
(3, 3, 3, 'CD', 'Pandora', 'https://lh3.googleusercontent.com/BSQx1wPV8_Ix8LY1gm4WL9uOaZmAqSTY357A_7u6zCaZCc2ieEordbIKBSb-YkAXnD4Dr7nndg=w300', 'Bozo Vreco (born 18 October 1983) is a Bosnian musician who is credited for the revival of sevdalinka, a traditional genre of folk music from Bosnia and Herzegovina.  In 2017, Vreco recorded his second solo album, Pandora.', 50),
(4, 4, 4, 'CD', 'Parachutes', 'https://img.discogs.com/Zl6T0OHeoBDHscA_iQWcpShTZII=/fit-in/300x300/filters:strip_icc():format(jpeg):mode_rgb():quality(40)/discogs-images/R-369337-1314899458.jpeg.jpg', 'Parachutes is the debut studio album by the British rock band Coldplay. It was released on 10 July 2000 by Parlophone in the United Kingdom.', 41),
(5, 5, 5, 'Book', 'Beyond Good and Evil', 'http://covers.audiobooks.com/images/covers/full/SABFAB9780625.jpg', 'In Beyond Good and Evil, Nietzsche accuses past philosophers of lacking critical sense and blindly accepting dogmatic premises in their consideration of morality.', 9781494240615),
(6, 6, 6, 'Book', 'The Unbearable Lightness of Being', 'https://images-na.ssl-images-amazon.com/images/I/419kpnNtr5L._AA300_.jpg', 'The Unbearable Lightness of Being takes place mainly in Prague in the late 1960s and early 1970s.', 9788447300044),
(7, 7, 7, 'Book', 'Gut', 'https://images-na.ssl-images-amazon.com/images/I/51k5I3Ed60L._AA300_.jpg', 'This book explains the functions, the importance of the human gastrointestinal tractcriticises and the excess of hygiene in society and its impact on the immune system.', 9781771641494),
(8, 8, 8, 'Book', 'The Idiot', 'https://images-na.ssl-images-amazon.com/images/I/51ARRpVSeCL._AA300_.jpg', 'The Idiot is a novel by the 19th-century Russian author Fyodor Dostoyevsky. It was first published serially in the journal The Russian Messenger in 1868/9.', 9782070107155),
(9, 9, 9, 'DVD', 'Lawrence of Arabia', 'https://e.snmc.io/lk/f/l/a96f6e986474e93a7ae3dd04a702fa4d/1731676.jpg', 'Lawrence of Arabia is a 1962 epic historical drama film based on the life of T. E. Lawrence. It is widely considered one of the greatest and most influential films in the history of cinema.', 222),
(10, 10, 10, 'DVD', 'The Pianist', 'https://exlibris.blob.core.windows.net/covers/5099/7087/7392/2/5099708773922xxl.jpg', 'The Pianist is a 2002 biographical drama film co-produced and directed by Roman Polanski. It is based on the autobiographical book The Pianist, a World War II memoir by the Polish-Jewish pianist and composer Władysław Szpilman.', 150),
(11, 11, 11, 'DVD', 'The Shawshank Redemption', 'https://www.warnerbros.com/sites/default/files/styles/focal_point_medium_300x300/public/the_shawshank_redemption_posterlarge_0-675188670.jpg?itok=iy-D3aHZ', 'The Shawshank Redemption is a 1994 American drama film that tells the story of banker Andy Dufresne (Tim Robbins), who is sentenced to life in Shawshank State Penitentiary for the murder of his wife and her lover, despite his claims of innocence. ', 142),
(12, 12, 12, 'DVD', 'The Intouchables', 'https://resizing.flixster.com/pRkfJvEO0LCZnqaQv0QVQMP1Xw8=/300x300/v1.bTsxMTE2OTE4MztqOzE3Njc5OzEyMDA7ODAwOzEyMDA', 'The Intouchables is a 2011 French buddy comedy-drama film directed by Olivier Nakache & Eric Toledano. It stars Francois Cluzet and Omar Sy.', 112);

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE `publisher` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `address`, `size`) VALUES
(1, 'Atlantic Records UK', 'private', 'big'),
(2, 'Atlantic Records UK', 'private', 'big'),
(3, 'Gratiartis', 'private', 'small'),
(4, 'Parlophone | Warner Music ', 'private', 'big'),
(5, 'Neumann Verlag', 'Schwalbenweg 1 | 34212 Melsungen | Germany', 'medium'),
(6, 'Carl Hanser Verlag', 'Kolbergerstraße 22 | 81679 München | Germany', 'medium'),
(7, 'Ullstein Hardcover', 'Friedrichstraße 126 | 10117 Berlin | Germany', 'medium'),
(8, 'Piper Verlag', 'Georgenstraße 4 | 80799 München | Germany', 'big'),
(9, 'Columbia Pictures', 'private', 'big'),
(10, 'Focus Features', 'private', 'big'),
(11, 'Columbia Pictures', 'private', 'big'),
(12, 'Quad Productions', 'private', 'big');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `gender`, `birthdate`, `user_email`, `user_pass`) VALUES
(1, 'Tanja', 'Kosic', 'female', '1991-09-29', 'kosic.tanja@hotmail.com', 'bumbum77'),
(2, 'Mirko', 'Kosic', 'male', '1963-05-15', 'kosic.tanja@yahoo.com', 'desanka45'),
(3, 'Jasna', 'Coprka', 'female', '1988-05-05', 'kosictannja@gmail.com', 'password66'),
(4, 'Marko', 'Markovic', 'male', '1989-07-21', 'markovic.marko@hotmail.com', 'markomarkovic'),
(5, 'Maria', 'MÃ¼ller', 'female', '1993-06-25', 'maria.mueller@neko.com', '123456789987456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_media_id` (`fk_media_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `fk_author_id` (`fk_author_id`),
  ADD KEY `fk_publisher_id` (`fk_publisher_id`);

--
-- Indexes for table `publisher`
--
ALTER TABLE `publisher`
  ADD PRIMARY KEY (`publisher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `publisher`
--
ALTER TABLE `publisher`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `login_ibfk_2` FOREIGN KEY (`fk_media_id`) REFERENCES `media` (`media_id`);

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`fk_author_id`) REFERENCES `author` (`author_id`),
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`fk_publisher_id`) REFERENCES `publisher` (`publisher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
