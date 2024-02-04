-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 28 Ιαν 2024 στις 08:10:49
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `cinema_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `email`, `phone`, `message`, `submitted_at`) VALUES
(1, 'nn@nn', '65686', 'ff', '2024-01-05 00:19:52'),
(2, 'nn@nn', '65686', 'ff', '2024-01-05 00:27:00'),
(3, 'nn@nn', '65686', 'ff', '2024-01-05 00:27:09'),
(4, 'nn@nn', '65686', 'ff', '2024-01-05 00:27:53'),
(5, 'nn@nn', '65686', 'ff', '2024-01-05 00:28:08'),
(6, 'nn@nn', '65686', 'ff', '2024-01-05 00:28:43'),
(7, 'nn@nn', '65686', 'ff', '2024-01-05 00:29:28'),
(9, 'dd@dd', '123456677', 'DOO DOO DAA DA ', '2024-01-28 03:27:01'),
(10, 'dd@dd', 'bsb', 'bdsb', '2024-01-28 04:46:37');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `cast` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image_url`, `cast`) VALUES
(2, 'Mystery at the Manor', 'A detective uncovers secrets in an old estate.', '\\CinemaWebApp\\images\\mysterious.png', 'Benedict Cumberbatch as the astute detective, Sherlock Holmess\r\nHelen Mirren as the manor\'s enigmatic owner, Lady Elizabeth Ashbury\r\nTom Hiddleston as the secretive butler, Mr. Jonathan Harrow\r\nRachel Weisz as the inquisitive journalist, Sarah Bennett'),
(3, 'Space Odyssey', 'Astronauts embark on a perilous space mission.', '\\CinemaWebApp\\images\\space.png', 'Chris Hemsworth as the mission commander, Captain Jack Armstrong\r\nSandra Bullock as the mission\'s chief scientist, Dr. Anna Kozlov\r\nJohn Boyega as the young and enthusiastic pilot, Lieutenant Marcus Wright\r\nSigourney Weaver as the experienced astronaut and mentor, Commander Ellen Ripley'),
(4, 'Comedy Nights', 'A hilarious comedy about life in the suburbs.', '\\CinemaWebApp\\images\\humorous.png', 'Kevin Hart as the quirky neighbor, Charlie Johnson\r\nTina Fey as the suburban mom trying to keep it all together, Laura Newman\r\nSteve Carell as the overzealous Homeowners Association president, Frank Henderson\r\nKristen Wiig as the new-in-town yoga instructor, Maggie Rose'),
(5, 'Romance Dawn', 'Two souls meet and their destinies intertwine.', '\\CinemaWebApp\\images\\romantic.png', 'Ryan Gosling as the charming writer, Ethan Clarke\r\nEmma Stone as the aspiring artist, Sophia Bell\r\nDev Patel as the best friend and confidant, Aarav Singh\r\nLupita Nyong\'o as the local cafe owner, Grace Ndongo'),
(6, 'Galactic Explorers', 'Join a team of astronauts as they embark on an interstellar journey to discover new worlds.', '\\CinemaWebApp\\images\\galactic_explorers.png', 'Chris Pine, Zoe Saldana, and John Cho.'),
(7, 'The Lost Puppy Adventure', 'A heartwarming tale of children in a neighborhood embarking on an exciting quest to find a lost puppy.', '\\CinemaWebApp\\images\\lost_puppy_adventure.png', 'Isabela Moner, Noah Jupe, and a cute golden retriever.'),
(8, 'Shadows in the Alley', 'A gripping thriller about the mysterious events unfolding in a city\'s darkest alleys.', '\\CinemaWebApp\\images\\shadows_in_the_alley.png', 'Jake Gyllenhaal, Rami Malek, and Scarlett Johansson.'),
(9, 'Love at the Coffee Shop', 'A lighthearted romantic comedy about unexpected encounters and the joy of finding love in everyday places.', '\\CinemaApplication\\images\\love_at_the_coffee_shop.png', 'Emma Stone, Ryan Gosling, and a lively ensemble.'),
(10, 'The Forgotten Kingdom', 'An epic tale set in a magnificent ancient kingdom, full of intrigue and grandeur.', '\\CinemaWebApp\\images\\forgotten_kingdom.png', 'Idris Elba, Lupita Nyong\'o, and Chiwetel Ejiofor.'),
(11, 'Ocean\'s Echo', 'A captivating undersea adventure revealing the mysteries of the ocean.', '\\CinemaWebApp\\images\\oceans_echo.png', 'Jason Momoa, Natalie Portman, and Dave Bautista'),
(12, 'Mystery of the Enchanted Forest', 'A magical journey into an enchanted forest where myths come to life.', '\\CinemaWebApp\\images\\enchanted_forest_mystery.png', 'Emma Watson, Tom Holland, and Cate Blanchett'),
(13, 'Chronicles of the Future', 'A sci-fi saga about time travelers fighting to save the future.', '\\CinemaWebApp\\images\\chronicles_of_the_future.png', 'Keanu Reeves, Millie Bobby Brown, and Hugh Jackman'),
(14, 'The Last Artist', 'A compelling drama about the last surviving artist in a dystopian world.', '\\CinemaWebApp\\images\\the_last_artist.png', 'Viola Davis, Denzel Washington, and Michael B. Jordan'),
(15, 'Haunting at Hill House', 'A spine-chilling tale of a group of friends who encounter paranormal activities in an old mansion.', '\\CinemaWebApp\\images\\haunting_at_hill_house.png', 'Elizabeth Olsen, Patrick Wilson, and Vera Farmiga');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `number_of_tickets` int(11) NOT NULL,
  `ticket_unique_number` varchar(10) NOT NULL,
  `total_amount` decimal(10,0) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Confirmed','Denied','Pending') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `user_id`, `show_id`, `room_id`, `number_of_tickets`, `ticket_unique_number`, `total_amount`, `reservation_date`, `status`) VALUES
