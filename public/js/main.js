document.addEventListener("DOMContentLoaded", () => {
    window.onload = function () {
      document.getElementById("carga").style.display = "none";
    };
    document.getElementById("ver").addEventListener("click", () => {
        document.getElementById("carga").style.display = "flex";
        document.getElementById("carga").style.position = "absolute";
    });
    
});
