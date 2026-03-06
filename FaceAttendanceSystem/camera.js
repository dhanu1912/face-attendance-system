const video = document.getElementById('video');

// Load Models
Promise.all([
faceapi.nets.ssdMobilenetv1.loadFromUri('models'),
faceapi.nets.faceRecognitionNet.loadFromUri('models'),
faceapi.nets.faceLandmark68Net.loadFromUri('models'),
faceapi.nets.faceExpressionNet.loadFromUri('models'),
faceapi.nets.ageGenderNet.loadFromUri('models')
]).then(startVideo);

// Start Camera
function startVideo(){
  navigator.mediaDevices.getUserMedia({ video:{} })
  .then(stream => video.srcObject = stream)
  .catch(err => console.error(err));
}

let marked = {};

video.addEventListener('play', async () => {

  const labeledDescriptors = await loadLabeledImages();

  const faceMatcher = new faceapi.FaceMatcher(
    labeledDescriptors,
    0.5
  );

  const canvas = faceapi.createCanvasFromMedia(video);
  document.querySelector(".camera-box").append(canvas);

  const displaySize = {
    width: video.offsetWidth,
    height: video.offsetHeight
  };

  faceapi.matchDimensions(canvas, displaySize);

  setInterval(async () => {

    if(video.paused || video.ended) return;

    const detections = await faceapi.detectAllFaces(
      video,
      new faceapi.SsdMobilenetv1Options({ minConfidence:0.5 })
    )
    .withFaceLandmarks()
    .withFaceDescriptors()
    .withFaceExpressions()
    .withAgeAndGender();

    const resizedDetections = faceapi.resizeResults(
      detections,
      displaySize
    );

    const ctx = canvas.getContext('2d');
    ctx.clearRect(0,0,canvas.width,canvas.height);

    const results = resizedDetections.map(d =>
      faceMatcher.findBestMatch(d.descriptor)
    );

    results.forEach((result,i)=>{

      const box = resizedDetections[i].detection.box;

      const gender = resizedDetections[i].gender;

      const expressions =
      resizedDetections[i].expressions.asSortedArray();

      const mood = expressions[0].expression;
      const moodProb = expressions[0].probability.toFixed(2);

      const label =
      `${result.toString()} | ${gender} | ${mood} ${moodProb}`;

      new faceapi.draw.DrawBox(box,{label}).draw(canvas);

      if(result.label !== "unknown"){
        markAttendance(result.label);
      }

    });

  },1000);

});

// Load Student Images
async function loadLabeledImages(){

  const response = await fetch("get_students.php");
  const students = await response.json();

  return Promise.all(students.map(async student => {

    try{

      const img = await faceapi.fetchImage(
        `uploads/${student.enrollmentno}.jpg`
      );

      const detection = await faceapi.detectSingleFace(img)
      .withFaceLandmarks()
      .withFaceDescriptor();

      if(!detection){
        return new faceapi.LabeledFaceDescriptors(
          student.enrollmentno,
          []
        );
      }

      return new faceapi.LabeledFaceDescriptors(
        student.enrollmentno,
        [detection.descriptor]
      );

    }catch(e){

      return new faceapi.LabeledFaceDescriptors(
        student.enrollmentno,
        []
      );

    }

  }));

}

// Attendance Mark
function markAttendance(enrollmentno){

  const today = new Date().toISOString().split('T')[0];
  const key = enrollmentno + today;

  if(marked[key]) return;

  fetch("save_student.php",{
    method:"POST",
    headers:{
      "Content-Type":"application/x-www-form-urlencoded"
    },
    body:"enrollmentno="+enrollmentno
  })
  .then(res => res.text())
.then(data=>{
console.log(data);
console.log("Attendance marked "+enrollmentno);
marked[key]=true;
})
  .catch(err=>console.error(err));

}