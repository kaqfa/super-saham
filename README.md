## Aplikasi Super Saham dengan Laravel

### Daily Price Saham

Update, ngga jadi pake **scheb/yahoo-finance-api** karena banyak kekurangan.

Akhirnya sekarang kita menggunakan flask sebagai proxy mengambil data di YahoooFinance, karena library di Python tentang saham jauh lebih lengkap daripada yang di PHP.

Kali ini kita tidak membuat model dulu, karena banyak data yang bisa dicontohkan. Langsung cek aja proof of concept kodingan di `Controllers/PrSahamController.php`. Di situ datanya langsung ditampilkan.

Pengambilan data yang dicontohkan di situ ada 4 yaitu melalui endpoint `cash`, `price`, `summary`, dan `profile`. Selain itu seharusnya masih ada endpoint lagi yaitu: `financial`, `balance`, `income`, dan `valuation`. Apa aja isinya, silahkan dicek sendiri menggunakan Insomnia / Postman.