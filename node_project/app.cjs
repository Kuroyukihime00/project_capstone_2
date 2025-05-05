const http = require("http");
const fs = require("fs");
const path = require("path");
const url = require("url");

const mimeTypes = {
    ".html": "text/html; charset=utf-8",
    ".css": "text/css",
    ".js": "application/javascript",
    ".json": "application/json",
    ".png": "image/png",
    ".jpg": "image/jpeg",
    ".jpeg": "image/jpeg",
    ".ico": "image/x-icon",
};

const server = http.createServer((req, res) => {
    const parsedUrl = url.parse(req.url);
    let pathname = `.${parsedUrl.pathname}`;
    const ext = path.extname(pathname).toLowerCase();

    // Default: tampilkan halaman utama
    if (pathname === "./") {
        pathname = "./views/index.html";
    }

    // Cegah akses folder di luar root (security)
    const safePath = path.normalize(path.join(__dirname, pathname));
    if (!safePath.startsWith(__dirname)) {
        res.writeHead(403);
        return res.end("Access denied");
    }

    // Deteksi tipe file berdasarkan ekstensi
    const contentType = mimeTypes[ext] || "application/octet-stream";

    // Baca file
    fs.readFile(safePath, (err, data) => {
        if (err) {
            res.writeHead(404, { "Content-Type": "text/plain" });
            res.end("File Not Found");
        } else {
            res.writeHead(200, { "Content-Type": contentType });
            res.end(data);
        }
    });
});

server.listen(3000, () => {
    console.log("Server running at http://localhost:3000/");
});
