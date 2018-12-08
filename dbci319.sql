/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 100136
Source Host           : localhost:3306
Source Database       : dbci319

Target Server Type    : MYSQL
Target Server Version : 100136
File Encoding         : 65001

Date: 2018-12-09 04:25:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for authors
-- ----------------------------
DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_firstname` varchar(50) NOT NULL,
  `author_lastname` varchar(50) NOT NULL,
  `author_othernames` varchar(50) NOT NULL,
  `author_birthdate` date NOT NULL,
  `author_history` text NOT NULL,
  `author_image` text NOT NULL,
  `author_isactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of authors
-- ----------------------------
INSERT INTO `authors` VALUES ('1', 'John', 'Otaalo', 'Chrispine', '1990-03-24', 'Something about the author that does not have to do a lot there with', 'https://yt3.ggpht.com/-iLEaGGRXaY8/AAAAAAAAAAI/AAAAAAAAAAA/Ycv1cGgDaGk/s900-c-k-no/photo.jpg', '1');
INSERT INTO `authors` VALUES ('2', 'Alexis', 'Sanchez', 'Gulliermo', '1989-02-05', 'He is a very prolific writer and footballer', 'http://i1.mirror.co.uk/incoming/article3841911.ece/ALTERNATES/s615/PAY-Alexis-Sanchez.jpg', '1');

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_isbn` varchar(15) NOT NULL,
  `book_title` varchar(50) NOT NULL,
  `book_yop` date NOT NULL,
  `book_dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `book_active` int(11) NOT NULL DEFAULT '1',
  `book_genreid` int(11) NOT NULL,
  `book_publisherid` int(11) NOT NULL,
  PRIMARY KEY (`book_id`),
  KEY `Books_idx_1` (`book_genreid`,`book_publisherid`),
  KEY `Books_Publishers` (`book_publisherid`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES ('32', 's', 'a', '0000-00-00', '2018-04-11 11:43:54', '1', '1', '1');
INSERT INTO `books` VALUES ('33', 'a', 'asda', '0000-00-00', '2018-04-11 12:27:15', '1', '1', '1');

-- ----------------------------
-- Table structure for book_author
-- ----------------------------
DROP TABLE IF EXISTS `book_author`;
CREATE TABLE `book_author` (
  `Book_Author_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BookId` int(11) NOT NULL,
  `AuthorId` int(11) NOT NULL,
  `Books_book_id` int(11) NOT NULL,
  PRIMARY KEY (`Book_Author_ID`),
  KEY `Book_Author_Authors` (`AuthorId`),
  KEY `Book_Author_Books` (`BookId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of book_author
-- ----------------------------
INSERT INTO `book_author` VALUES ('15', '33', '1', '0');
INSERT INTO `book_author` VALUES ('16', '33', '2', '0');

-- ----------------------------
-- Table structure for book_genre
-- ----------------------------
DROP TABLE IF EXISTS `book_genre`;
CREATE TABLE `book_genre` (
  `book_genreid` int(11) NOT NULL AUTO_INCREMENT,
  `book_genre` varchar(20) NOT NULL,
  `book_genreactive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`book_genreid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of book_genre
-- ----------------------------
INSERT INTO `book_genre` VALUES ('1', 'Fiction', '1');
INSERT INTO `book_genre` VALUES ('2', 'Horror', '1');
INSERT INTO `book_genre` VALUES ('3', 'Fairy Tales', '1');

-- ----------------------------
-- Table structure for book_images
-- ----------------------------
DROP TABLE IF EXISTS `book_images`;
CREATE TABLE `book_images` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `imagePath` text NOT NULL,
  `imageIsTitle` int(11) NOT NULL DEFAULT '0',
  `imageActive` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`imageID`),
  KEY `Book_Images_Books` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of book_images
-- ----------------------------
INSERT INTO `book_images` VALUES ('1', '32', 'http://localhost/hmvcci318/upload/books/Archery Quiver Bag.jpg', '0', '1');
INSERT INTO `book_images` VALUES ('2', '32', 'http://localhost/hmvcci318/upload/books/Bukti Transfer Graji Mesin.png', '0', '1');
INSERT INTO `book_images` VALUES ('3', '33', 'http://localhost/hmvcci318/upload/books/game console.JPG', '0', '1');

-- ----------------------------
-- Table structure for countries
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO `countries` VALUES ('1', 'AF', 'Afghanistan');
INSERT INTO `countries` VALUES ('2', 'AL', 'Albania');
INSERT INTO `countries` VALUES ('3', 'DZ', 'Algeria');
INSERT INTO `countries` VALUES ('4', 'DS', 'American Samoa');
INSERT INTO `countries` VALUES ('5', 'AD', 'Andorra');
INSERT INTO `countries` VALUES ('6', 'AO', 'Angola');
INSERT INTO `countries` VALUES ('7', 'AI', 'Anguilla');
INSERT INTO `countries` VALUES ('8', 'AQ', 'Antarctica');
INSERT INTO `countries` VALUES ('9', 'AG', 'Antigua and Barbuda');
INSERT INTO `countries` VALUES ('10', 'AR', 'Argentina');
INSERT INTO `countries` VALUES ('11', 'AM', 'Armenia');
INSERT INTO `countries` VALUES ('12', 'AW', 'Aruba');
INSERT INTO `countries` VALUES ('13', 'AU', 'Australia');
INSERT INTO `countries` VALUES ('14', 'AT', 'Austria');
INSERT INTO `countries` VALUES ('15', 'AZ', 'Azerbaijan');
INSERT INTO `countries` VALUES ('16', 'BS', 'Bahamas');
INSERT INTO `countries` VALUES ('17', 'BH', 'Bahrain');
INSERT INTO `countries` VALUES ('18', 'BD', 'Bangladesh');
INSERT INTO `countries` VALUES ('19', 'BB', 'Barbados');
INSERT INTO `countries` VALUES ('20', 'BY', 'Belarus');
INSERT INTO `countries` VALUES ('21', 'BE', 'Belgium');
INSERT INTO `countries` VALUES ('22', 'BZ', 'Belize');
INSERT INTO `countries` VALUES ('23', 'BJ', 'Benin');
INSERT INTO `countries` VALUES ('24', 'BM', 'Bermuda');
INSERT INTO `countries` VALUES ('25', 'BT', 'Bhutan');
INSERT INTO `countries` VALUES ('26', 'BO', 'Bolivia');
INSERT INTO `countries` VALUES ('27', 'BA', 'Bosnia and Herzegovina');
INSERT INTO `countries` VALUES ('28', 'BW', 'Botswana');
INSERT INTO `countries` VALUES ('29', 'BV', 'Bouvet Island');
INSERT INTO `countries` VALUES ('30', 'BR', 'Brazil');
INSERT INTO `countries` VALUES ('31', 'IO', 'British Indian Ocean Territory');
INSERT INTO `countries` VALUES ('32', 'BN', 'Brunei Darussalam');
INSERT INTO `countries` VALUES ('33', 'BG', 'Bulgaria');
INSERT INTO `countries` VALUES ('34', 'BF', 'Burkina Faso');
INSERT INTO `countries` VALUES ('35', 'BI', 'Burundi');
INSERT INTO `countries` VALUES ('36', 'KH', 'Cambodia');
INSERT INTO `countries` VALUES ('37', 'CM', 'Cameroon');
INSERT INTO `countries` VALUES ('38', 'CA', 'Canada');
INSERT INTO `countries` VALUES ('39', 'CV', 'Cape Verde');
INSERT INTO `countries` VALUES ('40', 'KY', 'Cayman Islands');
INSERT INTO `countries` VALUES ('41', 'CF', 'Central African Republic');
INSERT INTO `countries` VALUES ('42', 'TD', 'Chad');
INSERT INTO `countries` VALUES ('43', 'CL', 'Chile');
INSERT INTO `countries` VALUES ('44', 'CN', 'China');
INSERT INTO `countries` VALUES ('45', 'CX', 'Christmas Island');
INSERT INTO `countries` VALUES ('46', 'CC', 'Cocos (Keeling) Islands');
INSERT INTO `countries` VALUES ('47', 'CO', 'Colombia');
INSERT INTO `countries` VALUES ('48', 'KM', 'Comoros');
INSERT INTO `countries` VALUES ('49', 'CG', 'Congo');
INSERT INTO `countries` VALUES ('50', 'CK', 'Cook Islands');
INSERT INTO `countries` VALUES ('51', 'CR', 'Costa Rica');
INSERT INTO `countries` VALUES ('52', 'HR', 'Croatia (Hrvatska)');
INSERT INTO `countries` VALUES ('53', 'CU', 'Cuba');
INSERT INTO `countries` VALUES ('54', 'CY', 'Cyprus');
INSERT INTO `countries` VALUES ('55', 'CZ', 'Czech Republic');
INSERT INTO `countries` VALUES ('56', 'DK', 'Denmark');
INSERT INTO `countries` VALUES ('57', 'DJ', 'Djibouti');
INSERT INTO `countries` VALUES ('58', 'DM', 'Dominica');
INSERT INTO `countries` VALUES ('59', 'DO', 'Dominican Republic');
INSERT INTO `countries` VALUES ('60', 'TP', 'East Timor');
INSERT INTO `countries` VALUES ('61', 'EC', 'Ecuador');
INSERT INTO `countries` VALUES ('62', 'EG', 'Egypt');
INSERT INTO `countries` VALUES ('63', 'SV', 'El Salvador');
INSERT INTO `countries` VALUES ('64', 'GQ', 'Equatorial Guinea');
INSERT INTO `countries` VALUES ('65', 'ER', 'Eritrea');
INSERT INTO `countries` VALUES ('66', 'EE', 'Estonia');
INSERT INTO `countries` VALUES ('67', 'ET', 'Ethiopia');
INSERT INTO `countries` VALUES ('68', 'FK', 'Falkland Islands (Malvinas)');
INSERT INTO `countries` VALUES ('69', 'FO', 'Faroe Islands');
INSERT INTO `countries` VALUES ('70', 'FJ', 'Fiji');
INSERT INTO `countries` VALUES ('71', 'FI', 'Finland');
INSERT INTO `countries` VALUES ('72', 'FR', 'France');
INSERT INTO `countries` VALUES ('73', 'FX', 'France, Metropolitan');
INSERT INTO `countries` VALUES ('74', 'GF', 'French Guiana');
INSERT INTO `countries` VALUES ('75', 'PF', 'French Polynesia');
INSERT INTO `countries` VALUES ('76', 'TF', 'French Southern Territories');
INSERT INTO `countries` VALUES ('77', 'GA', 'Gabon');
INSERT INTO `countries` VALUES ('78', 'GM', 'Gambia');
INSERT INTO `countries` VALUES ('79', 'GE', 'Georgia');
INSERT INTO `countries` VALUES ('80', 'DE', 'Germany');
INSERT INTO `countries` VALUES ('81', 'GH', 'Ghana');
INSERT INTO `countries` VALUES ('82', 'GI', 'Gibraltar');
INSERT INTO `countries` VALUES ('83', 'GK', 'Guernsey');
INSERT INTO `countries` VALUES ('84', 'GR', 'Greece');
INSERT INTO `countries` VALUES ('85', 'GL', 'Greenland');
INSERT INTO `countries` VALUES ('86', 'GD', 'Grenada');
INSERT INTO `countries` VALUES ('87', 'GP', 'Guadeloupe');
INSERT INTO `countries` VALUES ('88', 'GU', 'Guam');
INSERT INTO `countries` VALUES ('89', 'GT', 'Guatemala');
INSERT INTO `countries` VALUES ('90', 'GN', 'Guinea');
INSERT INTO `countries` VALUES ('91', 'GW', 'Guinea-Bissau');
INSERT INTO `countries` VALUES ('92', 'GY', 'Guyana');
INSERT INTO `countries` VALUES ('93', 'HT', 'Haiti');
INSERT INTO `countries` VALUES ('94', 'HM', 'Heard and Mc Donald Islands');
INSERT INTO `countries` VALUES ('95', 'HN', 'Honduras');
INSERT INTO `countries` VALUES ('96', 'HK', 'Hong Kong');
INSERT INTO `countries` VALUES ('97', 'HU', 'Hungary');
INSERT INTO `countries` VALUES ('98', 'IS', 'Iceland');
INSERT INTO `countries` VALUES ('99', 'IN', 'India');
INSERT INTO `countries` VALUES ('100', 'IM', 'Isle of Man');
INSERT INTO `countries` VALUES ('101', 'ID', 'Indonesia');
INSERT INTO `countries` VALUES ('102', 'IR', 'Iran (Islamic Republic of)');
INSERT INTO `countries` VALUES ('103', 'IQ', 'Iraq');
INSERT INTO `countries` VALUES ('104', 'IE', 'Ireland');
INSERT INTO `countries` VALUES ('105', 'IL', 'Israel');
INSERT INTO `countries` VALUES ('106', 'IT', 'Italy');
INSERT INTO `countries` VALUES ('107', 'CI', 'Ivory Coast');
INSERT INTO `countries` VALUES ('108', 'JE', 'Jersey');
INSERT INTO `countries` VALUES ('109', 'JM', 'Jamaica');
INSERT INTO `countries` VALUES ('110', 'JP', 'Japan');
INSERT INTO `countries` VALUES ('111', 'JO', 'Jordan');
INSERT INTO `countries` VALUES ('112', 'KZ', 'Kazakhstan');
INSERT INTO `countries` VALUES ('113', 'KE', 'Kenya');
INSERT INTO `countries` VALUES ('114', 'KI', 'Kiribati');
INSERT INTO `countries` VALUES ('115', 'KP', 'Korea, Democratic People\'s Republic of');
INSERT INTO `countries` VALUES ('116', 'KR', 'Korea, Republic of');
INSERT INTO `countries` VALUES ('117', 'XK', 'Kosovo');
INSERT INTO `countries` VALUES ('118', 'KW', 'Kuwait');
INSERT INTO `countries` VALUES ('119', 'KG', 'Kyrgyzstan');
INSERT INTO `countries` VALUES ('120', 'LA', 'Lao People\'s Democratic Republic');
INSERT INTO `countries` VALUES ('121', 'LV', 'Latvia');
INSERT INTO `countries` VALUES ('122', 'LB', 'Lebanon');
INSERT INTO `countries` VALUES ('123', 'LS', 'Lesotho');
INSERT INTO `countries` VALUES ('124', 'LR', 'Liberia');
INSERT INTO `countries` VALUES ('125', 'LY', 'Libyan Arab Jamahiriya');
INSERT INTO `countries` VALUES ('126', 'LI', 'Liechtenstein');
INSERT INTO `countries` VALUES ('127', 'LT', 'Lithuania');
INSERT INTO `countries` VALUES ('128', 'LU', 'Luxembourg');
INSERT INTO `countries` VALUES ('129', 'MO', 'Macau');
INSERT INTO `countries` VALUES ('130', 'MK', 'Macedonia');
INSERT INTO `countries` VALUES ('131', 'MG', 'Madagascar');
INSERT INTO `countries` VALUES ('132', 'MW', 'Malawi');
INSERT INTO `countries` VALUES ('133', 'MY', 'Malaysia');
INSERT INTO `countries` VALUES ('134', 'MV', 'Maldives');
INSERT INTO `countries` VALUES ('135', 'ML', 'Mali');
INSERT INTO `countries` VALUES ('136', 'MT', 'Malta');
INSERT INTO `countries` VALUES ('137', 'MH', 'Marshall Islands');
INSERT INTO `countries` VALUES ('138', 'MQ', 'Martinique');
INSERT INTO `countries` VALUES ('139', 'MR', 'Mauritania');
INSERT INTO `countries` VALUES ('140', 'MU', 'Mauritius');
INSERT INTO `countries` VALUES ('141', 'TY', 'Mayotte');
INSERT INTO `countries` VALUES ('142', 'MX', 'Mexico');
INSERT INTO `countries` VALUES ('143', 'FM', 'Micronesia, Federated States of');
INSERT INTO `countries` VALUES ('144', 'MD', 'Moldova, Republic of');
INSERT INTO `countries` VALUES ('145', 'MC', 'Monaco');
INSERT INTO `countries` VALUES ('146', 'MN', 'Mongolia');
INSERT INTO `countries` VALUES ('147', 'ME', 'Montenegro');
INSERT INTO `countries` VALUES ('148', 'MS', 'Montserrat');
INSERT INTO `countries` VALUES ('149', 'MA', 'Morocco');
INSERT INTO `countries` VALUES ('150', 'MZ', 'Mozambique');
INSERT INTO `countries` VALUES ('151', 'MM', 'Myanmar');
INSERT INTO `countries` VALUES ('152', 'NA', 'Namibia');
INSERT INTO `countries` VALUES ('153', 'NR', 'Nauru');
INSERT INTO `countries` VALUES ('154', 'NP', 'Nepal');
INSERT INTO `countries` VALUES ('155', 'NL', 'Netherlands');
INSERT INTO `countries` VALUES ('156', 'AN', 'Netherlands Antilles');
INSERT INTO `countries` VALUES ('157', 'NC', 'New Caledonia');
INSERT INTO `countries` VALUES ('158', 'NZ', 'New Zealand');
INSERT INTO `countries` VALUES ('159', 'NI', 'Nicaragua');
INSERT INTO `countries` VALUES ('160', 'NE', 'Niger');
INSERT INTO `countries` VALUES ('161', 'NG', 'Nigeria');
INSERT INTO `countries` VALUES ('162', 'NU', 'Niue');
INSERT INTO `countries` VALUES ('163', 'NF', 'Norfolk Island');
INSERT INTO `countries` VALUES ('164', 'MP', 'Northern Mariana Islands');
INSERT INTO `countries` VALUES ('165', 'NO', 'Norway');
INSERT INTO `countries` VALUES ('166', 'OM', 'Oman');
INSERT INTO `countries` VALUES ('167', 'PK', 'Pakistan');
INSERT INTO `countries` VALUES ('168', 'PW', 'Palau');
INSERT INTO `countries` VALUES ('169', 'PS', 'Palestine');
INSERT INTO `countries` VALUES ('170', 'PA', 'Panama');
INSERT INTO `countries` VALUES ('171', 'PG', 'Papua New Guinea');
INSERT INTO `countries` VALUES ('172', 'PY', 'Paraguay');
INSERT INTO `countries` VALUES ('173', 'PE', 'Peru');
INSERT INTO `countries` VALUES ('174', 'PH', 'Philippines');
INSERT INTO `countries` VALUES ('175', 'PN', 'Pitcairn');
INSERT INTO `countries` VALUES ('176', 'PL', 'Poland');
INSERT INTO `countries` VALUES ('177', 'PT', 'Portugal');
INSERT INTO `countries` VALUES ('178', 'PR', 'Puerto Rico');
INSERT INTO `countries` VALUES ('179', 'QA', 'Qatar');
INSERT INTO `countries` VALUES ('180', 'RE', 'Reunion');
INSERT INTO `countries` VALUES ('181', 'RO', 'Romania');
INSERT INTO `countries` VALUES ('182', 'RU', 'Russian Federation');
INSERT INTO `countries` VALUES ('183', 'RW', 'Rwanda');
INSERT INTO `countries` VALUES ('184', 'KN', 'Saint Kitts and Nevis');
INSERT INTO `countries` VALUES ('185', 'LC', 'Saint Lucia');
INSERT INTO `countries` VALUES ('186', 'VC', 'Saint Vincent and the Grenadines');
INSERT INTO `countries` VALUES ('187', 'WS', 'Samoa');
INSERT INTO `countries` VALUES ('188', 'SM', 'San Marino');
INSERT INTO `countries` VALUES ('189', 'ST', 'Sao Tome and Principe');
INSERT INTO `countries` VALUES ('190', 'SA', 'Saudi Arabia');
INSERT INTO `countries` VALUES ('191', 'SN', 'Senegal');
INSERT INTO `countries` VALUES ('192', 'RS', 'Serbia');
INSERT INTO `countries` VALUES ('193', 'SC', 'Seychelles');
INSERT INTO `countries` VALUES ('194', 'SL', 'Sierra Leone');
INSERT INTO `countries` VALUES ('195', 'SG', 'Singapore');
INSERT INTO `countries` VALUES ('196', 'SK', 'Slovakia');
INSERT INTO `countries` VALUES ('197', 'SI', 'Slovenia');
INSERT INTO `countries` VALUES ('198', 'SB', 'Solomon Islands');
INSERT INTO `countries` VALUES ('199', 'SO', 'Somalia');
INSERT INTO `countries` VALUES ('200', 'ZA', 'South Africa');
INSERT INTO `countries` VALUES ('201', 'GS', 'South Georgia South Sandwich Islands');
INSERT INTO `countries` VALUES ('202', 'ES', 'Spain');
INSERT INTO `countries` VALUES ('203', 'LK', 'Sri Lanka');
INSERT INTO `countries` VALUES ('204', 'SH', 'St. Helena');
INSERT INTO `countries` VALUES ('205', 'PM', 'St. Pierre and Miquelon');
INSERT INTO `countries` VALUES ('206', 'SD', 'Sudan');
INSERT INTO `countries` VALUES ('207', 'SR', 'Suriname');
INSERT INTO `countries` VALUES ('208', 'SJ', 'Svalbard and Jan Mayen Islands');
INSERT INTO `countries` VALUES ('209', 'SZ', 'Swaziland');
INSERT INTO `countries` VALUES ('210', 'SE', 'Sweden');
INSERT INTO `countries` VALUES ('211', 'CH', 'Switzerland');
INSERT INTO `countries` VALUES ('212', 'SY', 'Syrian Arab Republic');
INSERT INTO `countries` VALUES ('213', 'TW', 'Taiwan');
INSERT INTO `countries` VALUES ('214', 'TJ', 'Tajikistan');
INSERT INTO `countries` VALUES ('215', 'TZ', 'Tanzania, United Republic of');
INSERT INTO `countries` VALUES ('216', 'TH', 'Thailand');
INSERT INTO `countries` VALUES ('217', 'TG', 'Togo');
INSERT INTO `countries` VALUES ('218', 'TK', 'Tokelau');
INSERT INTO `countries` VALUES ('219', 'TO', 'Tonga');
INSERT INTO `countries` VALUES ('220', 'TT', 'Trinidad and Tobago');
INSERT INTO `countries` VALUES ('221', 'TN', 'Tunisia');
INSERT INTO `countries` VALUES ('222', 'TR', 'Turkey');
INSERT INTO `countries` VALUES ('223', 'TM', 'Turkmenistan');
INSERT INTO `countries` VALUES ('224', 'TC', 'Turks and Caicos Islands');
INSERT INTO `countries` VALUES ('225', 'TV', 'Tuvalu');
INSERT INTO `countries` VALUES ('226', 'UG', 'Uganda');
INSERT INTO `countries` VALUES ('227', 'UA', 'Ukraine');
INSERT INTO `countries` VALUES ('228', 'AE', 'United Arab Emirates');
INSERT INTO `countries` VALUES ('229', 'GB', 'United Kingdom');
INSERT INTO `countries` VALUES ('230', 'US', 'United States');
INSERT INTO `countries` VALUES ('231', 'UM', 'United States minor outlying islands');
INSERT INTO `countries` VALUES ('232', 'UY', 'Uruguay');
INSERT INTO `countries` VALUES ('233', 'UZ', 'Uzbekistan');
INSERT INTO `countries` VALUES ('234', 'VU', 'Vanuatu');
INSERT INTO `countries` VALUES ('235', 'VA', 'Vatican City State');
INSERT INTO `countries` VALUES ('236', 'VE', 'Venezuela');
INSERT INTO `countries` VALUES ('237', 'VN', 'Vietnam');
INSERT INTO `countries` VALUES ('238', 'VG', 'Virgin Islands (British)');
INSERT INTO `countries` VALUES ('239', 'VI', 'Virgin Islands (U.S.)');
INSERT INTO `countries` VALUES ('240', 'WF', 'Wallis and Futuna Islands');
INSERT INTO `countries` VALUES ('241', 'EH', 'Western Sahara');
INSERT INTO `countries` VALUES ('242', 'YE', 'Yemen');
INSERT INTO `countries` VALUES ('243', 'YU', 'Yugoslavia');
INSERT INTO `countries` VALUES ('244', 'ZR', 'Zaire');
INSERT INTO `countries` VALUES ('245', 'ZM', 'Zambia');
INSERT INTO `countries` VALUES ('246', 'ZW', 'Zimbabwe');
INSERT INTO `countries` VALUES ('247', '1', '2');

-- ----------------------------
-- Table structure for employes
-- ----------------------------
DROP TABLE IF EXISTS `employes`;
CREATE TABLE `employes` (
  `pegawai_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `namadepan` varchar(15) DEFAULT NULL,
  `namabelakang` varchar(15) DEFAULT NULL,
  `gelardepan` varchar(5) DEFAULT NULL,
  `gelarbelakang` varchar(5) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`pegawai_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of employes
-- ----------------------------

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `total_amount` varchar(10) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`),
  KEY `Order_User` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_price` varchar(10) NOT NULL,
  `order_dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`) ON UPDATE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of order_details
-- ----------------------------

-- ----------------------------
-- Table structure for publishers
-- ----------------------------
DROP TABLE IF EXISTS `publishers`;
CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(20) NOT NULL,
  `publisher_country` int(11) NOT NULL,
  `publisher_city` varchar(20) NOT NULL,
  `publisher_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`publisher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of publishers
-- ----------------------------
INSERT INTO `publishers` VALUES ('1', 'LongHorn Publishers', '1', 'Test', '1');
INSERT INTO `publishers` VALUES ('2', 'Kilimanjaro Publishe', '244', 'Another City', '1');

-- ----------------------------
-- Table structure for ref_roles
-- ----------------------------
DROP TABLE IF EXISTS `ref_roles`;
CREATE TABLE `ref_roles` (
  `role_id` varchar(7) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `isactive` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ref_roles
-- ----------------------------
INSERT INTO `ref_roles` VALUES ('AD', 'Administrator', '1');
INSERT INTO `ref_roles` VALUES ('E', 'Employe', '0');
INSERT INTO `ref_roles` VALUES ('SA', 'Super Admin', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(200) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_gender` varchar(5) DEFAULT NULL,
  `user_firstname` varchar(20) DEFAULT NULL,
  `user_lastname` varchar(20) DEFAULT NULL,
  `user_fullname` varchar(200) DEFAULT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_mobile` varchar(20) DEFAULT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_photo` varchar(200) DEFAULT NULL,
  `user_active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`user_name`),
  UNIQUE KEY `user_mobile` (`user_mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5', '114746095932612758526', 'landungpujisantoso@gmail.com', null, 'Landung', 'Puji Santoso', 'Landung Puji Santoso', 'landungpujisantoso@gmail.com', null, '$2y$10$nnlJNvUtWl4SUktrJ/ZNrew7P/tIAP2znlL4m8ZT6XLhRldBn/sY6', null, '1');
INSERT INTO `users` VALUES ('6', '', 'landungpujisantoso2@gmail.com', null, null, null, 'Landung Puji Santoso 2', 'landungpujisantoso2@gmail.com', null, '$2y$10$YTdwz9WdaDNuPz9.8eizl.qYp1UPIsILjzT7O0j25EVSxLszHP9gm', null, '1');
INSERT INTO `users` VALUES ('9', '', 'landungpujisantoso3@gmail.com', null, null, null, 'Landung Puji Santoso 3wv', 'landungpujisantoso3@gmail.com', null, '$2y$10$04HukNwkBr2qjz/ukG8M5e6BsyDs29CPkDpGEpLJ93FhpR9eZiBHy', null, '1');
INSERT INTO `users` VALUES ('10', '', 'landungpujisantoso4@gmail.com', null, null, null, 'Landung Puji Santoso 4', 'landungpujisantoso4@gmail.com', null, '$2y$10$VEFvy8sE2/BRQldCXjluIOJwqG6mG8iNTst7TVdY3XNpcD17qGF3W', null, '0');

-- ----------------------------
-- Table structure for user_billing
-- ----------------------------
DROP TABLE IF EXISTS `user_billing`;
CREATE TABLE `user_billing` (
  `billing_id` int(11) NOT NULL AUTO_INCREMENT,
  `billing_user_id` int(11) NOT NULL,
  `billing_address` text NOT NULL,
  `billing_country` varchar(50) NOT NULL,
  `billing_phonenumber` varchar(20) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`billing_id`),
  KEY `User_Billing_User` (`billing_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_billing
-- ----------------------------

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('1', '2');
