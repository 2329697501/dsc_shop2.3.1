ALTER TABLE `{pre}seller_shopinfo` ADD COLUMN `lng` varchar(100) NOT NULL AFTER `shipping_date`, ADD COLUMN `lat` varchar(100) NOT NULL AFTER `lng`;