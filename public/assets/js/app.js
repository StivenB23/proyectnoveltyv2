// Scanner
let buttonScanner = document.getElementById("buttonScann");
buttonScanner?.addEventListener("click", () => {
    const html5QrCode = new Html5Qrcode("reader");
    const qrCodeSuccessCallback = (result, objetoresult) => {
        document.getElementById("inputCodeComputer").value = result;
        html5QrCode.stop();
    };
    html5QrCode.start({ facingMode: "user", facingMode: "environment" },
        {
            fps: 10,    // Optional, frame per seconds for qr code scanning
            qrbox: { width: 350, height: 350 }  // Optional, if you want bounded box UI
        }, qrCodeSuccessCallback);
})
// Image preview
let inputFile = document.getElementById("file-ip-1");
let preview = document.getElementById("content-image");
function createPreview(element) {
    let src = URL.createObjectURL(element);
    console.log(src);
    img = document.createElement('img');
    img.src = src;
    preview.appendChild(img);
}
function showPreview(e) {
    // console.log(e);
    if (e.target.files.length > 0) {
        console.log(e.target.files);
        let element;
        let files = e.target.files;
        for (let index = 0; index < files.length; index++) {
            element = files[index];
            createPreview(element);
        }

    }
}
inputFile?.addEventListener("change", (e) => {
    showPreview(e);
    // console.log(this.files)
});

// Datatable
let table = document.getElementById('myTable');
if (typeof (table) != null) {
    let dataTable = new DataTable(table, {
        labels: {
            placeholder: "Buscar...",
            perPage: "Mostrar {select} por página",
            noRows: "No hay datos para mostrar",
            info: "Mostrando de {start} a {end} de {rows} ",
        }
    });
}