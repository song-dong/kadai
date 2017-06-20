<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button><a class="navbar-brand" href="a_select.php">Administration</a></button>
                </div>
            </div>
        </nav>
        <h1>REGISTRATION</h1>
    </header>

    <div class="main">
        <form id="regist" method="post" action="a_insert.php">
            <h2>Registration Form</h2>
            <fieldset>
                <input type="text" placeholder="Name" name="name" required>
            </fieldset>
            <fieldset>
                <input style="font-family:tahoma;" type="text" placeholder="Login ID" name="lid" required>
            </fieldset>
            <fieldset>
                <input style="width:100%; border:1px solid #CCC; background:#FFF; margin:0 0 5px; padding:10px;" type="password" placeholder="Login Password" name="lpw" required>
            </fieldset>
            <fieldset>
                <input type="radio" name="kanri_flg" value="0">　User
                <input type="radio" name="kanri_flg" value="1">　Administrator
            </fieldset>
            <fieldset>
                <input type="radio" name="life_flg" value="0">　Active
                <input type="radio" name="life_flg" value="1">　Inactive
            </fieldset>
            <fieldset>
                <input type="submit" value="SUBMIT">
            </fieldset>
        </form>
    </div>


</body>

</html>
