    // Function to switch between KTP form and manual form
    function toggleForm(formId) {
        var manualButton = document.getElementById('manual-button');
        var manualButtonText = document.getElementById('manual-button-text');
        
        if (formId === 'manual-form') {
            // Menampilkan form manual dan mengubah teks tombol menjadi "Scan KTP"
            document.getElementById('ktp-form').style.display = 'none';
            document.getElementById('manual-form').style.display = 'block';
            manualButtonText.innerText = 'Scan KTP';
            manualButton.setAttribute('onclick', "toggleForm('ktp-form')");
        } else if (formId === 'ktp-form') {
            // Menampilkan form scan KTP dan mengubah teks tombol menjadi "Isi Manual"
            document.getElementById('manual-form').style.display = 'none';
            document.getElementById('ktp-form').style.display = 'block';
            manualButtonText.innerText = 'Isi Manual';
            manualButton.setAttribute('onclick', "toggleForm('manual-form')");
        }
    }
    
    

    // Function to show the progress bar
    function showProgress() {
        document.getElementById('progress-container').style.display = 'block';
        document.getElementById('progress-bar').value = 0; // Reset progress bar value to 0
    }

    // Function to scan the KTP
    function captureAndScan() {
        // alert('Memulai proses capture & scan KTP...');
        showProgress(); // Show the progress bar when scanning starts
    
        const video = document.getElementById('video');
        const frame = document.getElementById('frame');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
    
        canvas.width = frame.offsetWidth;
        canvas.height = frame.offsetHeight;
    
        // Draw the current frame from the video onto the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
    
        // Create an image element to hold the captured image
        const img = new Image();
    
        // Set the source of the image to the data URL representation of the canvas
        img.src = canvas.toDataURL('image/jpeg');
    
        // Set the size and position of the captured image to fit the frame
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.position = 'absolute';
        img.style.top = '0';
        img.style.left = '0';
    
        // Remove any previously captured image
        while (frame.firstChild) {
            frame.removeChild(frame.firstChild);
        }
    
        // Append the captured image to the frame
        frame.appendChild(img);
    
        // Perform OCR on the captured image
        Tesseract.recognize(
            canvas,
            'eng', {
                logger: m => { // Use logger to monitor recognition progress
                    if (m.status === 'recognizing text') {
                        // Update the progress bar value and label as recognition progresses
                        const progress = m.progress * 100;
                        document.getElementById('progress-bar').value = progress;
                        document.getElementById('progress-label').innerText = `${progress.toFixed(2)}%`;
                    }
                }
            }
        ).then(({
            data: {
                text
            }
        }) => {
            const nik = extractNIK(text);
            document.getElementById('no_ktp').value = nik;
            if (nik) {
                document.getElementById('scanned-nik').innerText = nik;
                document.getElementById('nik-container').style.display = 'block';
            } else {
                alert("Tidak dapat memindai NIK dari KTP. Silakan coba lagi atau input NIK secara manual.");
            }
            // Anda dapat menambahkan kode untuk menampilkan atau menyembunyikan input nama di sini sesuai kebutuhan.
        }).catch(error => {
            console.error("Terjadi kesalahan saat memindai KTP: ", error);
            alert("Terjadi kesalahan saat memindai KTP. Silakan coba lagi.");
        });
    }
    

    function startVideo() {
        navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(stream => {
            document.getElementById('video').srcObject = stream;
        })
        .catch(err => {
            console.error("Error accessing camera: " + err);
            alert("Terjadi kesalahan saat mengakses kamera. Silakan periksa izin kamera Anda.");
        });
    }

    // Function to extract NIK from text
    function extractNIK(text) {
        const nikPattern = /\b\d{16}\b/; // Pattern to find 16-digit numbers
        const match = text.match(nikPattern);
        return match ? match[0] : '';
    }

    

    window.onload = startVideo;
