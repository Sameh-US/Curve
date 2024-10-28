<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CND bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Curves | Forget Password</title>
</head>

<body>

    <div class="container mt-5 mb-5 text-center p-5 bg-light rounded shadow d-flex flex-column align-items-center justify-content-center w-60 h-50 position-absolute top-50 start-50 translate-middle ">
        <h1>Forget Password</h1>
        <form action="./SendPasswordResent.php" method="POST" class="form">
            <label for="email" class="form-label mt-3 "> </label>
            <input type="email" class="form-control w-full " name="email" id="email" placeholder="Email" required maxlength="50">
            <button type="submit" class="btn btn-primary mt-3  ">Submit</button>
        </form>
    </div>


    <!-- cdn bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>