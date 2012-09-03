**************************************************
				MySQL Version 5.1.34
					Vikas Reddy
Create tables from bottom to up i.e., first we need
to create Umpire table and last Match table. I think
there is some problem with the name of Match table
-- might be some clash with a keyword. So, it 
should be "Matches".
**************************************************


CREATE TABLE Match ( 
					 M_id INT NOT NULL, 
					 M_date DATE NOT NULL, 
					 M_level CHAR(10), 
					 Winner_id INT, 
					 Stadium_id INT NOT NULL, 
					 Man_of_Match_id INT, 
					 Team1_id INT NOT NULL,
					 Team2_id INT NOT NULL,
					 PRIMARY KEY (M_id), 
					 FOREIGN KEY (Team1_id) REFERENCES Team(T_id), 
					 FOREIGN KEY (Winner_id) REFERENCES Team(T_id), 
					 FOREIGN KEY (Stadium_id) REFERENCES Stadium(S_id), 
					 FOREIGN KEY (Man_of_Match_id) REFERENCES Player(P_id)
)

CREATE TABLE Team (
		T_id INT NOT NULL,
		T_name VARCHAR(25),
		Captain_id INT,
		Num_matches_played INT,
		Highest_runs INT,
		PRIMARY KEY (T_id),
		FOREIGN KEY (Captain_id) REFERENCES Player(P_id),
)

CREATE TABLE Player (
		P_id INT NOT NULL,
		P_name VARCHAR(25),
		T_id INT,
		Highest_runs INT,
		Balls_played INT,
		Overs_bowled INT,
		Catches_caught INT,
		Runs_given INT,
		Wickets_taken INT,
		PRIMARY KEY (P_id),
		FOREIGN KEY (T_id) REFERENCES Team(T_id),
)

CREATE TABLE Stadium (
		S_id INT NOT NULL,
		S_name VARCHAR(25),
		Num_of_matches_played INT,
		Capacity INT,
		PRIMARY KEY (S_id)
)

CREATE TABLE Umpire (
		U_id INT NOT NULL,
		U_name VARCHAR (25),
		U_country VARCHAR (25),
		PRIMARY KEY (U_id)
)
