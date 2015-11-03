-- Create the database.
CREATE DATABASE `multsyst`;
USE multsyst;

-- Used in order to count the votes for each song.

CREATE TABLE IF NOT EXISTS `psifoi` (
  `id_theshs` int(11) NOT NULL,
  `id_tragoydioy` int(11) NOT NULL,
  `mytimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Used in order to count the votes for each video.

CREATE TABLE IF NOT EXISTS `psifoi_video` (
  `id_theshs` int(11) NOT NULL,
  `id_video` int(11) NOT NULL,
  `mytimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Holds the id and the password for each seat.

CREATE TABLE IF NOT EXISTS `theseis` (
  `id` int(11) NOT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Holds info about a song.

CREATE TABLE IF NOT EXISTS `tragoudia` (
  `id` int(11) NOT NULL,
  `name` varchar(10000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Holds info about a video.

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Holds the translated text for some elements on the user interface.

CREATE TABLE IF NOT EXISTS `metafraseis` (
  `key` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `lang` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `value` text COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Initial translation to Greek and English.

INSERT INTO `metafraseis` (`key`, `lang`, `value`) VALUES
('title', 'GR', 'Διαδραστικό σύστημα multimedia'),
('title', 'EN', 'Multimedia System'),
('h1', 'EN', 'Welcome'),
('h1', 'GR', 'Καλωσορίσατε'),
('h2', 'GR', 'Διαδραστικό Σύστημα Μultimedia Λεοφωρείου 157 ΚΤΕΛ Ιωαννίνων Α.Ε.'),
('h2', 'EN', 'Interactive Multimedia System / 157 Bus / Ktel Ioanninon S.A. '),
('o1', 'GR', 'Οδηγίες - Πληροφορίες'),
('o1', 'EN', 'Information'),
('o2', 'GR', 'Προτιμήσεις (Μουσικής-Ταινίας)'),
('o2', 'EN', 'Preferences (Music - Video)'),
('o3', 'GR', 'Λεωφορείο στο Χάρτη'),
('o3', 'EN', 'Bus on Map'),
('o5', 'GR', 'Πληροφορίες Δρομολογίων και Λοιπών ΚΤΕΛ Ιωαννίνων Α.Ε.'),
('o5', 'EN', 'Routes Information official site Ktel Ioanninon S.A. '),
('info1', 'GR', ' 	Καλό Ταξίδι ! Μπορείτε σε αυτή την σελίδα να περάσετε το χρόνο σας ευχάριστα .Να συμμετέχετε στη μουσική που θα ακουστεί και στην προβολή ταινίας ( για μεγάλα ταξίδια ) . Μπορείτε να βρείτε το Λεωφορείο στα social media (Foursquare-Facebook) ώστε να αλληλεπιδράσετε μεταξύ σας, να αφήσετε σχόλια και τέλος να βρείτε το λεωφορείο στο χάρτη . Χαιρόμαστε που ταξιδεύετε μαζί μας . 	Το παρόν υλοποιήθηκε ως Διπλωματική εργασία στο τμήμα Μηχανικών Υπολογιστών και Πληροφορικής του Πανεπιστημίου Ιωαννίνων με επιβλέποντα τον Καθηγητή Ιωάννη Φούντο.'),
('info1', 'EN', 'Have a nice trip ! You can spend your time with pleasure here .You can send your preferences about Music and Movie that you like to watch (for long distance routes). You can also find the bus with social media (Foursquare - Facebook) , in which you can react between you and also find it on map (Foursquare). Thank you for travelling with us . This program created as a Thesis for Department of Computer Engineer and Computer Science of University of Ioannina with supervisor Professor Ioannis Foudos.   '),
('optiontitle', 'GR', 'Προτιμήσεις'),
('optiontitle', 'EN', 'Preferences'),
('m1', 'EN', 'Vote for music'),
('m1', 'GR', 'Ψηφίστε Μουσική'),
('v1', 'EN', 'Vote Video(for long routes)'),
('v1', 'GR', 'Ψηφίστε Βίντεο (Για Μεγάλες Διαδρομές)'),
('ns', 'EN', 'No songs at list'),
('ns', 'GR', 'Δεν υπάρχουν τραγούδια στη λίστα'),
('bk', 'EN', 'Go Back'),
('bk', 'GR', 'Επιστροφή'),
('vtok', 'EN', 'Your vote send to system'),
('vtok', 'GR', 'Η ψήφος καταμετρήθηκε'),
('vtnok', 'EN', 'Your vote does not send to system'),
('vtnok', 'GR', 'Η ψήφος σου δεν καταμετρήθηκε'),
('enter_id_pass', 'GR', 'Βάλτε τα στοιχεία σας'),
('enter_id_pass', 'EN', 'Enter your seat and password'),
('seat', 'GR', 'Θέση'),
('seat', 'EN', 'Seat'),
('pass', 'GR', 'Κωδικός'),
('pass', 'EN', 'Password'),
('submit', 'GR', 'Υποβολή'),
('submit', 'EN', 'Submit'),
('please_connect', 'EN', 'Please connect'),
('please_connect', 'GR', 'Παρακαλούμε συνδεθείτε '),
('connect', 'EN', 'Connect'),
('connect', 'GR', 'Σύνδεση'),
('many_votes', 'GR', 'Ψηφίζετε πολύ συχνά. Δοκιμάστε ξανά σε λίγο.'),
('many_votes', 'EN', 'Too many votes. Try again later.');

