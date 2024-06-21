<!DOCTYPE html>
<html>
<body>
<?php

$servername = "127.0.0.1";
$username = "root";
$password = "martin11";
$dbname = "DB_Group11";

function csvToArray($csv)
{
    $csvInfo = fopen($csv, 'r');
    while(!feof($csvInfo)) {
        $csvArray[] = fgetcsv($csvInfo, 1000, ',');
    }
    fclose($csvInfo);
    return $csvArray;
}
function preparePublicCompanyInfo() {
    $companyInfoArr = csvToArray("sp500_companies.csv");
    $companyNames = array();
    $companySectors = array();
    $companyMarketCaps = array();
    $companyEbitda = array();
    $companyRevGrowth = array();
    
    for ($i = 1; $i < 504; $i++) {
        array_push($companyNames,is_null($companyInfoArr[$i][2]) ? "N/A" : $companyInfoArr[$i][2]);
        array_push($companySectors,is_null($companyInfoArr[$i][4]) ? "N/A" :$companyInfoArr[$i][4] );
        array_push($companyMarketCaps,$companyInfoArr[$i][7]);
        array_push($companyEbitda,is_null($companyInfoArr[$i][8]) ? 0 : $companyInfoArr[$i][8]);
        array_push($companyRevGrowth,is_null($companyInfoArr[$i][9]) ? 0 :$companyInfoArr[$i][9]);
    }
}

function insertSample() {
    // Create connection
    
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }
    $sqlToInsertIntoCompany = "INSERT INTO COMPANY(name, sector, market_cap, ebitda,revenue_growth) VALUES
    ('NVIDIA Corporation','Technology',3340000000000,49274998784,2.621),
    ('Microsoft Corporation','Technology',3320000000000,126000000000,0.17),
    ('Apple Inc.','Technology',3290000000000,130000000000,-0.043),
    ('Alphabet Inc.','Communication Services',2170000000000,110000000000,0.154),
    ('Amazon.com Inc.','Consumer Cyclical',1900000000000,96609001472,0.125),
    ('Meta Platforms Inc.','Communication Services',1270000000000,68446998528,0.273),
    ('Berkshire Hathaway Inc.','New Financial Services',881000000000,107000000000,0.052),
    ('Eli Lilly and Company','Healthcare',847000000000,13373700096,0.26),
    ('Broadcom Inc.','Technology',839000000000,21290999808,0.164),
    ('Tesla Inc.', 'Consumer Cyclical',590000000000,12264999936,-0.087),
    ('Visa Inc.','Financial Services',560000000000,23942000640,0.099),
    ('Walmart Inc.','Consumer Defensive',554000000000,39749001216,0.06)";
    $resultForInsertCompany = $conn->query($sqlToInsertIntoCompany);

    $sqlToInsertIntoUsers = "INSERT INTO USERS(email, username, password) VALUES
    ('test@gmail.com', 'testing', 'L@*!&@H#*HFDH^SDSDSD&SD&#&@')";
    $resultForInsertUsers = $conn->query($sqlToInsertIntoUsers);

    $sqlToInsertIntoShortlist = "INSERT INTO SHORTLIST(sid, sname,user_id)VALUES
    ('asdas', 'Tech companies', '1');";
    $resultForInsertIntoShortlist = $conn->query($sqlToInsertIntoShortlist);

    $sqlToInsertShortlistContains = "INSERT INTO SHORTLIST_CONTAINS(sid,company_id,user_id,sentiment) VALUES
    ('asdas','1','1','Bullish'),
    ('asdas','2','1','Bullish'),
    ('asdas','3','1','Bullish');";
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
    market_cap BIGINT NOT NULL,
    ebitda VARCHAR(255) NOT NULL,
    revenue_growth decimal(8,4) NOT NULL,
    PRIMARY KEY (company_id));";
    $resultForCompany = $conn->query($sqlToCreateCompany);

    $sqlToCreateUsers = "CREATE TABLE USERS (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id));";
    $resultForUsers = $conn->query($sqlToCreateUsers);

    $sqlToCreateShortlist = "CREATE TABLE SHORTLIST(
	sid varchar(5) NOT NULL, 
	sname varchar(30) NOT NULL, 
	user_id INT NOT NULL,
    PRIMARY KEY (sid),
    FOREIGN KEY (user_id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE);";
    $resultForShortlist = $conn->query($sqlToCreateShortlist);

    $sqlToCreateShortlistContains = "CREATE TABLE SHORTLIST_CONTAINS(
	sid varchar(5) NOT NULL, 
	company_id INT NOT NULL, 
	user_id INT NOT NULL, 
	sentiment ENUM('Bullish', 'Bearish'), 
	date_shortlisted TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (sid, company_id),
	FOREIGN KEY (sid) REFERENCES shortlist(sid) ON DELETE CASCADE ON UPDATE CASCADE, 
	FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForShortlistContains = $conn->query($sqlToCreateShortlistContains);
    $conn->close();
}
createAllTables();
insertSample();


?>
</body>
</html>