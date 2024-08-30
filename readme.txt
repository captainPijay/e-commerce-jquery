Untuk poin nomor 3 saya bingung mau diterapkan di laravel nya atau hanay membuat query saja jika di sql maka seperti ini:

SELECT SUM(oi.quantity * oi.price) AS total_rupiah FROM order_items oi JOIN orders o ON oi.order_id = o.id WHERE DATE(o.created_at) = CURDATE();
