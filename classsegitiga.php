<?php
class Segitiga {
    private float $alas;
    private float $tinggi;
    private float $sisi1;
    private float $sisi2;
    private float $sisi3;

    public function __construct(float $alas, float $tinggi, float $s1, float $s2, float $s3) {
        $this->alas = $alas;
        $this->tinggi = $tinggi;
        $this->sisi1 = $s1;
        $this->sisi2 = $s2;
        $this->sisi3 = $s3;
    }

    public function hitungLuas(): float {
        return 0.5 * $this->alas * $this->tinggi;
    }

    public function hitungKeliling(): float {
        return $this->sisi1 + $this->sisi2 + $this->sisi3;
    }

    public function cekJenis(): string {
        if ($this->sisi1 == $this->sisi2 && $this->sisi2 == $this->sisi3) {
            return "Sama Sisi";
        } elseif ($this->sisi1 == $this->sisi2 || $this->sisi2 == $this->sisi3 || $this->sisi1 == $this->sisi3) {
            return "Sama Kaki";
        } else {
            return "Sembarang";
        }
    }

    public function tampilkanInfo(): string {
        $info = "===== INFORMASI SEGITIGA ======\n";
        $info .= "Alas : {$this->alas}\n";
        $info .= "Tinggi : {$this->tinggi}\n";
        $info .= "Sisi : {$this->sisi1}, {$this->sisi2}, {$this->sisi3}\n";
        $info .= "Luas : " . $this->hitungLuas() . "\n";
        $info .= "Keliling : " . $this->hitungKeliling() . "\n";
        $info .= "Jenis : " . $this->cekJenis() . "\n";
        $info .= "===============================\n";
        return $info;
    }
}
?>