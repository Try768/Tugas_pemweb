
<?php
// Array multidimensi mata kuliah
$matkul = [
    ["nama" => "Algoritma", "sks" => 3, "nilai" => 85],
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 90],
    ["nama" => "Basis Data", "sks" => 3, "nilai" => 75],
    ["nama" => "Matematika", "sks" => 2, "nilai" => 55],
    ["nama" => "Sistem Operasi", "sks" => 3, "nilai" => 65]
];

// Fungsi helper untuk menentukan huruf dan bobot
function hitungBobot($nilai) {
    if ($nilai >= 80) {
        return ["huruf" => "A", "bobot" => 4.0];
    } elseif ($nilai >= 70) {
        return ["huruf" => "B", "bobot" => 3.0];
    } elseif ($nilai >= 60) {
        return ["huruf" => "C", "bobot" => 2.0];
    } elseif ($nilai >= 50) {
        return ["huruf" => "D", "bobot" => 1.0];
    } else {
        return ["huruf" => "E", "bobot" => 0.0];
    }
}

// Variabel untuk menghitung IPS
$totalBobotSKS = 0;
$totalSKS = 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nilai Mata Kuliah</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #ddd;
        }

        .mengulang {
            background-color: #ffcccc;
            color: red;
        }
    </style>
</head>
<body>

<h2>Daftar Nilai Mata Kuliah</h2>

<table>
    <tr>
        <th>No</th>
        <th>Nama Mata Kuliah</th>
        <th>SKS</th>
        <th>Nilai Angka</th>
        <th>Nilai Huruf</th>
        <th>Bobot</th>
        <th>Status</th>
    </tr>

    <?php foreach ($matkul as $i => $m):
        $hasil = hitungBobot($m["nilai"]);

        $status = $hasil["bobot"] >= 2.0
            ? "LULUS"
            : "MENGULANG";

        $totalSKS += $m["sks"];
        $totalBobotSKS += $m["sks"] * $hasil["bobot"];
    ?>
        <tr class="<?= $status == 'MENGULANG' ? 'mengulang' : '' ?>">
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($m["nama"]) ?></td>
            <td><?= $m["sks"] ?></td>
            <td><?= $m["nilai"] ?></td>
            <td><?= $hasil["huruf"] ?></td>
            <td><?= number_format($hasil["bobot"], 1) ?></td>
            <td><?= $status ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// Menghitung IPS
$ips = $totalSKS > 0
    ? $totalBobotSKS / $totalSKS
    : 0;

// Batas SKS semester depan
$batasSKS = $ips >= 3.00 ? 24 : 20;
?>

<h2>Ringkasan IPS</h2>

<p>Total SKS: <?= $totalSKS ?></p>

<p>Total Bobot x SKS:
    <?= number_format($totalBobotSKS, 2) ?>
</p>

<p>IPS:
    <strong><?= number_format($ips, 2) ?></strong>
</p>

<p>Batas maksimal SKS semester depan:
    <strong><?= $batasSKS ?> SKS</strong>
</p>

</body>
</html>
