# Tugas Praktikum DPBO #10

Dibuat untuk menyelesaikan TP10 Desain Pemrograman Berorientasi Objek (DPBO)

## Janji

Saya Willsoon Tulus Parluhutan Simanjuntak dengan NIM 2404756 mengerjakan evaluasi Tugas Praktikum 10 dalam mata kuliah Desain Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. 

Aamiin.

## Desain program

Program ini merupakan program CRUD berbasis antarmuka web dengan arsitektur Model-View-ViewModel (MVVM) berbasis PHP dengan sistem basis data PHP Data Objects untuk mengelola data-data yang merupakan tema "Gaming Hangout".

Tiap tabel data memiliki Model, View, dan ViewModel masing-masing, terutama untuk interaksi CRUD secara individual. Semua interaksi dengan model maupun view terjadi melalui ViewModel.

### Deskripsi desain basis data:

- Tabel `genre` menampung data genre yang berupa ID, nama, dan rekomendasi_usia (rekomendasi rentang usia pemain).

- Tabel `game` menampung data game yang berupa ID, nama, genre_id, platform, dan tahun rilis. Untuk atribut `genre_id` merupakan foreign key dengan atribut `id` dari tabel `genre`.

- Tabel `pemain` menampung data pemain yang berupa ID, nama, asal_daerah, genre_favorit, game_favorit, dan jumlah_menang. Untuk atribut ID `genre_favorit` merupakan foreign key dengan atribut `id` dari tabel `genre`, begitu juga dengan atribut ID `game_favorit` yang merupakan foreign key dengan atribut `id` dari tabel `game`.

- Tabel `event` menampung data event/acara yang berupa ID, nama, id_pemimpin, id_game, dan tanggal event. Untuk atribut ID `id_pemimpin` merupakan foreign key dengan atribut `id` dari tabel `pemain`, begitu juga dengan atribut ID `id_game` yang merupakan foreign key dengan atribut `id` dari tabel `game`.

Program ini juga memanfaatkan fungsi JOIN pada database SQL untuk menggabungkan data dari tabel lain dalam satu output tabel, seperti:

- Menampilkan nama genre disamping ID genre dalam tampilan tabel `game`.
- Menampilkan nama genre favorit dan nama game favorit dalam tampilan tabel `pemain`.
- Menampilkan nama pemimpin dan nama game yang dimainkan dalam tampilan tabel `event`.

## Alur jalan program

Program ini menyediakan antarmuka berupa webpage yang bisa dibuka oleh user (misal: manager gaming lounge / event organizer). Konfigurasi koneksi terhadap database dapat dilakukan dengan mengubah file `Database.php` pada direktori `model`.

Masing-masing tabel telah mendukung CRUD, yaitu membuat data baru, membaca kumpulan data dalam tabel, merubah / memperbaharui data yang ada, serta menghapus data yang ada.

## Preview operasional program

https://github.com/user-attachments/assets/bcb0feda-0f0e-4b55-926f-de877944a030

