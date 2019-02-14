<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body>
    <div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
        </script>
        <button onclick="insertJson()">Запрос на вставку</button>
        <button onclick="deleteRecord()">Запрос на удаление</button>



        <script>
        function deleteRecord() {
            $.ajax({
                url: "deleteSQL.php",
                type: "POST",
                success: function(res) {
                    alert(res);
                }
            });
        }

        function insertJson() {
            var data = {
                "mail": "common@gmail.com",
                "act": "Ш0000000021",
                "contact_person": "Петров Пётр Петрович",
                "phone_num": "9022756507",
            };

            var jsonStr = JSON.stringify(data);

            $.ajax({
                url: "insertSQL.php",
                type: "POST",
                data: {
                    myJson: jsonStr
                },
                success: function(res) {
                    alert(res);
                }
            });
        }
        </script>
    </div>
</body>

</html>