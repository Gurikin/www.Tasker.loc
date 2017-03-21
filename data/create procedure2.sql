USE `tasker`;
DROP procedure IF EXISTS `select_like`;

DELIMITER $$
USE `tasker`$$
CREATE PROCEDURE `select_like`(IN sn_param VARCHAR(50), IN fn_param VARCHAR(50))-- , lim_param INT)
BEGIN
	declare sn varchar(50);
	declare fn varchar(50);
	-- declare lim int;
    SET sn = sn_param;
    SET fn = fn_param;
    -- SET lim = lim_param;
    
    SELECT user_id, secondName, firstName, middleName, jobTitle FROM `tasker`.`activeuserview` WHERE secondName LIKE `sn` AND firstName LIKE `fn`;
END$$

DELIMITER ;

call select_like('%ива%', '%%');

--LIMIT не работает (наверное это связано с тем, что LIMIT это плюшка MYSQL и не является частью языка SQL)