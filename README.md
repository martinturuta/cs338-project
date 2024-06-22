# cs338project

### Overview

This repo contains all the scripts for Group 11's CS338 project. The project focuses on building a stock (equity) exploration application that aids users in stock selection and analysis. Primary features include the ability to query price data for stock tickers, create a shortlist of selected tickers, view a side-by-side comparison of ticker metrics, and display time-series price charts. 

Outlined below is the installation instructions for running the application on your local machine. 

### Prerequisites

We used the same tech stack as described in the Project example on the course homepage. 

As such, this repo uses MySQL for all database logic and PHP for web-based logic (the primary GUI for the user). Thus it assumed that users have the following installed on their local machine:

- PHP 

- MySQL 

### Installation

#### 1. Git Repo

Clone the repository to a dedicated folder using:

```bash
   git clone https://github.com/martinturuta/cs338-project.git
```


#### 2. MySQL
Ensure that MySQL is installed correctly.
After installing MySQL, create a schema name into which you will populate our tables. 

#### 2. PHP

Ensure that PHP is installed correctly. 
After installing PHP, open the file titled setup.php and change the following placeholders in capitals within the lines to your relevant setup (Lines 6-9)
Do the same thing in the file titled getCompanyInfoByParams.php (Lines 41-44):

```php
  	$servername = "127.0.0.1";
	$username = "USERNAME";
	$password = "PASSWORD";
	$dbname = "SCHEMA NAME"
```

Run these two commands in your terminal. Ensure you are in a terminal already in the git folder. Otherwise, specify the absolute path to the setup.php file.  

```bash
   sudo /usr/local/mysql/support-files/mysql.server start
   php setup.php
```










