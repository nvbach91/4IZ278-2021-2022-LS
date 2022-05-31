
# ##########################################################################
# TABLES
# ##########################################################################


DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_czech_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pwd_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `privilege` int(11) NOT NULL DEFAULT 0,
  `pwd_expired` int(11) NOT NULL DEFAULT 1,
  `facebook_id` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS category;
CREATE TABLE IF NOT EXISTS category (
  `category_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS event;
CREATE TABLE IF NOT EXISTS event (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `location_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`event_id`),
  FOREIGN KEY (`category_id`) REFERENCES category(`category_id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS ticket;
CREATE TABLE IF NOT EXISTS ticket (
  `ticket_id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NOT NULL,
  `price` INT NOT NULL DEFAULT 0,
  `capacity` INT NOT NULL DEFAULT 0,
  `booked` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`ticket_id`),
  UNIQUE KEY `key1` (`ticket_id`, `event_id`),
  FOREIGN KEY (`event_id`) REFERENCES event(`event_id`),
  CONSTRAINT CHK_Capacity CHECK (booked <= capacity))
ENGINE = InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS user_ticket;
CREATE TABLE `user_ticket` (
  `user_ticket_id` INT NOT NULL AUTO_INCREMENT,
  `ticket_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `code` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`user_ticket_id`),
  UNIQUE KEY `key1` (`ticket_id`, `code`),
  FOREIGN KEY (`ticket_id`) REFERENCES ticket(`ticket_id`),
  FOREIGN KEY (`user_id`) REFERENCES user(`user_id`))
ENGINE = InnoDB DEFAULT CHARSET=utf8;

# ##########################################################################
# VIEWS
# ##########################################################################

DROP VIEW IF EXISTS v_event;
CREATE VIEW v_event AS
SELECT
  e.event_id AS event_id,
  e.category_id AS category_id,
  cat.name AS category_name,
  e.name AS name,
  e.description AS description,
  e.start_date AS start_date,
  e.location_name AS location_name,
  e.location_adress AS location_adress,
  e.active AS active,
  SUM(tic.capacity) AS capacity
FROM event as e
JOIN category AS cat ON cat.category_id = e.category_id
JOIN ticket AS tic ON tic.event_id = e.event_id
GROUP BY e.event_id
ORDER BY e.event_id
;


DROP VIEW IF EXISTS v_tic_booked;
CREATE VIEW v_tic_booked AS
SELECT
  tic.ticket_id AS ticket_id,
  tic.event_id AS event_id,
  tic.capacity AS capacity,
  tic.booked AS booked,
  (tic.capacity - tic.booked) AS t_free
FROM ticket AS tic
JOIN user_ticket AS cut ON cut.ticket_id = tic.ticket_id
GROUP BY tic.ticket_id
ORDER BY tic.ticket_id, cut.ticket_id
;


DROP VIEW IF EXISTS v_event_booked;
CREATE VIEW v_event_booked AS
SELECT
  e.event_id AS event_id,
  e.category_id AS category_id,
  e.name AS name,
  e.description AS description,
  e.start_date AS start_date,
  e.active AS active,
  e.capacity AS capacity,
  COALESCE (SUM(ticb.booked), 0) AS booked,
  (e.capacity - COALESCE (SUM(ticb.booked), 0)) AS t_free
FROM v_event as e
LEFT JOIN v_tic_booked AS ticb ON ticb.event_id = e.event_id
GROUP BY e.event_id
ORDER BY e.event_id
;

DROP VIEW IF EXISTS v_ticket_event;
CREATE VIEW v_ticket_event AS
SELECT
  u.user_id AS user_id, 
  u.code AS code,
  tic.price AS price,
  ve.event_id AS event_id,
  ve.category_name AS category_name,
  ve.name AS name,
  ve.description AS description,
  ve.start_date AS start_date,
  ve.location_name AS location_name,
  ve.location_adress AS location_adress,
  ve.active AS active
FROM v_event AS ve
JOIN  ticket AS tic ON tic.event_id = ve.event_id
JOIN user_ticket AS u ON u.ticket_id = tic.ticket_id
ORDER BY u.user_id, ve.event_id, u.user_ticket_id;
;


# ##########################################################################
# TRIGGERS
# ##########################################################################


DELIMITER $$
DROP TRIGGER IF EXISTS `tr_user_ticket_insert`$$
CREATE TRIGGER `tr_user_ticket_insert` AFTER INSERT on `user_ticket`
FOR EACH ROW
BEGIN
#  UPDATE ticket SET booked = booked + 1 WHERE id = NEW.ticat_id;
  UPDATE ticket
  SET booked = (
    SELECT COUNT(ticket_id) FROM user_ticket WHERE ticket_id = NEW.ticket_id
  ) WHERE ticket_id = NEW.ticket_id;
END$$
DELIMITER ;


DELIMITER $$
DROP TRIGGER IF EXISTS `tr_user_ticket_update`$$
CREATE TRIGGER `tr_user_ticket_update` AFTER UPDATE on `user_ticket`
FOR EACH ROW
BEGIN
  UPDATE ticket
  SET booked = (
    SELECT COUNT(ticket_id) FROM user_ticket WHERE ticket_id = NEW.ticket_id
  ) WHERE ticket_id = NEW.ticket_id;
END$$
DELIMITER ;


# ##########################################################################
# FUNCTIONS
# ##########################################################################


#DELIMITER $$
#DROP FUNCTION IF EXISTS `get_tic_sum`$$
#CREATE FUNCTION get_tic_sum(p_event_id INT) RETURNS INT
#BEGIN
#  DECLARE p_tic_sum INT;
#  SELECT COALESCE(
#    (
#    SELECT SUM(booked)
#    FROM v_tic_booked
#    WHERE event_id = p_event_id)
#  , 0)INTO p_tic_sum;
#  RETURN p_tic_sum;
#END;
#$$
#DELIMITER ;


# ##########################################################################
# DATA
# ##########################################################################

# admin : admin1
# user1 : user1
# user2 : user2
# user3 : user3
# user4 : user4
# user5 : user5

#INSERT INTO account (name, pwd_hash, created, enabled, priv_super, priv_power, priv_normal, pwd_expired)
#VALUES
#('admin', '$2y$10$hR2yR0Kl9Qh6dkq.wq1B3OaWofxvscgUEf9QXLFGIbetE2HBqW5cq', NOW(), 1, 1, 0, 0, 0),
#('user1', '$2y$10$QFaKHxfDY7I2YHpIJTsMDeP5L1g2UPo1DR7KFMkHBGBx8q0KDUyDW', NOW(), 1, 0, 1, 0, 0),
#('user2', '$2y$10$GSZd2B864Jjtj3awujFYke/KCBrnTuMMd0M.y/ahLU5v7DGpKWvoa', NOW(), 1, 0, 0, 1, 0),
#('user3', '$2y$10$689cxdlEs.fjLUVVxYpRhuJjRSoM7xSc0rVLARMgKzoP5d8Lp8LKu', NOW(), 1, 0, 0, 1, 0),
#('user4', '$2y$10$9Vyq4RnalYq469UnAcqPHOvAzQOJi8gCXXPCMtWCrAwUD9t/xS93S', NOW(), 1, 0, 0, 1, 0),
#('user5', '$2y$10$lq2aMNTtW2LWhNYWS7wyHekOzzMEEECTUp9RWPuDdyNPnLZBiOAX.', NOW(), 1, 0, 0, 1, 0)
#;


INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Koncerty'),
(2, 'Kvízy'),
(3, 'Sporty'),
(4, 'Workshopy');