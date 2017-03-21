DROP PROCEDURE tasker.select_like;
delimiter //
CREATE PROCEDURE tasker.select_like (IN fnparam varchar(50), snparam varchar(50), limParam integer)
BEGIN
	DECLARE var1 varchar(50);
	DECLARE var2 varchar(50);
	DECLARE var3 int(5);
    SET var1 = fnparam;
    SET var2 = snparam;
    SET var3 = limParam;
	SELECT user_id, firstName, secondName, middleName, jobTitle FROM tasker.activeuserview WHERE secondName LIKE `var1` AND firstName LIKE `var2`;
END//

delimiter ;
