/*==============================================================*/
/* 	THIRD YEAR PROJECT											*/
/*	DATABASE :  MySQL					                        */
/*==============================================================*/

DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS ticket_sales;
DROP TABLE IF EXISTS transaction;
DROP TABLE IF EXISTS properties;
DROP TABLE IF EXISTS hurdle_results;
DROP TABLE IF EXISTS hurdle_laneAllocation;
DROP TABLE IF EXISTS hurdle_heats;
DROP TABLE IF EXISTS hurdles_competitors;
DROP TABLE IF EXISTS wattBall_ranking;
DROP TABLE IF EXISTS wattBall_goals;
DROP TABLE IF EXISTS wattBall_results;
DROP TABLE IF EXISTS wattBall_matches;
DROP TABLE IF EXISTS umpire;
DROP TABLE IF EXISTS wattBall_players;
DROP TABLE IF EXISTS wattBall_team;
DROP TABLE IF EXISTS tournament;
DROP TABLE IF EXISTS staff;

/*==============================================================*/
/* Table : tournament                                           */
/*==============================================================*/

CREATE TABLE tournament
(
	tournamentID SERIAL NOT NULL,
	name VARCHAR(200),
	startDate DATE,
	endDate DATE,
	registrationOpen DATE,
	registrationClose DATE,
	CONSTRAINT pk_tournament_tournamentid PRIMARY KEY(tournamentID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : staff                                                */
/*==============================================================*/

CREATE TABLE staff
(
	username VARCHAR(50) NOT NULL,
	password VARCHAR(200) NOT NULL,
	name VARCHAR(100),
	manager BOOLEAN NOT NULL,
	CONSTRAINT pk_staff_username PRIMARY KEY (username)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_team                                        */
/*==============================================================*/

CREATE TABLE wattBall_team
(
	teamID SERIAL NOT NULL,
	tournamentID BIGINT(20) UNSIGNED NOT NULL,
	teamName VARCHAR(200),
	contactName VARCHAR(200),
	contactNumber VARCHAR(11),
	NWANumber VARCHAR(7),
	email VARCHAR(200),
	CONSTRAINT pk_wattballteam_teamid PRIMARY KEY (teamID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_players                                     */
/*==============================================================*/

CREATE TABLE wattBall_players
(
	playerID SERIAL NOT NULl,
	teamID BIGINT(20) UNSIGNED NOT NULL,
	playerName VARCHAR(200),
	CONSTRAINT pk_wattballplayers_playerid PRIMARY KEY (playerID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : umpire                                               */
/*==============================================================*/

CREATE TABLE umpire
(
	umpireID SERIAL NOT NULL,
	umpireName VARCHAR(200),
	umpireEmail VARCHAR(200),
	monMorning BOOLEAN,
	monAfternoon BOOLEAN,
	tuesMorning BOOLEAN,
	tuesAfternoon BOOLEAN,
	wedMorning BOOLEAN,
	wedAfternoon BOOLEAN,
	thursMorning BOOLEAN,
	thursAfternoon BOOLEAN,
	friMorning BOOLEAN,
	friAfternoon BOOLEAN,
	satMorning BOOLEAN,
	satAfternoon BOOLEAN,
	sunMorning BOOLEAN,
	sunAfternoon BOOLEAN,
	CONSTRAINT pk_umpire PRIMARY KEY (umpireID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_matches                                     */
/*==============================================================*/

CREATE TABLE wattBall_matches
(
	matchID SERIAL NOT NULL,
	tournamentID BIGINT(20) UNSIGNED NOT NULL,
	matchDate DATE,
	matchTime VARCHAR(4), /* 10am or 2pm  */
	pitch INTEGER,
	team1 BIGINT(20) UNSIGNED NOT NULL,
	team2 BIGINT(20) UNSIGNED NOT NULL,
	umpire BIGINT(20) UNSIGNED NOT NULL,
	CONSTRAINT pk_wattballmatches PRIMARY KEY (matchID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_results                                     */
/*==============================================================*/

CREATE TABLE wattBall_results
(
	resultID SERIAL NOT NULL,
	matchID BIGINT(20) UNSIGNED NOT NULL,
	team1Score INTEGER,
	team2Score INTEGER,
	matchReport VARCHAR(200),
	CONSTRAINT pk_wattballresults PRIMARY KEY (resultID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_goals                                       */
/*==============================================================*/

CREATE TABLE wattBall_goals
(
	goalID SERIAL NOT NULL,
	matchID BIGINT(20) UNSIGNED NOT NULL,
	minute INTEGER,
	playerID BIGINT(20) UNSIGNED NOT NULL,
	CONSTRAINT pk_wattballgoals PRIMARY KEY (goalID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : wattBall_ranking                                     */
/*==============================================================*/
CREATE TABLE wattBall_ranking
(
	teamID SERIAL NOT NULL,
	tournamentID BIGINT(20) UNSIGNED NOT NULL,
	won INTEGER,
	lost INTEGER,
	drawn INTEGER,
	goalsFor INTEGER,
	goalsAgainst INTEGER,
	goalDifference INTEGER,
	CONSTRAINT pk_wattballranking PRIMARY KEY (teamID,tournamentID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : Hurdles_Competitors                                  */
/*==============================================================*/
CREATE TABLE hurdles_competitors
(
	hurdlerID SERIAL NOT NULL,
	hurdlerName VARCHAR(200),
	hurdlerGender VARCHAR(1), /* M or F */
	hurdlerPerformance DOUBLE,
	contactName VARCHAR(200),
	contactNumber VARCHAR(11),
	email VARCHAR(200),
	dateOfBirth	DATE,
	CONSTRAINT pk_hurdlescompetitors PRIMARY KEY (hurdlerID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : Hurdle_Heats                                         */
/*==============================================================*/
CREATE TABLE hurdle_heats
(
	heatID SERIAL NOT NULL,
	tournamentID BIGINT(20) UNSIGNED NOT NULL,
	heatTime TIME,
	heatDate DATE,
	stage INTEGER,
	CONSTRAINT pk_hurdleheats PRIMARY KEY (heatID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : hurdle_laneAllocation                                  */
/*==============================================================*/
CREATE TABLE hurdle_laneAllocation 
(
	heatID SERIAL NOT NULL,
	laneID TINYINT,
	hurdlerID BIGINT(20) UNSIGNED NOT NULL,
	CONSTRAINT pk_hurdlelaneallocation1 PRIMARY KEY (heatID,laneID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : Hurdles_results                                      */
/*==============================================================*/

CREATE TABLE hurdle_results
(
	resultID SERIAL NOT NULL,
	heatID BIGINT(20) UNSIGNED NOT NULL,
	hurdlerID BIGINT(20) UNSIGNED NOT NULL,
	position INTEGER,
	time DOUBLE,
	CONSTRAINT pk_hurdleresult PRIMARY KEY (resultID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*==============================================================*/
/* Table : Hurdles_results                                      */
/*==============================================================*/

CREATE TABLE properties
(
	id SERIAL NOT NULL,
	concessionPrice DOUBLE,
	adultPrice DOUBLE,
	CONSTRAINT pk_properties PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*==============================================================*/
/* Table : transaction                                          */
/*==============================================================*/
CREATE TABLE transaction
(
	transactionID SERIAL NOT NULL,
	cardNumber VARCHAR(20),
	cscNumber INTEGER,
	issueNo DOUBLE,
	cardType VARCHAR(15),
	validUntil DATE,
	CONSTRAINT pk_transaction PRIMARY KEY (transactionID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*==============================================================*/
/* Table : tticketSales                                         */
/*==============================================================*/

CREATE TABLE ticket_sales
(
	bookingID SERIAL NOT NULL,
	transactionID BIGINT(20) UNSIGNED NOT NULL,
	name VARCHAR(100),
	email VARCHAR(100),
	address1 VARCHAR(100),
	address2 VARCHAR(100),
	city VARCHAR(100),
	county VARCHAR(100),
	postcode VARCHAR(10),
	CONSTRAINT pk_ticketsales PRIMARY KEY (bookingID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*==============================================================*/
/* Table : ticket                                               */
/*==============================================================*/

CREATE TABLE ticket
(
	ticketID SERIAL NOT NULL,
	bookingID BIGINT(20) UNSIGNED NOT NULL,
	methodOfSale VARCHAR(100),/* (Online/Competitor Allocation/Sold on Door) */
	concessionNo DOUBLE,
	adultNo DOUBLE,
	cost DOUBLE,
	dateOfTicket DATE,
	status VARCHAR(100), /* (Collected/Awaiting Collection/Dispatched/Awaiting Dispatch) */
	CONSTRAINT pk_ticket PRIMARY KEY (ticketID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*==============================================================*/
/* ALTER TABLE                                                  */
/*==============================================================*/

ALTER TABLE wattBall_team ADD CONSTRAINT fk_wattballteam_tournament FOREIGN KEY (teamID) REFERENCES tournament(tournamentID);

ALTER TABLE wattBall_players ADD CONSTRAINT fk_wattballplayers_wattballteam FOREIGN KEY (teamID) REFERENCES wattBall_team(teamID);

ALTER TABLE wattBall_matches ADD CONSTRAINT fk_wattballmatches_tournament FOREIGN KEY (tournamentID) REFERENCES tournament(tournamentID);
ALTER TABLE wattBall_matches ADD CONSTRAINT fk_wattballmatches_team1 FOREIGN KEY (team1) REFERENCES wattBall_team(teamID);
ALTER TABLE wattBall_matches ADD CONSTRAINT fk_wattballmatches_team2 FOREIGN KEY (team2) REFERENCES wattBall_team(teamID);
ALTER TABLE wattBall_matches ADD CONSTRAINT fk_wattballmatches_umpire FOREIGN KEY (umpire) REFERENCES umpire(umpireID);

ALTER TABLE wattBall_results ADD CONSTRAINT fk_wattballresults_wattballmatches FOREIGN KEY (matchID) REFERENCES wattBall_matches(matchID);

ALTER TABLE wattBall_goals ADD CONSTRAINT fk_wattballgoals_wattballmatches FOREIGN KEY (matchID) REFERENCES wattBall_matches(matchID);
ALTER TABLE wattBall_goals ADD CONSTRAINT fk_wattballgoals_wattballplayers FOREIGN KEY (playerID) REFERENCES wattBall_players(playerID);

ALTER TABLE wattBall_ranking ADD CONSTRAINT fk_wattballranking_wattballteam FOREIGN KEY (teamID) REFERENCES wattBall_team(teamID);
ALTER TABLE wattBall_ranking ADD CONSTRAINT fk_wattballranking_tournament FOREIGN KEY (tournamentID) REFERENCES tournament(tournamentID);

ALTER TABLE hurdle_heats ADD CONSTRAINT fk_hurdleheat_tournament FOREIGN KEY (tournamentID) REFERENCES tournament(tournamentID);


ALTER TABLE hurdle_laneAllocation ADD CONSTRAINT fk_hurdlelanealloc_hurdleheat FOREIGN KEY (heatID) REFERENCES hurdle_heats(heatID);
ALTER TABLE hurdle_laneAllocation ADD CONSTRAINT fk_hurdlelanealloc_hurdlecompetitor FOREIGN KEY (hurdlerID) REFERENCES hurdles_competitors(hurdlerID);

ALTER TABLE hurdle_results ADD CONSTRAINT fk_hurdleresult_hurdleheat FOREIGN KEY (heatID) REFERENCES hurdle_heats(heatID);
ALTER TABLE hurdle_results ADD CONSTRAINT fk_hurdlerrsult_hurdlecompetitor FOREIGN KEY (hurdlerID) REFERENCES hurdles_competitors(hurdlerID);

ALTER TABLE ticket_sales ADD CONSTRAINT fk_ticketsale_transaction FOREIGN KEY (transactionID) REFERENCES transaction(transactionID);

ALTER TABLE ticket ADD CONSTRAINT fk_ticket_ticketsale FOREIGN KEY (bookingID) REFERENCES ticket_sales(bookingID);



/*==============================================================*/
/* INSERT                                                       */
/*==============================================================*/

INSERT INTO staff(username,password,name,manager) VALUES('admin','d033e22ae348aeb5660fc2140aec35850c4da997','Administrator',1);
 




