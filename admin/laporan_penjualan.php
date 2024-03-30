<?php
require('../library/fpdf/fpdf.php'); // Mengimpor file FPDF

include '../config/database.php'; // Mengimpor file konfigurasi database
include 'function/penjualan_function.php'; // Mengimpor file fungsi terkait penjualan

$pdf = new FPDF(); // Membuat objek FPDF

$pdf->AddPage(); // Menambahkan halaman baru pada PDF

$pdf->SetFont('Arial', 'B', 16); // Mengatur font, style, dan ukuran teks
$pdf->Cell(0, 10, 'Laporan Penjualan', 0, 1, 'C'); // Membuat sel pada PDF dengan judul laporan
$pdf->Ln(); // Pindah ke baris berikutnya

$pdf->SetFont('Arial', 'B', 10); // Mengatur font, style, dan ukuran teks
$pdf->Cell(40, 10, 'Order Number', 1, 0, 'C'); // Membuat sel pada PDF dengan header Order Number
$pdf->Cell(40, 10, 'Order Date', 1, 0, 'C'); // Membuat sel pada PDF dengan header Order Date
$pdf->Cell(50, 10, 'Customer', 1, 0, 'C'); // Membuat sel pada PDF dengan header Customer
$pdf->Cell(20, 10, 'Total Item', 1, 0, 'C'); // Membuat sel pada PDF dengan header Total Item
$pdf->Cell(40, 10, 'Total Price', 1, 0, 'C'); // Membuat sel pada PDF dengan header Total Price
$pdf->Ln();  // Pindah ke baris berikutnya

$pdf->SetFont('Arial', '', 8); // Mengatur font, style, dan ukuran teks
$result = $conn->query("SELECT * FROM orders WHERE order_status = 4"); // Mengambil data order dari database

while ($row = $result->fetch_assoc()) {
    $userData = get_user_by_id($row['user_id']); // Mendapatkan data pelanggan berdasarkan ID
    // Menampilkan data order pada PDF
    $pdf->Cell(40, 10, $row['order_number'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['order_date'], 1, 0, 'C');
    $pdf->Cell(50, 10, $userData['name'], 1, 0, 'C');
    $pdf->Cell(20, 10, $row['total_items'], 1, 0, 'C');
    $pdf->Cell(40, 10, $row['total_price'], 1, 0, 'C');
    $pdf->Ln(); // Pindah ke baris berikutnya
}

$pdf->Ln(); // Pindah ke baris berikutnya
$pdf->SetFont('Arial', 'B', 10); // Mengatur font, style, dan ukuran teks

$total_income = get_total_income(); // Mendapatkan total pendapatan
$pdf->Cell(0, 10, 'Total Pendapatan         :        Rp. ' . number_format($total_income['total_income'], 0, '.', '.'), 0, 1, 'L'); // Menampilkan total pendapatan pada PDF
$pdf->Ln(); // Pindah ke baris berikutnya

$pdf->Output(); // Menghasilkan output PDF

$conn->close(); // Menutup koneksi database
?>
