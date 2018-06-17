-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2018 at 09:02 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `crazybuzz`
--

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `main_ingredient` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `meal_type` enum('breakfast','lunch','dinner','appetizer','dessert','snack') NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `cuisine`, `main_ingredient`, `description`, `meal_type`, `price`) VALUES
(1, 'Cold Sesame Noodles', 'Chinese', 'Noodles', 'Peanut butter, sesame paste, and chile-garlic paste combine to make a silky, savory sauce for these noodles—a Chinese-American restaurant staple. Chopped peanuts and a flurry of slivered cucumber and carrot add crunch.', 'lunch', 25),
(2, 'Nigiri Sushi', 'Japanese', 'Rice', 'Sushi is the most famous Japanese dish outside of Japan, and one of the most popular dishes among the Japanese themselves. In Japan, sushi is usually enjoyed on special occasions, such as a celebration.\r\nDuring the Edo period, \"sushi\" refered to pickled fish preserved in vinegar. Nowadays sushi can be defined as a dish containing rice which has been prepared with sushi vinegar. There are many different types of sushi. Small rice balls with fish, shellfish, etc. on top. There are countless varieties of nigirizushi, some of the most common ones being tuna, shrimp, eel, squid, octopus and fried egg.', 'lunch', 100),
(3, 'Miso Chicken Wingettes', 'Japanese', 'Chicken', 'Miso glazed chicken wingettes are seasoned with a sweet Japanese miso(fermented soy bean paste) and baked in the oven until juicy and delicious. Chicken wings are a popular dish inJapanese cuisine, known as \"tebasaki\", but they are often served whole, and not cut up into smaller wingettes as they are in this recipe. \r\nThis recipe is fairly quick and easy as the ingredients for the sauce are simply mixed and then tossed with the wingettes. There are several options below to help tailor the recipe to perfectly suit your tastes. Enjoy!', 'breakfast', 30),
(4, 'Cambodian Hot & Sour Beef & Water Spinach Soup', 'Cambodian', 'Steak, Tripe, Spinach', 'Called samlor machu kreoung, this hot and sour meat and vegetable soup begins with a spice paste that Cambodians call kreoung. Prepared and used in much the same way as theMalaysian and Indonesiansambal, kreoung is made up of various herbs and spices that are ground in a mortar and pestle until the mixture turns into a paste.\r\nIf that\'s not enough to illustrate the nature of kreoung in Cambodian cooking, think ofcurry and how it forms the base of many South Asian dishes (although curry is a Western word that isn\'t found in the South Asian vocabulary). Just like curry, kreoung can be red, yellow or green depending on the combination of herbs and spices.\r\nBut, unlike curry, kreoung has two important classifications: individual and Royal. Royalkreoung is a pretty much standard formula; to the individual kreoung, an extra ingredient or two is added to give it a unique flavour that is required for a specific dish.\r\n', 'dinner', 80),
(5, 'Crispy Asparagus Rolls With Shrimp & Pork', 'Asian', 'Shrimp, Pork, Asparagus stalks', 'Here\'s another fun way to use the easy and versatile Asian Shrimp & Pork Filling. These crispy delights are a snap to make and are great as a party appetizer or a first course.\r\nYou can use any round dumpling wrapper, but I prefer the thin, golden \'Hong Kong-style\' that are often available in the frozen foods section of Asian markets.\r\nNote: Remember to watch these carefully, as they cook very quickly.', 'appetizer', 20),
(6, 'Larb Beef Salad', 'Vancouver', 'Cardamom, Steak, chili', 'Chef Angus An of Maenam restaurant in Vancouver, B.C. is known for his beautifully plated, authentic Thai food with a contemporary twist that perfectly balances the hot, sweet, salty and sour flavors of this cuisine.\r\nFrom East Meets West: Traditional and Contemporary Asian Dishes from Acclaimed Vancouver Restaurants © 2012 by Stephanie Yuen. Reprinted with permission of Douglas & McIntyre, an imprint of D&M Publishers.', 'dinner', 120),
(7, 'Carrot, Red Pepper & Tofu Macaroni And Cheese', 'Japanese', 'Noodles, Cheese, Tofu, Carrot', 'A few extras -  silken tofu, grated carrots and roasted red pepper - turn traditional macaroni and cheese into a whole new dish. Baking vegetables into a meal that resembles mac and cheese is a great way to introduce extra veggies to your kids. Even better, the flavour is complex enough that adults will love this carrot, red pepper and tofu baked pasta as well.', 'dessert', 60.99),
(8, 'Vegan Chinese Scallion Pancakes', 'Taiwanese', 'Flour', 'If you were luky enough to visit Taiwan recently and tasted these amazing scallion (green onion) pancakes which are served up hot and fresh in stacks from street vendors. Yum! These green onion pancakes are more than just a breakfast food, so enjoy them anytime. Serve plain or dipped in a good quality soy sauce. This recipe for Chinese Scallion (Green Onion) Pancakes is both vegetarian and vegan.', 'breakfast', 50),
(9, 'Chinese Pan-Fried Dumplings', 'Chinese', 'Pork', 'Also called potstickers, Chinese pan-fried dumplings are fried and then steamed in water. This two-stage cooking process gives the dumplings a crispy bottom, soft top, and juicy filling.\r\n\r\nNutritious bok choy and Napa cabbage add colour, texture and flavour to this easy to make pan-fried dumpling recipe. Yields about 48 dumplings.', 'appetizer', 44),
(10, 'Baked Chicken Wonton', 'Chinese', 'Chicken', 'This easy Chicken Wonton recipe follows a reader’s suggestion to reduce the fat and calories by baking instead of deep-frying the filled wontons. I’ve also used reduced fat peanut butter and a sugar substitute. Each wonton has about 55 to 60 calories. Makes about 16 wonton.', 'snack', 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
