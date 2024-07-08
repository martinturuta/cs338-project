<!DOCTYPE html>
<html>
<body>
<?php

$servername = "127.0.0.1";
$username = "Sathus";
$password = "Husan2404!";
$dbname = "testDB";

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

    // Private Companies
    $newInsertCompanyStatement = "INSERT INTO COMPANY(name, sector, ebitda,revenue_growth) VALUES
    ('AlphaTech Innovations', 'Technology', '15000000', '0.10'),
    ('GreenEnergy Solutions', 'Renewable Energy', '20000000', '0.15'),
    ('MedHealth Corp', 'Healthcare', '18000000', '0.12'),
    ('FinTech Dynamics', 'Financial Technology', '22000000', '0.20'),
    ('EcoGoods Retail', 'Retail', '14000000', '0.08'),
    ('CloudWare Systems', 'Software', '25000000', '0.18'),
    ('AgriGrowth Ventures', 'Agriculture', '12000000', '0.09'),
    ('UrbanBuild Constructors', 'Construction', '19000000', '0.11'),
    ('SafeGuard Security', 'Security Services', '16000000', '0.07'),
    ('EduTech Innovations', 'Education Technology', '21000000', '0.14'),
    ('BioLife Sciences', 'Biotechnology', '17000000', '0.13'),
    ('TravelEase Inc.', 'Travel & Leisure', '13000000', '0.10'),
    ('AutoDrive Manufacturing', 'Automotive', '24000000', '0.16'),
    ('FoodDelight Industries', 'Food & Beverage', '15000000', '0.09'),
    ('SmartHome Technologies', 'Smart Home', '18000000', '0.12'),
    ('AquaPure Water', 'Water Treatment', '20000000', '0.08'),
    ('CleanAir Solutions', 'Environmental Services', '19000000', '0.11'),
    ('RoboTech Robotics', 'Robotics', '23000000', '0.17'),
    ('WellnessPro Healthcare', 'Wellness & Fitness', '16000000', '0.10'),
    ('FashionForward Inc.', 'Fashion', '14000000', '0.06'),
    ('CyberShield Systems', 'Cybersecurity', '25000000', '0.19'),
    ('NextGen Logistics', 'Logistics', '21000000', '0.13'),
    ('GreenField Farms', 'Farming', '12000000', '0.08'),
    ('BuildSmart Construction', 'Construction', '19000000', '0.10'),
    ('BrightFuture Education', 'Education', '17000000', '0.12'),
    ('BioPharma Innovations', 'Pharmaceuticals', '22000000', '0.14'),
    ('HomeSafe Security', 'Home Security', '15000000', '0.07'),
    ('HealthyLiving Foods', 'Organic Food', '13000000', '0.09'),
    ('TechSavvy Solutions', 'IT Services', '24000000', '0.18'),
    ('FreshHarvest Produce', 'Agriculture', '11000000', '0.07')";
    $conn->query($newInsertCompanyStatement);
    $insertPrivateStatement = "INSERT INTO PRIVATE_COMPANY (company_id, valuation) VALUES
    ('503', '50000000'),
    ('504', '60000000'),
    ('505', '55000000'),
    ('506', '70000000'),
    ('507', '40000000'),
    ('508', '75000000'),
    ('509', '35000000'),
    ('510', '50000000'),
    ('511', '45000000'),
    ('512', '65000000'),
    ('513', '55000000'),
    ('514', '42000000'),
    ('515', '68000000'),
    ('516', '48000000'),
    ('517', '55000000'),
    ('518', '60000000'),
    ('519', '50000000'),
    ('520', '72000000'),
    ('521', '45000000'),
    ('522', '40000000'),
    ('523', '80000000'),
    ('524', '65000000'),
    ('525', '35000000'),
    ('526', '50000000'),
    ('527', '55000000'),
    ('528', '70000000'),
    ('529', '45000000'),
    ('530', '42000000'),
    ('531', '68000000'),
    ('532', '33000000')";
    $conn->query($insertPrivateStatement);
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
    market_price decimal(8,2) NOT NULL,
    PRIMARY KEY (company_id),
    FOREIGN KEY (company_id) REFERENCES COMPANY(company_id));";
    $resultForPublicCompany = $conn->query($sqlToCreatePublicCompany);

    $sqlToCreateUsers = "CREATE TABLE USERS (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (email),
    PRIMARY KEY (id));";
    $resultForUsers = $conn->query($sqlToCreateUsers);

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
	sentiment ENUM('Bullish', 'Bearish'), 
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