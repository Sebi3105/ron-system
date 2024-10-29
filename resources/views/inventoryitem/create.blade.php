<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Insert </h1>
    <form method = "post" action="">
    <div class = "productid_dropdown">
         <select name="productid_id" id="productid_id">
       <!-- backend retrieval on sql -->
         <option value="default" selected>Product ID</option>
         </select>
    </div>
    <div class = "serial_number">
        <label>Serial Number</label>
        <input type = "text" name = "serial_number" placeholder="Serial Number">
    </div>
    <div class = "condition">
        <select name="condition" id="condition">
            <option value="option1">Working</option>
            <option value="option2">Defective</option>
         </select>
    </div>
    <div class = "submit">
        <input type = "submit" value = "Save Serial Number">
    </div>
    
  <!-- ... -->
</select>


    </form>
</body>
</html>