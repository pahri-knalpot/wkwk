<?php

/**
 * Model: Produk — query tabel `produk`.
 */
class Produk extends Model
{
    /** Ambil semua produk (katalog publik). */
    public function semua(): array
    {
        return $this->db->query("SELECT * FROM produk ORDER BY id DESC")->fetchAll();
    }

    /** Ambil produk unggulan (TOP LIST) untuk home. */
    public function topList(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM produk WHERE is_toplist = 1 ORDER BY id ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /** Ambil satu produk berdasarkan id. */
    public function cariById(int $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM produk WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    /* ============ KHUSUS PENJUAL ============ */

    /** Ambil semua produk milik satu penjual. */
    public function milikPenjual(int $penjualId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM produk WHERE penjual_id = :pid ORDER BY id DESC"
        );
        $stmt->execute([':pid' => $penjualId]);
        return $stmt->fetchAll();
    }

    /** Ambil satu produk HANYA jika milik penjual tsb (untuk edit/hapus aman). */
    public function cariMilik(int $id, int $penjualId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM produk WHERE id = :id AND penjual_id = :pid"
        );
        $stmt->execute([':id' => $id, ':pid' => $penjualId]);
        return $stmt->fetch();
    }

    /** Tambah produk baru milik penjual. */
    public function tambah(array $data, int $penjualId): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO produk (nama, deskripsi, harga, gambar, penjual_id)
             VALUES (:nama, :deskripsi, :harga, :gambar, :pid)"
        );
        return $stmt->execute([
            ':nama'      => $data['nama'],
            ':deskripsi' => $data['deskripsi'],
            ':harga'     => $data['harga'],
            ':gambar'    => $data['gambar'],
            ':pid'       => $penjualId,
        ]);
    }

    /** Update produk milik penjual. Jika $gambar null, gambar lama dipertahankan. */
    public function ubah(int $id, array $data, int $penjualId, ?string $gambar = null): bool
    {
        if ($gambar !== null) {
            $sql = "UPDATE produk
                    SET nama = :nama, deskripsi = :deskripsi, harga = :harga, gambar = :gambar
                    WHERE id = :id AND penjual_id = :pid";
            $params = [
                ':nama' => $data['nama'], ':deskripsi' => $data['deskripsi'],
                ':harga' => $data['harga'], ':gambar' => $gambar,
                ':id' => $id, ':pid' => $penjualId,
            ];
        } else {
            $sql = "UPDATE produk
                    SET nama = :nama, deskripsi = :deskripsi, harga = :harga
                    WHERE id = :id AND penjual_id = :pid";
            $params = [
                ':nama' => $data['nama'], ':deskripsi' => $data['deskripsi'],
                ':harga' => $data['harga'],
                ':id' => $id, ':pid' => $penjualId,
            ];
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /** Hapus produk milik penjual. */
    public function hapus(int $id, int $penjualId): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM produk WHERE id = :id AND penjual_id = :pid"
        );
        return $stmt->execute([':id' => $id, ':pid' => $penjualId]);
    }
}
