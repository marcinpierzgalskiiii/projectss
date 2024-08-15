<?php
//4.1. Krok 3.1

            $create[] = "CREATE TABLE `tbl_admin` (
              `id` int(10) UNSIGNED NOT NULL,
              `full_name` varchar(100) NOT NULL,
              `username` varchar(100) NOT NULL,
              `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";



            $create[] = "CREATE TABLE `tbl_category` (
              `id` int(10) UNSIGNED NOT NULL,
              `title` varchar(100) NOT NULL,
              `image_name` varchar(255) DEFAULT NULL,
              `featured` varchar(10) NOT NULL,
              `active` varchar(10) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";


            $create[] = "CREATE TABLE `tbl_food` (
              `id` int(10) UNSIGNED NOT NULL,
              `title` varchar(100) NOT NULL,
              `description` text NOT NULL,
              `price` decimal(10,2) NOT NULL,
              `image_name` varchar(255) DEFAULT NULL,
              `category_id` int(10) UNSIGNED NOT NULL,
              `featured` varchar(10) NOT NULL,
              `active` varchar(10) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";


            $create[] ="CREATE TABLE `tbl_order` (
              `id` int(10) UNSIGNED NOT NULL,
              `food` varchar(150) NOT NULL,
              `price` decimal(10,2) NOT NULL,
              `quantity` int(11) NOT NULL,
              `total` decimal(10,2) NOT NULL,
              `order_date` datetime NOT NULL,
              `status` varchar(70) NOT NULL,
              `customer_name` varchar(100) NOT NULL,
              `customer_contact` varchar(20) NOT NULL,
              `customer_email` varchar(100) NOT NULL,
              `customer_addres` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

            $create[] ="CREATE TABLE `tbl_user` (
              `id` int(10) UNSIGNED NOT NULL,
              `email` varchar(255) NOT NULL,
              `username` varchar(100) NOT NULL,
              `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";


            $create[] .="ALTER TABLE `tbl_admin` ADD PRIMARY KEY (`id`);";


            $create[] .="ALTER TABLE `tbl_category` ADD PRIMARY KEY (`id`);";

            $create[] .="ALTER TABLE `tbl_food` ADD PRIMARY KEY (`id`);";


            $create[] .="ALTER TABLE `tbl_order` ADD PRIMARY KEY (`id`);";
            $create[] .="ALTER TABLE `tbl_user` ADD PRIMARY KEY (`id`);";


            $create[] .="ALTER TABLE `tbl_admin` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;";


            $create[] .="ALTER TABLE `tbl_category` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;";


            $create[] .="ALTER TABLE `tbl_food` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;";


            $create[] .= "ALTER TABLE `tbl_order` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;";

            $create[] .= "ALTER TABLE `tbl_user` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4; COMMIT;";

            
            ?>
            
            