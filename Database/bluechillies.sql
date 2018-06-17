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
-- Database: `bluechillies`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `cuisine`, `main_ingredient`, `description`, `meal_type`, `price`) VALUES
(1, 'Duck Pâté En Croûte', 'French', 'Duck', 'Pâté is a labor of love, but it\'s worth every step, especially when you bake it in flaky homemade pastry dough and top it with a flavourful gelée. Here, being careful to keep the ingredients cold during the process, and taking the same care when folding and filling the dough, yields a pâté that everyone will write home about.\r\nNote: This is a time-intensive recipe that may exceed 24 hours, but a lot of that time is from chilling the farce overnight. Take care with your prep time and you can shorten the work to a day; just be sure that everything is properly chilled throughout the process.\r\n', 'appetizer', 15),
(2, 'Brisket Burger', 'French', 'Beef', 'The all-brisket patty for this burger—from San Francisco\'s Wes Rowe, a pop-up burger slinger—is grilled, but in a cast-iron pan over the flame. This not only minimises flare-ups (which result in a bitter flavour), but also allows the burger to cook over a bed of onions that would otherwise burn. The onions simultaneously season the meat and soak up the juices of the brisket, and by charring the other toppings and bun over an open flame, you\'ll get the quintessentially smoky touch you expect from a burger.', 'lunch', 58),
(3, 'Marinated Tomatoes With Mint', 'French', 'Tomatoes', 'Tomatoes picked off the vine in the last days of summer often need nothing more than a sprinkle of salt. For a slightly—just slightly—more elaborate dish that showcases the sweet juices of summer tomatoes, chef Chris Fischer dresses them with olive oil and vinegar, creating a vinaigrette seemingly out of nothing. The vinegar helps sweat out the tomato juice, which is then thickened by the oil. Use any colour of heirloom or beefsteak tomatoes you like to create a beautiful presentation. To get a behind-the-scenes look at the recipe, get the story here.', 'dinner', 150),
(4, 'Slow-Smoked and Spice-Brined Turkey', 'French', 'Turkey', 'Inspired by the flavors of Peking duck, Cara Stadler of Tao Yuan in Brunswick , Maine, infuses a turkey with a spiced brine of Sichuan peppercorns, fennel seeds, and fresh ginger and then lightly smokes it with oak wood chips. The delicate smokiness balances the spices, and the low cooking temperature keeps the bird exceptionally moist. If you don\'t have wood chips, omit the smoking part of the recipe; the turkey will still taste delicious without it.', 'dinner', 99),
(5, 'Vegan Peanut Butter And Chocolate Chip Ice Cream', 'French', 'Cashew', 'This vegan ice cream from Brooklyn\'s Van Leeuwen Artisan Ice Cream takes a classic flavor combination, peanut butter and chocolate, and uses cashew milk to make for an extra rich ice cream. This recipe first appeared in Van Leeuwen Artisan Ice Cream(HarperCollins, 2015).\nFeatured in: Vegan Ice Cream with Van Leeuwen', 'breakfast', 30),
(6, 'Cinnamon-Honey Scotch Sour Cocktail', 'French', 'Cinnamon, Scotch, Honey', 'Cinnamon and honey are always friends, and a cinnamon-honey syrup has endless uses—sweeten your tea with it, pour it over ice cream, or drizzle on your oatmeal. In a cocktail context? Try it in a Scotch sour, where smoky blended Scotch and lemon make for a refreshing drink with the warmth of cinnamon and slight floral note of honey coming through. Once you’ve made the cinnamon honey, it’s just a three-ingredient drink, but tastes far more complex.', 'dessert', 40),
(7, 'French-Canadian Trifle', 'French', 'Cake', '(Bagatelle) The typical bagatelle in La Beauce is a child\'s delight of Jell-O, white cake, and strawberry jam. We prefer this grown-up version, with fresh fruit, custard (instead of Jell-O), and a drizzle of marsala.', 'dessert', 20),
(8, 'French Fries and Onion Rings', 'French', 'Sweet Potato', 'French fries and onion rings are classic, beloved sides. However, they tend to remain relegated to restaurants. Frying food can be intimidating to many home cooks, who worry about making a mess or needing to buy specialised equipment. The truth is that with a little practice, making perfect french fries and onion rings is easy to do at home with tools you probably already own. If you\'re ready to give it a shot, we\'ve rounded up our favourite French fry and onion ring recipes.\r\nThe key to making French fries is the double fry technique. By first cooking the fries at a low temperature you cook them through and prime the exterior for crisping. It\'s the second, high-temperature fry that gives the spuds a beautiful, crackly crust. This technique is used in our bistro French fries, which are cooked in duck to give them a deep, meaty flavour, and our herbed fries topped with sage, rosemary, and parmesan.\r\nOnce you\'ve mastered the potato French fry, you can try the sweet potato fry. They can be fried just like the traditional, but if you\'re still apprehensive about frying you can try our sweet potato oven fries, which are baked and served with a creamy curry-honey dipping sauce.\r\nOnion rings—tender onion fried with a crispy batter—give French fries a run for their money. Using beer in the batter can make it extra airy, as in our flour-and-lager battered onion rings flavoured with honey, paprika, and dry mustard.\r\nFind all of these dishes in our collection of crispy french fry and onion ring recipes.\r\n', 'lunch', 87),
(9, 'Classic Eggs Benedict', 'French', 'Egg, Bacon, Muffins', 'The secret to success with this dish is the quality of its parts. Adding a generous amount of vinegar to the poaching liquid—a restaurant trick—helps the eggs form into perfect spheres, and making the hollandaise in a blender whips the sauce into a smooth, emulsified state, so it isn\'t as likely to separate as the version made by hand with a whisk.', 'breakfast', 28),
(10, 'Stuffed Pepperoncini with Smoked Salmon', 'French', 'Pepperoncini, Salmon', 'Spicy, briny, creamy, and salty, this simple, retro-inspired appetizer is an unabashed crowd-pleaser. The peppers can be stuffed ahead of time, but be sure to wrap them in smoked salmon just before serving.', 'appetizer', 30);

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
