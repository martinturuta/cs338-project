<!DOCTYPE html>
<html>
<body>
<?php

$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testdb";

function prepareSampleDataset() {
    // Create connection
    
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
    $sqlToInsertIntoCompany = "INSERT INTO COMPANY(name, sector, ebitda,revenue_growth) VALUES
    ('NVIDIA Corporation','Technology','49274998784','2.621'),
    ('Microsoft Corporation','Technology','126000000000','0.17'),
    ('Apple Inc.','Technology','130000000000','-0.043'),
    ('Alphabet Inc.','Communication Services','110000000000','0.154'),
    ('Amazon.com Inc.','Consumer Cyclical','96609001472','0.125'),
    ('Meta Platforms Inc.','Communication Services','68446998528','0.273'),
    ('Berkshire Hathaway Inc.','New Financial Services','107000000000','0.052'),
    ('Eli Lilly and Company','Healthcare','13373700096','0.26'),
    ('Broadcom Inc.','Technology','21290999808','0.164'),
    ('Tesla Inc.', 'Consumer Cyclical','12264999936','-0.087'),
    ('Visa Inc.','Financial Services','23942000640','0.099'),
    ('Walmart Inc.','Consumer Defensive','39749001216','0.06'),
    ('Private1','Technology','19749001','0.06'),
    ('Private2','Technology','297490012','0.06'),
    ('Private3','Technology','3974900121','0.06')";
    $resultForInsertCompany = $conn->query($sqlToInsertIntoCompany);

    $sqlToInsertIntoPublic = "INSERT INTO PUBLIC_COMPANY(company_id, market_cap, market_price) VALUES
    ('1','3340000000000','135.58'),
    ('2','3320000000000','136.58'),
    ('3','3290000000000','137.58'),
    ('4','2170000000000','138.58'),
    ('5','1900000000000','139.58'),
    ('6','1270000000000','140.58'),
    ('7','881000000000','141.58'),
    ('8','847000000000','142.58'),
    ('9','839000000000','143.58'),
    ('10','590000000000','144.58'),
    ('11','560000000000','145.58'),
    ('12','544000000000','146.58')";
    $resultForInsertPublic = $conn->query($sqlToInsertIntoPublic);
    
    $sqlToInsertIntoPrivate = "INSERT INTO PRIVATE_COMPANY(company_id, valuation) VALUES
    ('13', '123456'),
    ('14', '222222'),
    ('15', '333333')";
    $resultFOrInsertPrivate = $conn->query($sqlToInsertIntoPrivate);

    $password = password_hash('test', PASSWORD_DEFAULT);
    $sqlToInsertIntoUsers = "INSERT INTO USERS(email, username, password) VALUES
    ('test@gmail.com', 'test', '$password')";

    $resultForInsertUsers = $conn->query($sqlToInsertIntoUsers);

    $sqlToInsertIntoInvestors = "INSERT INTO INVESTORS(id) VALUES ('1')";
    $resultForInsertIntoInvestors = $conn->query($sqlToInsertIntoInvestors);

    $sqlToInsertIntoShortlist = "INSERT INTO SHORTLIST(sid, sname, user_id)VALUES
    ('1', 'Sample Companies 1', '1'),
    ('2', 'Sample Companies 2', '1');";
    $resultForInsertIntoShortlist = $conn->query($sqlToInsertIntoShortlist);

    $sqlToInsertShortlistContains = "INSERT INTO SHORTLIST_CONTAINS(sid,company_id,date_shortlisted) VALUES
    ('1','1', '2024-07-08 20:17:33'),
    ('1','2', '2024-06-11 20:17:33'),
    ('1','3', '2024-07-02 20:17:33'),
    ('2','3', '2024-07-08 20:17:33'),
    ('1','4', '2024-05-08 20:17:33'),
    ('2','4', '2024-06-23 20:17:33');";
    $resultForInsertIntoShortlistContains = $conn->query($sqlToInsertShortlistContains);
    $conn->close();
}

function createAllTables() {
    // Create connection
    
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }

    $sqlToCreateCompany = "CREATE TABLE COMPANY (
    company_id INT AUTO_INCREMENT NOT NULL,
    name VARCHAR(255) NOT NULL,
    sector VARCHAR(255) NOT NULL,
    ebitda VARCHAR(255) NOT NULL,
    revenue_growth decimal(8,4) NOT NULL,
    PRIMARY KEY (company_id));";
    $resultForCompany = $conn->query($sqlToCreateCompany);

    $sqlToCreatePrivateCompany = "CREATE TABLE PRIVATE_COMPANY(
    company_id INT NOT NULL,  
    valuation BIGINT NOT NULL,
    PRIMARY KEY (company_id),
    FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForPrivateCompany = $conn->query($sqlToCreatePrivateCompany);

    $sqlToCreatePublicCompany = "CREATE TABLE PUBLIC_COMPANY(
    company_id INT NOT NULL,  
    market_cap BIGINT NOT NULL,
    market_price BIGINT NOT NULL,
    PRIMARY KEY (company_id),
    FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForPublicCompany = $conn->query($sqlToCreatePublicCompany);

    $sqlToCreateUsers = "CREATE TABLE USERS (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE (email));";
    $resultForUsers = $conn->query($sqlToCreateUsers);

    $sqlToCreateInvestors = "CREATE TABLE INVESTORS (
	id INT NOT NULL, 
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE);";
    $resultForInvestor = $conn->query($sqlToCreateInvestors);

    $sqlToCreatePrivCompanyCEO = "CREATE TABLE Private_Company_CEO (
	id INT NOT NULL, 
    company_id INT NOT NULL,
    starting_date TIMESTAMP NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForPrivCompCEO = $conn->query($sqlToCreatePrivCompanyCEO);

    $sqlToCreateShortlist = "CREATE TABLE SHORTLIST(
	sid INT AUTO_INCREMENT NOT NULL, 
	sname varchar(30) NOT NULL, 
	user_id INT NOT NULL,
    PRIMARY KEY (sid),
    FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE);";
    $resultForShortlist = $conn->query($sqlToCreateShortlist);

    $sqlToCreateShortlistContains = "CREATE TABLE SHORTLIST_CONTAINS(
	sid INT NOT NULL, 
	company_id INT NOT NULL, 
	date_shortlisted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (sid, company_id),
	FOREIGN KEY (sid) REFERENCES shortlist(sid) ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForShortlistContains = $conn->query($sqlToCreateShortlistContains);
    $conn->close();
}
createAllTables();
prepareSampleDataset();


?>
</body>
</html>