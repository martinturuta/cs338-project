<!DOCTYPE html>
<html>
<body>
<div style="margin-top: 30px; margin-bottom: 30px;">
    <a href="index.php" style="text-decoration: none; padding: 10px 20px; background-color: #007bff; color: white; border-radius: 5px;">Back</a>
</div>
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