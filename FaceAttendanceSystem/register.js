// Load Models
async function loadModels(){
    await faceapi.nets.ssdMobilenetv1.loadFromUri("models");
    await faceapi.nets.faceLandmark68Net.loadFromUri("models");
    await faceapi.nets.faceRecognitionNet.loadFromUri("models");
    console.log("Models Loaded Successfully");
}

loadModels();


// Register Student Function
async function registerStudent(){

    const name = document.getElementById("name").value.trim();
    const fileInput = document.getElementById("imageUpload");

    if(name === "" || fileInput.files.length === 0){
        alert("Please enter name and select image");
        return;
    }

    const image = await faceapi.bufferToImage(fileInput.files[0]);

    const detection = await faceapi
        .detectSingleFace(image)
        .withFaceLandmarks()
        .withFaceDescriptor();

    if(!detection){
        alert("No face detected! Please upload clear image.");
        return;
    }

    const descriptor = Array.from(detection.descriptor);

    fetch("save_student.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
            name: name,
            descriptor: descriptor
        })
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        document.getElementById("name").value = "";
        fileInput.value = "";
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong");
    });
}