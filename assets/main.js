function submit_upload() {
    var inputFile = document.getElementById('filesField');
    if (inputFile.files.length > 0 && inputFile.files.length <= 5) {
        document.getElementById('uploadForm').submit();
    } else{
        alert('За раз можно загружать от 1 до 5 файлов!');
    }
}