(106, 2, 66, 1, 3, 'DC0ZUXK5Y2', 6, '2024-01-27 22:56:30', 'Confirmed'),
(107, 2, 66, 1, 2, 'SWL8O7GJ86', 4, '2024-01-27 22:56:43', 'Confirmed'),
(114, 2, 124, 2, 2, '2P9LLDA3Z9', 4, '2024-01-28 01:08:46', 'Pending'),
(116, 2, 124, 2, 2, '0E7V2UY5MY', 4, '2024-01-28 04:46:18', 'Pending'),
(117, 7, 90, 6, 3, '46Y75JYA0A', 12, '2024-01-28 05:02:52', 'Pending'),
(118, 2, 124, 2, 2, '6TU3WIJ2H6', 4, '2024-01-28 05:25:16', 'Pending');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reservation_seats`
--

CREATE TABLE `reservation_seats` (
  `reservation_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `reservation_seats`
--

INSERT INTO `reservation_seats` (`reservation_id`, `seat_id`) VALUES
(106, 476),
(106, 477),
(106, 487),
(107, 485),
(107, 495),
(114, 502),
(114, 503),
(116, 524),
(116, 525),
(117, 617),
(117, 647),
(117, 650),
(118, 516),
(118, 517);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number_of_seats` int(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `number_of_seats`, `type`) VALUES
(1, 'Room 1', 50, 'Regular'),
(2, 'Room 2', 50, 'Regular'),
(5, 'Room 3', 50, '3D'),
(6, 'Room 4', 50, '3D'),
(7, 'Room 5', 50, 'IMAX'),
(8, 'Room 6', 50, 'IMAX'),
(9, 'Room 7', 50, 'IMAX');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `seat_number` varchar(3) NOT NULL,
  `status` enum('available','selected','reserved','') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `seats`
--

INSERT INTO `seats` (`seat_id`, `room_id`, `seat_number`, `status`) VALUES
(452, 1, 'A1', 'available'),
(453, 1, 'A2', 'available'),
(454, 1, 'A3', 'available'),
(455, 1, 'A4', 'available'),
(456, 1, 'A5', 'available'),
(457, 1, 'A6', 'available'),
(458, 1, 'A7', 'available'),
(459, 1, 'A8', 'available'),
(460, 1, 'A9', 'available'),
(461, 1, 'A10', 'available'),
(462, 1, 'B1', 'available'),
(463, 1, 'B2', 'available'),
(464, 1, 'B3', 'available'),
(465, 1, 'B4', 'available'),
(466, 1, 'B5', 'available'),
(467, 1, 'B6', 'available'),
(468, 1, 'B7', 'available'),
(469, 1, 'B8', 'available'),
(470, 1, 'B9', 'available'),
(471, 1, 'B10', 'available'),
(472, 1, 'C1', 'available'),
(473, 1, 'C2', 'available'),
(474, 1, 'C3', 'available'),
(475, 1, 'C4', 'available'),
(476, 1, 'C5', 'available'),
(477, 1, 'C6', 'available'),
(478, 1, 'C7', 'available'),
(479, 1, 'C8', 'available'),
(480, 1, 'C9', 'available'),
(481, 1, 'C10', 'available'),
(482, 1, 'D1', 'available'),
(483, 1, 'D2', 'available'),
(484, 1, 'D3', 'available'),
(485, 1, 'D4', 'available'),
(486, 1, 'D5', 'available'),
(487, 1, 'D6', 'available'),
(488, 1, 'D7', 'available'),
(489, 1, 'D8', 'available'),
(490, 1, 'D9', 'available'),
(491, 1, 'D10', 'available'),
(492, 1, 'E1', 'available'),
(493, 1, 'E2', 'available'),
(494, 1, 'E3', 'available'),
(495, 1, 'E4', 'available'),
(496, 1, 'E5', 'available'),
(497, 1, 'E6', 'available'),
(498, 1, 'E7', 'available'),
(499, 1, 'E8', 'available'),
(500, 1, 'E9', 'available'),
(501, 1, 'E10', 'available'),
(502, 2, 'A1', 'available'),
(503, 2, 'A2', 'available'),
(504, 2, 'A3', 'available'),
(505, 2, 'A4', 'available'),
(506, 2, 'A5', 'available'),
(507, 2, 'A6', 'available'),
(508, 2, 'A7', 'available'),
(509, 2, 'A8', 'available'),
(510, 2, 'A9', 'available'),
(511, 2, 'A10', 'available'),
(512, 2, 'B1', 'available'),
(513, 2, 'B2', 'available'),
(514, 2, 'B3', 'available'),
(515, 2, 'B4', 'available'),
(516, 2, 'B5', 'available'),
(517, 2, 'B6', 'available'),
(518, 2, 'B7', 'available'),
(519, 2, 'B8', 'available'),
(520, 2, 'B9', 'available'),
(521, 2, 'B10', 'available'),
(522, 2, 'C1', 'available'),
(523, 2, 'C2', 'available'),
(524, 2, 'C3', 'available'),
(525, 2, 'C4', 'available'),
(526, 2, 'C5', 'available'),
(527, 2, 'C6', 'available'),
(528, 2, 'C7', 'available'),
(529, 2, 'C8', 'available'),
(530, 2, 'C9', 'available'),
(531, 2, 'C10', 'available'),
(532, 2, 'D1', 'available'),
(533, 2, 'D2', 'available'),
(534, 2, 'D3', 'available'),
(535, 2, 'D4', 'available'),
(536, 2, 'D5', 'available'),
(537, 2, 'D6', 'available'),
(538, 2, 'D7', 'available'),
(539, 2, 'D8', 'available'),
(540, 2, 'D9', 'available'),
(541, 2, 'D10', 'available'),
(542, 2, 'E1', 'available'),
(543, 2, 'E2', 'available'),
(544, 2, 'E3', 'available'),
(545, 2, 'E4', 'available'),
(546, 2, 'E5', 'available'),
(547, 2, 'E6', 'available'),
(548, 2, 'E7', 'available'),
(549, 2, 'E8', 'available'),
(550, 2, 'E9', 'available'),
(551, 2, 'E10', 'available'),
(552, 5, 'A1', 'available'),
(553, 5, 'A2', 'available'),
(554, 5, 'A3', 'available'),
(555, 5, 'A4', 'available'),
(556, 5, 'A5', 'available'),
(557, 5, 'A6', 'available'),
(558, 5, 'A7', 'available'),
(559, 5, 'A8', 'available'),
(560, 5, 'A9', 'available'),
(561, 5, 'A10', 'available'),
(562, 5, 'B1', 'available'),
(563, 5, 'B2', 'available'),
(564, 5, 'B3', 'available'),
(565, 5, 'B4', 'available'),
(566, 5, 'B5', 'available'),
(567, 5, 'B6', 'available'),
(568, 5, 'B7', 'available'),
(569, 5, 'B8', 'available'),
(570, 5, 'B9', 'available'),
(571, 5, 'B10', 'available'),
(572, 5, 'C1', 'available'),
(573, 5, 'C2', 'available'),
(574, 5, 'C3', 'available'),
(575, 5, 'C4', 'available'),
(576, 5, 'C5', 'available'),
(577, 5, 'C6', 'available'),
(578, 5, 'C7', 'available'),
(579, 5, 'C8', 'available'),
(580, 5, 'C9', 'available'),
(581, 5, 'C10', 'available'),
(582, 5, 'D1', 'available'),
(583, 5, 'D2', 'available'),
(584, 5, 'D3', 'available'),
(585, 5, 'D4', 'available'),
(586, 5, 'D5', 'available'),
(587, 5, 'D6', 'available'),
(588, 5, 'D7', 'available'),
(589, 5, 'D8', 'available'),
(590, 5, 'D9', 'available'),
(591, 5, 'D10', 'available'),
(592, 5, 'E1', 'available'),
(593, 5, 'E2', 'available'),
(594, 5, 'E3', 'available'),
(595, 5, 'E4', 'available'),
(596, 5, 'E5', 'available'),
(597, 5, 'E6', 'available'),
(598, 5, 'E7', 'available'),
(599, 5, 'E8', 'available'),
(600, 5, 'E9', 'available'),
(601, 5, 'E10', 'available'),
(602, 6, 'A1', 'available'),
(603, 6, 'A2', 'available'),
(604, 6, 'A3', 'available'),
(605, 6, 'A4', 'available'),
(606, 6, 'A5', 'available'),
(607, 6, 'A6', 'available'),
(608, 6, 'A7', 'available'),
(609, 6, 'A8', 'available'),
(610, 6, 'A9', 'available'),
(611, 6, 'A10', 'available'),
(612, 6, 'B1', 'available'),
(613, 6, 'B2', 'available'),
(614, 6, 'B3', 'available'),
(615, 6, 'B4', 'available'),
(616, 6, 'B5', 'available'),
(617, 6, 'B6', 'available'),
(618, 6, 'B7', 'available'),
(619, 6, 'B8', 'available'),
(620, 6, 'B9', 'available'),
(621, 6, 'B10', 'available'),
(622, 6, 'C1', 'available'),
(623, 6, 'C2', 'available'),
(624, 6, 'C3', 'available'),
(625, 6, 'C4', 'available'),
(626, 6, 'C5', 'available'),
(627, 6, 'C6', 'available'),
(628, 6, 'C7', 'available'),
(629, 6, 'C8', 'available'),
(630, 6, 'C9', 'available'),
(631, 6, 'C10', 'available'),
(632, 6, 'D1', 'available'),
(633, 6, 'D2', 'available'),
(634, 6, 'D3', 'available'),
(635, 6, 'D4', 'available'),
(636, 6, 'D5', 'available'),
(637, 6, 'D6', 'available'),
(638, 6, 'D7', 'available'),
(639, 6, 'D8', 'available'),
(640, 6, 'D9', 'available'),
(641, 6, 'D10', 'available'),
(642, 6, 'E1', 'available'),
(643, 6, 'E2', 'available'),
(644, 6, 'E3', 'available'),
(645, 6, 'E4', 'available'),
(646, 6, 'E5', 'available'),
(647, 6, 'E6', 'available'),
(648, 6, 'E7', 'available'),
(649, 6, 'E8', 'available'),
(650, 6, 'E9', 'available'),
(651, 6, 'E10', 'available'),
(652, 7, 'A1', 'available'),
(653, 7, 'A2', 'available'),
(654, 7, 'A3', 'available'),
(655, 7, 'A4', 'available'),
(656, 7, 'A5', 'available'),
(657, 7, 'A6', 'available'),
(658, 7, 'A7', 'available'),
(659, 7, 'A8', 'available'),
(660, 7, 'A9', 'available'),
(661, 7, 'A10', 'available'),
(662, 7, 'B1', 'available'),
(663, 7, 'B2', 'available'),
(664, 7, 'B3', 'available'),
(665, 7, 'B4', 'available'),
(666, 7, 'B5', 'available'),
(667, 7, 'B6', 'available'),
(668, 7, 'B7', 'available'),
(669, 7, 'B8', 'available'),
(670, 7, 'B9', 'available'),
(671, 7, 'B10', 'available'),
(672, 7, 'C1', 'available'),
(673, 7, 'C2', 'available'),
(674, 7, 'C3', 'available'),
(675, 7, 'C4', 'available'),
(676, 7, 'C5', 'available'),
(677, 7, 'C6', 'available'),
(678, 7, 'C7', 'available'),
(679, 7, 'C8', 'available'),
(680, 7, 'C9', 'available'),
(681, 7, 'C10', 'available'),
(682, 7, 'D1', 'available'),
(683, 7, 'D2', 'available'),
(684, 7, 'D3', 'available'),
(685, 7, 'D4', 'available'),
(686, 7, 'D5', 'available'),
(687, 7, 'D6', 'available'),
(688, 7, 'D7', 'available'),
(689, 7, 'D8', 'available'),
(690, 7, 'D9', 'available'),
(691, 7, 'D10', 'available'),
(692, 7, 'E1', 'available'),
(693, 7, 'E2', 'available'),
(694, 7, 'E3', 'available'),
(695, 7, 'E4', 'available'),
(696, 7, 'E5', 'available'),
(697, 7, 'E6', 'available'),
(698, 7, 'E7', 'available'),
(699, 7, 'E8', 'available'),
(700, 7, 'E9', 'available'),
(701, 7, 'E10', 'available'),
(702, 8, 'A1', 'available'),
(703, 8, 'A2', 'available'),
(704, 8, 'A3', 'available'),
(705, 8, 'A4', 'available'),
(706, 8, 'A5', 'available'),
(707, 8, 'A6', 'available'),
(708, 8, 'A7', 'available'),
(709, 8, 'A8', 'available'),
(710, 8, 'A9', 'available'),
(711, 8, 'A10', 'available'),
(712, 8, 'B1', 'available'),
(713, 8, 'B2', 'available'),
(714, 8, 'B3', 'available'),
(715, 8, 'B4', 'available'),
(716, 8, 'B5', 'available'),
(717, 8, 'B6', 'available'),
(718, 8, 'B7', 'available'),
(719, 8, 'B8', 'available'),
(720, 8, 'B9', 'available'),
(721, 8, 'B10', 'available'),
(722, 8, 'C1', 'available'),
(723, 8, 'C2', 'available'),
(724, 8, 'C3', 'available'),
(725, 8, 'C4', 'available'),
(726, 8, 'C5', 'available'),
(727, 8, 'C6', 'available'),
(728, 8, 'C7', 'available'),
(729, 8, 'C8', 'available'),
(730, 8, 'C9', 'available'),
(731, 8, 'C10', 'available'),
(732, 8, 'D1', 'available'),
(733, 8, 'D2', 'available'),
(734, 8, 'D3', 'available'),
(735, 8, 'D4', 'available'),
(736, 8, 'D5', 'available'),
(737, 8, 'D6', 'available'),
(738, 8, 'D7', 'available'),
(739, 8, 'D8', 'available'),
(740, 8, 'D9', 'available'),
(741, 8, 'D10', 'available'),
(742, 8, 'E1', 'available'),
(743, 8, 'E2', 'available'),
(744, 8, 'E3', 'available'),
(745, 8, 'E4', 'available'),
(746, 8, 'E5', 'available'),
(747, 8, 'E6', 'available'),
(748, 8, 'E7', 'available'),
(749, 8, 'E8', 'available'),
(750, 8, 'E9', 'available'),
(751, 8, 'E10', 'available'),
(752, 9, 'A1', 'available'),
(753, 9, 'A2', 'available'),
(754, 9, 'A3', 'available'),
(755, 9, 'A4', 'available'),
(756, 9, 'A5', 'available'),
(757, 9, 'A6', 'available'),
(758, 9, 'A7', 'available'),
(759, 9, 'A8', 'available'),
(760, 9, 'A9', 'available'),
(761, 9, 'A10', 'available'),
(762, 9, 'B1', 'available'),
(763, 9, 'B2', 'available'),
(764, 9, 'B3', 'available'),
(765, 9, 'B4', 'available'),
(766, 9, 'B5', 'available'),
(767, 9, 'B6', 'available'),
(768, 9, 'B7', 'available'),
(769, 9, 'B8', 'available'),
(770, 9, 'B9', 'available'),
(771, 9, 'B10', 'available'),
(772, 9, 'C1', 'available'),
(773, 9, 'C2', 'available'),
(774, 9, 'C3', 'available'),
(775, 9, 'C4', 'available'),
(776, 9, 'C5', 'available'),
(777, 9, 'C6', 'available'),
(778, 9, 'C7', 'available'),
(779, 9, 'C8', 'available'),
(780, 9, 'C9', 'available'),
(781, 9, 'C10', 'available'),
(782, 9, 'D1', 'available'),
(783, 9, 'D2', 'available'),
(784, 9, 'D3', 'available'),
(785, 9, 'D4', 'available'),
(786, 9, 'D5', 'available'),
(787, 9, 'D6', 'available'),
(788, 9, 'D7', 'available'),
(789, 9, 'D8', 'available'),
(790, 9, 'D9', 'available'),
(791, 9, 'D10', 'available'),
(792, 9, 'E1', 'available'),
(793, 9, 'E2', 'available'),
(794, 9, 'E3', 'available'),
(795, 9, 'E4', 'available'),
(796, 9, 'E5', 'available'),
(797, 9, 'E6', 'available'),
(798, 9, 'E7', 'available'),
(799, 9, 'E8', 'available'),
(800, 9, 'E9', 'available'),
(801, 9, 'E10', 'available');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `show_date` date NOT NULL,
  `show_time_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `shows`
