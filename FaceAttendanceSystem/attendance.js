const video = document.getElementById("video");
const statusText = document.getElementById("status");

async function loadModels(){
    await faceapi.nets.ssdMobilenetv1.loadFromUri("models");
    await faceapi.nets.faceLandmark68Net.loadFromUri("models");
    await faceapi.nets.faceRecognitionNet.loadFromUri("models");
}

async function startCamera(){
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    video.srcObject = stream;
}

loadModels().then(startCamera);

video.addEventListener("play", async () => {

    setInterval(async () => {

        const detection = await faceapi
            .detectSingleFace(video)
            .withFaceLandmarks()
            .withFaceDescriptor();

        if(!detection){
            statusText.innerHTML = "No Face Detected ❌";
            statusText.style.color = "red";
            return;
        }

        // Fetch all saved students from database
        fetch("get_students.php")
        .then(res => res.json())
        .then(data => {

            let matchFound = false;

            data.forEach(student => {

                const savedDescriptor = new Float32Array(
                    JSON.parse(student.descriptor)
                );

                const distance = faceapi.euclideanDistance(
                    detection.descriptor,
                    savedDescriptor
                );

                if(distance < 0.5){
                    matchFound = true;
                    statusText.innerHTML = "Attendance Marked for " + student.name + " ✅";
                    statusText.style.color = "green";

                    // Call attendance save
                    fetch("save_attendance.php", {
                        method: "POST",
                        headers: {"Content-Type":"application/json"},
                        body: JSON.stringify({ student_id: student.id })
                    });
                }

            });

            if(!matchFound){
                statusText.innerHTML = "Unknown Face ❌";
                statusText.style.color = "red";
            }

        });

    }, 3000);

});