<!DOCTYPE html>
<html>
<body>

<form action="viewspecificshortlists.php" method="POST">
Company Name: <input autocomplete="off" type="text" name="company_name"><br>
Sector: <input autocomplete="off" type="text" name="sector"><br>
EBITDA:
<input autocomplete="off" type="radio" name="ebitda_radio" value=">">>
<input autocomplete="off" type="radio" name="ebitda_radio" value="<"><
<input autocomplete="off" type="radio" name="ebitda_radio" value="=">= <input autocomplete="off" type="text" name="ebitda"><br>
Revenue Growth:
<input autocomplete="off" type="radio" name="rev_radio" value=">">>
<input autocomplete="off" type="radio" name="rev_radio" value="<"><
<input autocomplete="off" type="radio" name="rev_radio" value="=">= <input type="text" name="rev_growth"><br>
<input type="submit">
</form>

</body>
</html>