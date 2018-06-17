-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2018 at 09:03 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `moonlight`
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
(1, 'Fried Bhajias', 'Indian', 'Spinach, Flour', 'Also known as Pakoras or Bhajjis, these are the perfect snack for a cold, rainy day! Make up a batch and serve them with sweet-sour Tamarind Chutney. Use any vegetable you like.', 'snack', 33),
(2, 'Couscous', 'Israeli', 'Mushroom', 'Israeli Couscous is a delightfully soft, satisfying, healthy pasta grain that is a delicious substitute to your average pasta and rice. Some cooks boil it and then strain it like pasta, others simmer it in water as one would pasta or small couscous, but after trying all of these, this is the best way I\'ve found to enjoy it! The act of lightly toasting the couscous first adds flavor and keeps the texture from being mushy.\r\nFeel free to substitute the mushrooms with another vegetable of your choice--sauteed orsteamed broccoli or spinach have been wonderful additions to my family\'s Israeli couscous dishes, as has the occasional sprinkle of nutritional yeast. Add tofu--seared, steamed, baked or fried--to keep this meal vegan, or add grilled fish or another healthy protein to add a little bit of heartiness.\r\n', 'breakfast', 80),
(3, 'Chicken Kabsa With Sausage', 'Arabian', 'Sausage, Rice', 'Sauté Sausage balls in a large pot until golden, remove and set aside.\r\nFry Chicken pieces in the same pot with the rendered oil and juices released from the sausages.\r\nAdd Onions, Tomato Paste and Tomatoes, to the pot and sauté till onions are soft.\r\nAdd Spices, Water and MAGGI Chicken Stock to the pot and simmer content for 45 min or until chicken is cooked.\r\nRemove chicken pieces and set aside and reserve stock.\r\nIn a separate rice pot, heat Vegetable Oil, and fry Potatoes, for about 5 min, add Bell Peppers, Rice, cooked chicken, cooked sausages, and top with 1500 of stock (Add more water if needed to cover the top of rice with 2cm liquid) and bring to boil.\r\nAdd kidney beans to the pot, cover and simmer on medium heat until potatoes are fork tender and rice is done, about 25 min.', 'dinner', 179.99),
(4, 'Shrimp Biryani', 'Indian', 'Shrimp, Rice', 'Wash and Soak rice in cold water and set aside for 30 min.\r\nIn a large pot, heat vegetable oil, fry sliced onions till golden brown, remove and set aside.\r\nIn the same pot on medium high heat fry chopped onions till golden, add shrimp and sauté till pink (about 4-5 minutes), add tomato paste, Garlic, Dill, Spices, Cinnamon sticks, Cardamom pods, MAGGI Chicken stock, and Water and bring to a simmer. Add chopped fresh coriander leaves and remove from pot and set aside.\r\nIn the same pot, bring to boil 1.5 liters of water, place rice and cook until rice is ¾ cooked (andante).\r\nDrain rice in a colander and discard excess water.\r\nMelt Ghee on the bottom of the same pot; add a layer of strained rice, followed by a layer of shrimp and onion mixture and a sprinkle of Saffron powder. Follow this step until all the rice and shrimp sauce is used.\r\nSteam rice and shrimp on med-low heat until rice is fully cooked (about 20 minute).\r\nGently fluff cooked rice ensuring even distribution of rice and shrimp.\r\nServe on a large plate, and garnished with fried sliced onions.', 'lunch', 97.5),
(5, 'Low Fat Mohallabiah', 'Arabian', 'Rice powder', 'In a casserole, bring to boil NESTLÉ Fat Free Sweetened Condensed Milk with 4 cups of water. In another bowl, dissolve the remaining water with the rice powder and vanilla powder.\r\nSlowly pour the rice mixture over the hot milk constantly stirring and cook on low heat for 5 minutes or until the mixture thickens. Add the rose and blossom water and mix well.\r\nPour the mixture into small bowls, and garnish with the grated pistachio.', 'breakfast', 67),
(6, 'Kunafeh', 'Egyptian', 'Cheese, Pasta, Flour', 'Sweet, rich, crunchy and creamy, Kunafeh or Knafeh can be found in regions that used to be occupied by the Ottoman Empire. This sweet pastry is the Middle Eastern version of the cheese cake.\r\nKunafeh is made of semolina dough and thin noodle-like phyllo pastry. It is stuffed with a white soft cheese such as Nabulsi cheese. Kunafeh is crunchy on the outside and is soaked in simple sweet syrup. Recently, the Middle East has seen variations of this dish with the addition of Mangoes.\r\n', 'dessert', 33),
(7, 'Aish El-Saraya', 'Lebanese', 'Bread', 'Literally the bread of the royal palace, Aish El-Saraya is a delectable dessert eaten in special occasions. The origin of this dish is unknown, yet some have attributed this dish to the Lebanese cuisine.\r\nIt is sweetened bread and often drizzled with very sweet syrup and covered with cream on top. Sometimes, Aish El-Saraya is garnished with nuts.', 'dessert', 25),
(8, 'Falafel', 'Israeli', 'ChickPea', 'Every Israeli has an opinion about falafel, the ultimate Israeli street food, which is most often served stuffed into pita bread. One of my favorite spots is a simple stand in the Bukharan Quarter of Jerusalem, adjacent to Mea Shearim. The neighborhood was established in 1891, when wealthy Jews from Bukharan engaged engineers and city planners to plan a quarter with straight, wide streets and lavish stone houses. After the Russian Revolution, with the passing of time and fortunes, the Bukharan Quarter lost much of its wealth, but even so the area retains a certain elegance. There, the falafel is freshly fried before your eyes and the balls are very large and light. Shlomo Zadok, the elderly falafel maker and falafel stand owner, brought the recipe with him from his native Yemen.\r\nZadok explained that at the time of the establishment of the state, falafel — the name of which probably comes from the word pilpel (pepper) — was made in two ways: either as it is in Egypt today, from crushed, soaked fava beans or fava beans combined with chickpeas, spices, and bulgur; or, as Yemenite Jews and the Arabs of Jerusalem did, from chickpeas alone. But favism, an inherited enzymatic deficiency occurring among some Jews — mainly those of Kurdish and Iraqi ancestry, many of whom came to Israel during the mid 1900s — proved potentially lethal, so all falafel makers in Israel ultimately sopped using fava beans, and chickpea falafel became an Israeli dish.\r\n', 'lunch', 45);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
