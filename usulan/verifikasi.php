<?php
include_once '../connection.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action    = $_POST['action'] ?? '';
    $usulan_id = intval($_POST['usulan_id'] ?? 0);
    $user_id   = intval($_POST['user_id'] ?? 0);
    $catatan   = mysqli_real_escape_string($con, $_POST['catatan'] ?? '');

    if (!$usulan_id || !$user_id || !$action) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Parameter tidak lengkap'
        ]);
        exit;
    }

    $status = '';
    if ($action === 'terima') {
        $status = 'Diverifikasi';

        // update status usulan
        $q1 = mysqli_query($con, "UPDATE usulan SET status_penetapan = '$status' WHERE usulan_id = $usulan_id");
        if (!$q1) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal update usulan: ' . mysqli_error($con)
            ]);
            exit;
        }

        // insert ke rencana_pembangunan
        $tahun   = date('Y');
        $periode = date('m');
        $q2 = mysqli_query($con, "INSERT INTO rencana_pembangunan(usulan_id, tahun, periode, status_akhir, catatan_admin) 
                                  VALUES($usulan_id, '$tahun', '$periode', 'Diterima', '$catatan')");
        if (!$q2) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal insert rencana_pembangunan: ' . mysqli_error($con)
            ]);
            exit;
        }
    } elseif ($action === 'tolak') {
        $status = 'Ditolak';

        $q3 = mysqli_query($con, "UPDATE usulan SET status_penetapan = '$status' WHERE usulan_id = $usulan_id");
        if (!$q3) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal update usulan: ' . mysqli_error($con)
            ]);
            exit;
        }
    }

    // insert ke verifikasi
    $tanggal = date('Y-m-d');
    $hasil   = ($action === 'terima') ? 'Diterima' : 'Ditolak';

    $query_verifikasi = "INSERT INTO verifikasi(user_id, usulan_id, catatan, hasil, tanggal) 
                         VALUES($user_id, $usulan_id, '$catatan', '$hasil', '$tanggal')";
    $q4 = mysqli_query($con, $query_verifikasi);

    if (!$q4) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal insert verifikasi: ' . mysqli_error($con),
            'sql'     => $query_verifikasi
        ]);
        exit;
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil diverifikasi'
    ]);
    exit;
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);
exit;
