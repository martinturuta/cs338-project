<!DOCTYPE html>
<html>
<body>
<?php

$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testdb";

function csvToArray($csv)
{
    $csvInfo = fopen($csv, 'r');
    while(!feof($csvInfo)) {
        $csvArray[] = fgetcsv($csvInfo, 1000, ',');
    }
    fclose($csvInfo);
    return $csvArray;
}
function prepareProductionDataset() {
    global $servername, $username, $password, $dbname;
    $companyInfoArr = csvToArray("sp500_companies.csv");
    $companyNames = array();
    $companySectors = array();
    $companyCurPrice = array();
    $companyMarketCaps = array();
    $companyEbitda = array();
    $companyRevGrowth = array();
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); }

    // Public Companies
    for ($i = 1; $i < 503; $i++) {
        array_push($companyNames,$companyInfoArr[$i][2]);
        array_push($companySectors,$companyInfoArr[$i][4]);
        array_push($companyCurPrice,$companyInfoArr[$i][6]);
        array_push($companyMarketCaps,$companyInfoArr[$i][7]);
        array_push($companyEbitda,$companyInfoArr[$i][8] == '' ? 0 : $companyInfoArr[$i][8]);
        array_push($companyRevGrowth,$companyInfoArr[$i][9] == '' ? 0 :$companyInfoArr[$i][9]);
    }
    $insertCompanyStatement = "INSERT INTO COMPANY(name, sector, ebitda,revenue_growth) VALUES ";
    $insertPublicStatement = "INSERT INTO PUBLIC_COMPANY(company_id, market_cap,market_price) VALUES ";
    for ($i = 0; $i < 502; $i++) {
        $id = $i + 1;
        if ($i == 501) {
            $insertCompanyStatement = $insertCompanyStatement.'("'.$companyNames[$i].'","'.$companySectors[$i].'","'.$companyEbitda[$i].'","'.$companyRevGrowth[$i].'")';
            $insertPublicStatement = $insertPublicStatement.'("'.$id.'","'.$companyMarketCaps[$i].'","'.$companyCurPrice[$i].'")';
        } else {
            $insertCompanyStatement = $insertCompanyStatement.'("'.$companyNames[$i].'","'.$companySectors[$i].'","'.$companyEbitda[$i].'","'.$companyRevGrowth[$i].'"),';
            $insertPublicStatement = $insertPublicStatement.'("'.$id.'","'.$companyMarketCaps[$i].'","'.$companyCurPrice[$i].'"),';
        }
    }
    $conn->query($insertCompanyStatement);
    $conn->query($insertPublicStatement);
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
    investor_id INT NOT NULL AUTO_INCREMENT,
	id INT NOT NULL, 
    PRIMARY KEY (investor_id),
    FOREIGN KEY (id) REFERENCES USERS(id) ON DELETE CASCADE ON UPDATE CASCADE);";
    $resultForInvestor = $conn->query($sqlToCreateInvestors);

    $sqlToCreatePrivCompanyCEO = "CREATE TABLE Private_Company_CEO (
	ceo_id INT NOT NULL AUTO_INCREMENT,
    id INT NOT NULL, 
    company_id INT NOT NULL,
    starting_date TIMESTAMP NOT NULL,
    PRIMARY KEY (ceo_id),
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
prepareProductionDataset();


?>
</body>
</html>