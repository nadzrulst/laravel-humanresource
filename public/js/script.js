document.addEventListener("DOMContentLoaded", function () {
    // Ambil elemen-elemen yang diperlukan dari DOM
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");
    const tableRows = document.querySelectorAll("tbody tr");

    // Buat fungsi untuk memfilter tabel
    function filterTableByDate() {
        // Dapatkan nilai dari input tanggal. Jika kosong, akan menjadi string kosong.
        const startDate = startDateInput.value;
        const endDate = endDateInput.value;

        // Iterasi melalui setiap baris data di tabel
        tableRows.forEach((row) => {
            // Ambil tanggal dari atribut 'data-date' di setiap baris
            const rowDate = row.getAttribute("data-date");

            // Jika tidak ada tanggal di baris, lewati (meskipun seharusnya selalu ada)
            if (!rowDate) {
                return;
            }

            // Atur status awal baris menjadi terlihat
            let isVisible = true;

            // Cek kondisi filter
            // 1. Jika ada tanggal mulai DAN tanggal baris lebih kecil dari tanggal mulai
            if (startDate && rowDate < startDate) {
                isVisible = false;
            }

            // 2. Jika ada tanggal akhir DAN tanggal baris lebih besar dari tanggal akhir
            if (endDate && rowDate > endDate) {
                isVisible = false;
            }

            // Tampilkan atau sembunyikan baris berdasarkan hasil pengecekan
            row.style.display = isVisible ? "" : "none";
        });
    }

    // Tambahkan event listener ke kedua input tanggal
    // Setiap kali nilainya berubah, panggil fungsi filter
    startDateInput.addEventListener("change", filterTableByDate);
    endDateInput.addEventListener("change", filterTableByDate);
});
