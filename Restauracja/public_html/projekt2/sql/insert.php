<?php
        $insert[] ="INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
        (10, 'aa', 'aa1', 'c4ca4238a0b923820dcc509a6f75849b '),
        (11, 'Marcin', 'marc2', '97e1e59c0375e0f55c10d4314db20466');";



        $insert[] ="INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
        (23, 'Salad', 'Food-name-2978.jpg', 'YES', 'YES'),
        (24, 'Tortilla', 'Food-name-3179.jpg', 'YES', 'YES'),
        (25, 'Pizza', 'Food-name-3276.jpg', 'YES', 'YES'),
        (26, 'Barbecue', 'Food-name-2381.jpg', 'YES', 'YES'),
        (27, 'Burger', 'Food-name-441.jpg', 'NO', 'YES'),
        (28, 'Cake', '', 'NO', 'NO'),
        (29, 'Burger-onion', 'Food-name-6436.jpg', 'NO', 'NO');";


        $insert[] ="INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
        (13, 'Salad', ' Made  withe tomatos, eggs, peas, corn, cucumber, chicken.', '7.00', 'Food-name-7119.jpg', 23, 'YES', 'YES'),
        (14, 'Tortilla', ' Made  withe tomatos, cucumber, chicken, lettuce, lime.', '10.00', 'Food-name-5532.jpg', 24, 'YES', 'YES'),
        (15, 'Pizza', ' Made  withe  cheese, onion, chicken, tomato sauce.', '18.00', 'Food-name-6627.jpg', 25, 'YES', 'YES'),
        (16, 'Barbecue', 'Made withe grilled meat, fish, vegetables', '15.00', 'Food-name-1606.jpg', 23, 'YES', 'YES'),
        (17, 'Burger', ' Made  withe crunchy bread, spicy and crispy chicken.', '12.00', 'Food-name-4891.jpg', 27, 'YES', 'YES'),
        (18, 'Burger-onion', 'Made withe crispy chicken and onion ', '13.00', 'Food-name-6920.jpg', 23, 'NO', 'YES'),
        (19, 'Salad', 'Made withe tomatos, eggs, peas, corn, cucumber, chicken.', '8.00', 'Food-name-1571.jpg', 23, 'NO', 'NO');";


        $insert[] ="INSERT INTO `tbl_order` (`id`, `food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_addres`) VALUES
        (1, 'Pizza', '18.00', 3, '54.00', '2022-06-27 11:58:12', 'delivered', 'Johnnie Walker', '500600900', 'john@walk.com', 'Piotrkowska, Łódź, Polska'),
        (2, 'Pizza', '18.00', 2, '36.00', '2022-06-27 12:01:50', 'order', 'Johnnie Walker', '500600900', 'john@walk.com', 'Piotrkowska, Łódź, Polska'),
        (3, 'Salad', '7.00', 2, '14.00', '2022-06-27 12:06:08', 'order', 'Johnnie Walker', '123123123', 'john@walk.com', 'Piotrkowska, Łódź, Polska'),
        (4, 'Salad', '7.00', 2, '14.00', '2022-06-27 12:09:25', 'order', 'Marcin ', '123123123', 'jaaa@s.com', 'assas,aas,sasa'),
        (12, 'Tortilla', '10.00', 3, '30.00', '2022-06-28 19:28:57', 'delivered', 'Marcin', '123098890', 'marcin@pi.com', 'POW, Łódź, Polska');";


        $insert[] ="INSERT INTO `tbl_user` (`id`, `email`, `username`, `password`) VALUES
        (1, 'marcin@pi.com', 'marcin', 'd5fad0cda8f1079681ec510bb20a586c'),
        (3, 'john@walker.com', 'john', '527bd5b5d689e2c32ae974c6229ff785');";


           

                

           
                            
                 
    ?>
