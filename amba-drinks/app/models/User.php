<?php

/**
 * Model: User — query tabel `users` (registrasi & login).
 */
class User extends Model
{
    /** Cari user berdasarkan email. */
    public function cariByEmail(string $email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /** Cek apakah email sudah terdaftar. */
    public function emailSudahAda(string $email): bool
    {
        return $this->cariByEmail($email) !== false;
    }

    /** Simpan user baru dengan role (password sudah di-hash di Controller). */
    public function buat(string $nama, string $email, string $passwordHash, string $role = 'pembeli'): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (nama, email, password, role)
             VALUES (:nama, :email, :password, :role)"
        );

        return $stmt->execute([
            ':nama'     => $nama,
            ':email'    => $email,
            ':password' => $passwordHash,
            ':role'     => $role,
        ]);
    }
}
