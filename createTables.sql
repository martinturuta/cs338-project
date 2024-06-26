CREATE TABLE COMPANY(
    company_id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    sector VARCHAR(255) NOT NULL,
    market_cap BIGINT NOT NULL,
    ebitda VARCHAR(255) NOT NULL,
    revenue_growth decimal(8,4) NOT NULL,
    PRIMARY KEY (company_id)
);

CREATE TABLE USERS (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE SHORTLIST (
	sid varchar(5) NOT NULL, 
	sname varchar(30) NOT NULL, 
	user_id INT NOT NULL,
    PRIMARY KEY (sid),
    FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE SHORTLIST_CONTAINS (
	sid varchar(5) NOT NULL, 
	company_id INT NOT NULL, 
	user_id INT NOT NULL, 
	sentiment ENUM('Bullish', 'Bearish'), 
	date_shortlisted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (sid, company_id),
	FOREIGN KEY (sid) REFERENCES shortlist(sid) ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (company_id) REFERENCES COMPANY(company_id)
);