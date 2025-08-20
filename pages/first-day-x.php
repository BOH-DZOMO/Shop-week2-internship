<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/libraries/jquery-ui-1.14.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="../assets/libraries/select2-4.0.13/dist/css/select2.min.css">
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
    <br><br>
    <div>
        <select class="js-data-example-ajax" style="width: 200px;"></select>
    </div>
    <script src="../assets/libraries/jquery-ui-1.14.1.custom/external/jquery/jquery.js"></script>
    <script src="../assets/libraries/jquery-ui-1.14.1.custom/jquery-ui.js"></script>
    <script src="../assets/libraries/select2-4.0.13/dist/js/select2.js"></script>
    <script>
        $("#tags").autocomplete({
            source: "../scripts/autocomplete.php",
            minLength: 3,
            select: function(event, ui) {
                console.log("Selected: " + ui.item.value + " aka " + ui.item.id);
            }
        });

        $('.js-data-example-ajax').select2({
            ajax: {
                url: '../scripts/autocomplete.php',
                dataType: 'json',
            }
        });
    </script>
</body>

</html>