<?php
session_start();

if (isset($_POST['operator'])) {
    $angka1 = str_replace([','], ['.'], $_POST['angka1']);
    $angka2 = str_replace([','], ['.'], $_POST['angka2']);
    $operator = $_POST['operator'];

    if (!is_numeric($angka1) || !is_numeric($angka2)) {
        echo "<script>alert('Input harus berupa angka')</script>";
    } elseif ($operator == '/' && $angka2 == 0) {
        echo "<script>alert('Tidak dapat membagi dengan Nol')</script>";
    } else {
        switch ($operator) {
            case '+':
                $hasil = $angka1 + $angka2;
                break;
            case '-':
                $hasil = $angka1 - $angka2;
                break;
            case '*':
                $hasil = $angka1 * $angka2;
                break;
            case '/':
                $hasil = $angka1 / $angka2;
                break;
            default:
                echo "Operator tidak valid";
                break;
        }
        $formatted_hasil = (floor($hasil) == $hasil) ? number_format($hasil, 0, ',', '.') : rtrim(rtrim(number_format($hasil, 5, ',', '.'), '0'), ',');
    }
}

if (isset($_POST['hasil'])) {
    $_SESSION['memory'] = $_POST['hasil'];
}

if (isset($_POST['resethasil'])) {
    unset($_SESSION['memory']);
}
$angka1_value = isset($_SESSION['memory']) ? $_SESSION['memory'] : "";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Sederhana | UKK RPL 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            text-align: center;
            margin-top: 30px;
        }
        .logo {
            width: 100px;
            display: block;
            margin: 0 auto 10px;
        }
        h2 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #e6e8e9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 350px;
            margin: 0 auto 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #dbdbdb;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
        }
        .d-flex button {
            width: 50px;
            height: 50px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
            border: none;
        }
        .btn-primary {
            background-color: #007bff;
            width: 100px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545;
            width: 100px;
            font-weight: bold;
        }
        .btn-danger:hover {
            background-color: #bd2130;
        }
        p {
            font-size: 12px;
            text-align: center;
            margin-top: 20px;
            color: rgb(0, 0, 0);
        }
           
    </style>
</head>
<body>
    <div class="container mt-5">
        <img src="images/logo1.png.jpeg" alt="logo kalkulator" class="logo">
        <h2 class="text-center">Kalkulator Sederhana</h2>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="POST" class="p-2 border rounded bg-light">
                    <label class="form-label">Angka Pertama</label>
                    <input type="text" name="angka1" class="form-control" required pattern="[-]?[0-9.,]+" placeholder="Tambahkan angka" value="<?= $angka1_value ?>">
                    <label class="form-label">Angka Kedua</label>
                    <input type="text" name="angka2" class="form-control" required pattern="[-]?[0-9.,]+" placeholder="Tambahkan angka">
                    <div class="d-flex justify-content-center gap-2 mt-2">
                        <button type="submit" class="btn btn-primary" name="operator" value="+">+</button>
                        <button type="submit" class="btn btn-danger" name="operator" value="-">-</button>
                        <button type="submit" class="btn btn-success" name="operator" value="*">x</button>
                        <button type="submit" class="btn btn-info" name="operator" value="/">&divide;</button>
                        <button type="reset" class="btn btn-warning">CE</button>
                    </div>
                </form>
                <div class="p-2 border rounded bg-light">
                    <h4 class="text-center">
                        <?= isset($formatted_hasil) ? "$angka1 $operator $angka2 = $formatted_hasil" : "Hasil : " ?>
                    </h4>
                    <div class="row">
                        <div class="col-6">
                            <form method="POST">
                                <input type="hidden" name="hasil" value="<?= isset($hasil) ? $hasil : '' ?>">
                                <button type="submit" class="btn btn-primary">ME</button>
                            </form>
                        </div>
                        <div class="col-6">
                            <form method="POST">
                                <button type="submit" name="resethasil" class="btn btn-danger">MC</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center mt-3">&copy; UKK PPLG 2025 | Ropita Fitri Ayuning | PPLG</p>
</body>
</html>