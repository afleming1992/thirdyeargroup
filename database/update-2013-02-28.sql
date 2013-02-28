ALTER table wattball_players add numberOfGoals int(11);
SELECT @nb := IFNULL(numberOfGoals , 0) FROM wattball_players;
UPDATE wattball_players SET numberOfGoals = @nb;