--

INSERT INTO `shows` (`id`, `movie_id`, `show_date`, `show_time_id`, `room_id`) VALUES
(159, 2, '2024-01-31', 11, 5),
(103, 2, '2024-02-01', 11, 2),
(122, 2, '2024-02-05', 10, 9),
(2, 2, '2024-02-05', 11, 2),
(141, 2, '2024-02-09', 14, 7),
(67, 2, '2024-02-11', 13, 2),
(87, 2, '2024-02-26', 12, 1),
(32, 2, '2024-02-28', 11, 6),
(50, 2, '2024-02-29', 14, 1),
(104, 3, '2024-02-01', 12, 5),
(123, 3, '2024-02-05', 11, 1),
(3, 3, '2024-02-07', 12, 5),
(142, 3, '2024-02-09', 10, 8),
(66, 3, '2024-02-09', 12, 1),
(31, 3, '2024-02-26', 10, 5),
(49, 3, '2024-02-27', 13, 9),
(105, 4, '2024-02-01', 13, 6),
(124, 4, '2024-02-05', 12, 2),
(89, 4, '2024-02-05', 14, 5),
(65, 4, '2024-02-07', 11, 9),
(143, 4, '2024-02-09', 11, 9),
(4, 4, '2024-02-09', 13, 6),
(30, 4, '2024-02-24', 14, 2),
(48, 4, '2024-02-25', 12, 8),
(64, 5, '2024-02-05', 10, 8),
(125, 5, '2024-02-05', 13, 5),
(90, 5, '2024-02-07', 10, 6),
(144, 5, '2024-02-10', 12, 1),
(106, 5, '2024-02-11', 12, 5),
(5, 5, '2024-02-11', 14, 7),
(29, 5, '2024-02-22', 13, 1),
(47, 5, '2024-02-23', 11, 7),
(107, 6, '2024-02-02', 10, 8),
(63, 6, '2024-02-03', 14, 7),
(126, 6, '2024-02-06', 14, 6),
(91, 6, '2024-02-09', 11, 7),
(145, 6, '2024-02-10', 13, 2),
(6, 6, '2024-02-13', 10, 8),
(28, 6, '2024-02-20', 12, 9),
(46, 6, '2024-02-21', 10, 6),
(108, 7, '2024-02-02', 11, 9),
(127, 7, '2024-02-06', 10, 7),
(146, 7, '2024-02-10', 14, 5),
(92, 7, '2024-02-11', 12, 8),
(7, 7, '2024-02-15', 11, 9),
(27, 7, '2024-02-18', 11, 8),
(45, 7, '2024-02-19', 14, 5),
(62, 7, '2024-02-28', 13, 6),
(109, 8, '2024-02-02', 12, 1),
(128, 8, '2024-02-06', 11, 8),
(147, 8, '2024-02-10', 10, 6),
(93, 8, '2024-02-13', 13, 9),
(26, 8, '2024-02-16', 10, 7),
(8, 8, '2024-02-17', 12, 1),
(44, 8, '2024-02-17', 13, 2),
(61, 8, '2024-02-26', 12, 5),
(110, 9, '2024-02-02', 13, 2),
(129, 9, '2024-02-06', 12, 9),
(148, 9, '2024-02-11', 11, 7),
(25, 9, '2024-02-14', 14, 6),
(43, 9, '2024-02-15', 12, 1),
(94, 9, '2024-02-15', 14, 1),
(9, 9, '2024-02-19', 13, 2),
(60, 9, '2024-02-24', 11, 2),
(111, 10, '2024-02-02', 14, 5),
(76, 10, '2024-02-04', 11, 6),
(130, 10, '2024-02-07', 13, 1),
(149, 10, '2024-02-11', 12, 8),
(42, 10, '2024-02-13', 11, 9),
(95, 10, '2024-02-17', 10, 2),
(24, 10, '2024-02-18', 13, 5),
(10, 10, '2024-02-21', 14, 5),
(59, 10, '2024-02-22', 10, 1),
(112, 11, '2024-02-03', 10, 6),
(77, 11, '2024-02-06', 12, 7),
(131, 11, '2024-02-07', 14, 2),
(41, 11, '2024-02-11', 10, 8),
(150, 11, '2024-02-11', 13, 9),
(96, 11, '2024-02-19', 11, 5),
(23, 11, '2024-02-20', 12, 2),
(58, 11, '2024-02-20', 14, 9),
(11, 11, '2024-02-23', 10, 6),
(113, 12, '2024-02-03', 11, 7),
(132, 12, '2024-02-07', 10, 5),
(78, 12, '2024-02-08', 13, 8),
(40, 12, '2024-02-09', 14, 7),
(151, 12, '2024-02-11', 14, 1),
(57, 12, '2024-02-18', 13, 8),
(97, 12, '2024-02-21', 12, 6),
(12, 12, '2024-02-25', 11, 7),
(22, 12, '2024-02-26', 11, 1),
(114, 13, '2024-02-03', 12, 8),
(133, 13, '2024-02-07', 11, 6),
(39, 13, '2024-02-07', 13, 6),
(79, 13, '2024-02-10', 14, 9),
(152, 13, '2024-02-12', 10, 2),
(56, 13, '2024-02-16', 12, 7),
(98, 13, '2024-02-23', 13, 7),
(21, 13, '2024-02-24', 10, 9),
(75, 13, '2024-02-27', 11, 5),
(13, 13, '2024-02-27', 12, 8),
(115, 14, '2024-02-03', 13, 9),
(134, 14, '2024-02-07', 12, 7),
(80, 14, '2024-02-12', 10, 1),
(55, 14, '2024-02-14', 11, 6),
(20, 14, '2024-02-22', 14, 8),
(74, 14, '2024-02-25', 10, 2),
(99, 14, '2024-02-25', 14, 8),
(15, 15, '2024-02-04', 14, 1),
(116, 15, '2024-02-04', 14, 1),
(135, 15, '2024-02-08', 13, 8),
(54, 15, '2024-02-12', 10, 5),
(81, 15, '2024-02-14', 11, 2),
(34, 15, '2024-02-23', 13, 8),
(73, 15, '2024-02-23', 14, 1),
(100, 15, '2024-02-27', 10, 9);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `show_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `showtimes`
--

INSERT INTO `showtimes` (`id`, `show_time`) VALUES
(10, '13:00 - 15:00'),
(11, '15:30 - 17:30'),
(12, '18:00 - 20:00'),
(13, '20:30 - 22:30'),
(14, '23:00 - 1:00');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `is_admin`) VALUES
(2, 'vv', 'vv@vv', '$2y$10$ZwXsOm2epM8/T3tXWPYLWuWGnt2rN5F5PCJREqt.kc6P/Bg/P8Y9G', '2023-12-18 18:46:43', 0),
(3, 'ee', 'ee@ee', '$2y$10$cmhSyr2kTVyAarTfOzyyzOQfX2udyq12kDfEC4Z6CLGkeAUD3sddq', '2023-12-18 18:47:45', 0),
(4, 'nn', 'nn@nn', '$2y$10$evZ6uDvN14fkaEzhFCoPYO62Lxap15HSHiZ561PtizkqXgX0fP7Zy', '2024-01-04 16:15:54', 0),
(7, 'qq', 'qq@qq', '$2y$10$bKY8929zIBuTAOXhvMvUp.UKCor78FxkkOh06twxkCTB.fo7qGiXS', '2024-01-09 14:56:30', 1),
(8, 'wg', 'wg@wg', '$2y$10$ZEgSRRk.EHAc0Z5dQnPHj.Xb3u3wqDedssx8d8JMIS4RmVJyEmcza', '2024-01-27 21:27:09', 0),
(9, 'dd', 'dd@dd', '$2y$10$VJ7FUfrr2EUCfBT.LWTQy.k7mPihPr8ZKEsl2QfBpVbrXRiQP.Byi', '2024-01-28 03:24:04', 0);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Ευρετήρια για πίνακα `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reservations_ibfk_3` (`show_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Ευρετήρια για πίνακα `reservation_seats`
--
ALTER TABLE `reservation_seats`
  ADD PRIMARY KEY (`reservation_id`,`seat_id`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Ευρετήρια για πίνακα `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Ευρετήρια για πίνακα `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `show_time_id` (`show_time_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `movie_id` (`movie_id`,`show_date`,`show_time_id`,`room_id`);

--
-- Ευρετήρια για πίνακα `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT για πίνακα `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT για πίνακα `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT για πίνακα `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=802;

--
-- AUTO_INCREMENT για πίνακα `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT για πίνακα `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD CONSTRAINT `contact_messages_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`);

--
-- Περιορισμοί για πίνακα `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`show_id`) REFERENCES `shows` (`id`),
  ADD CONSTRAINT `reservations_ibfk_6` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Περιορισμοί για πίνακα `reservation_seats`
--
ALTER TABLE `reservation_seats`
  ADD CONSTRAINT `reservation_seats_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`reservation_id`),
  ADD CONSTRAINT `reservation_seats_ibfk_2` FOREIGN KEY (`seat_id`) REFERENCES `seats` (`seat_id`);

--
-- Περιορισμοί για πίνακα `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Περιορισμοί για πίνακα `shows`
--
ALTER TABLE `shows`
  ADD CONSTRAINT `shows_ibfk_1` FOREIGN KEY (`show_time_id`) REFERENCES `showtimes` (`id`),
  ADD CONSTRAINT `shows_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `shows_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
