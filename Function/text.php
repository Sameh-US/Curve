<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php 
if (isset($_GET['submit'])) {
    $text = $_GET['text'];
    echo $text;
}

?>

    <button id="myButton">اضغط هنا</button>
    <div id="result"></div>

    <script>
        function clickAjax() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("result").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "", true);
            xhttp.send();
        }
    </script>

</body>

</html>