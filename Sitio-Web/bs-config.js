module.exports = {
    proxy: "localhost/ProyectoFinalWeb2025/Sitio-Web/public", 
    files: [
        "public/**/*.php",
        "public/**/*.html", 
        "public/output.css",
        "src/**/*.php",
        "src/css/**/*.css",
        "src/scripts/**/*.js"
    ],
    watchOptions: {
        ignoreInitial: true
    },
    open: false,
    notify: false,
    serveStatic: ['.'], 
    baseDir: './', 
    startPath: '/public/index.php'
};