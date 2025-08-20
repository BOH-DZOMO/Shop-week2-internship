<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="../includes/auth.inc.php" method="post">
        <label for="number">userNum</label><br>
        <input type="text" name="number" id="">
        <input type="submit" name="auto-user" value="generate users"><br>
    </form>
    <form action="../includes/product.inc.php" method="post">
        <label for="number">ProductNum</label><br>
        <input type="text" name="number" id="">
        <input type="submit" name="auto-product" value="generate products"><br>
    </form>
    <br>
    <div class="ui-widget">
        <label for="tags">Tags: </label>
        <input id="tags">
    </div>

</body>

</html>