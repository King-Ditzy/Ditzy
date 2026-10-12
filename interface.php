<?php

interface SaluranNotifikasi 
{
    public function kirim(string $tujuan, string $pesan): void;
}

class NotifikasiEmail implements SaluranNotifikasi 
{
    public function kirim(string $tujuan, string $pesan): void 
    {
        echo "Mengirim Email ke " . $tujuan . " dengan pesan: " . $pesan . "\n";
    }
}

class NotifikasiWhatsApp implements SaluranNotifikasi 
{
    public function kirim(string $tujuan, string $pesan): void 
    {
        echo "Mengirim WhatsApp ke " . $tujuan . " dengan pesan: " . $pesan . "\n";
    }
}

class NotifikasiSms implements SaluranNotifikasi 
{
    public function kirim(string $tujuan, string $pesan): void 
    {
        echo "Mengirim SMS ke " . $tujuan . " dengan pesan: " . $pesan . "\n";
    }
}

class Aplikasi 
{
    public function prosesKirim(SaluranNotifikasi $saluran, string $tujuan, string $pesan): void 
    {
        $saluran->kirim($tujuan, $pesan);
    }
}

$app = new Aplikasi();

$email = new NotifikasiEmail();
$wa = new NotifikasiWhatsApp();
$sms = new NotifikasiSms();

$pesanEmail = "Laporan tagihan bulan ini telah dilampirkan. Terima kasih.";
$pesanWa = "Halo! Pesanan Anda dengan nomor #12345 sedang diproses.";
$pesanSms = "Kode OTP Anda adalah 883921. Jangan berikan kepada siapapun.";

$app->prosesKirim($email, "user@email.com", $pesanEmail);
$app->prosesKirim($wa, "08123456789", $pesanWa);
$app->prosesKirim($sms, "08987654321", $pesanSms);

?>
