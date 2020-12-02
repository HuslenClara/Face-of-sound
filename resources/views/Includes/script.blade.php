<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>
    function startTimer(duration) {
        
    var i = 0;
    var timer = duration, minutes, seconds;
    
    progress = document.getElementById("progress-bar");
    loading = document.getElementById('loading');
    
    interval = setInterval(function () { 
        i = i+1;
        
        console.log(i);
        if (i > duration) {
            clearInterval(interval);
        }
        
        progress.value = i*100/duration;
        d = parseInt(i*100/duration);
        if(d>=100){
            loading.innerHTML = 100+'%';
        }else{
            loading.innerHTML = d+'%';
        }
        
    }, 1000);
}

    function blobToFile(theBlob, fileName){
    //A Blob() is almost a File() - it's just missing the two properties below which we will add
    theBlob.lastModifiedDate = new Date();
    theBlob.name = fileName;
    return theBlob;
    }

    let constraintObj = { 
        audio: true, 
            video: false
        }; 
        //handle older browsers that might implement getUserMedia in some way
        if (navigator.mediaDevices === undefined) {
            navigator.mediaDevices = {};
            navigator.mediaDevices.getUserMedia = function(constraintObj) {
                let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
                if (!getUserMedia) {
                    return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
                }
                return new Promise(function(resolve, reject) {
                    getUserMedia.call(navigator, constraintObj, resolve, reject);
                });
            }
        }else{
            navigator.mediaDevices.enumerateDevices()
            .then(devices => {
                devices.forEach(device=>{
                    console.log(device.kind.toUpperCase(), device.label);
                    //, device.deviceId
                })
            })
            .catch(err=>{
                console.log(err.name, err.message);
            })
        }

        navigator.mediaDevices.getUserMedia(constraintObj)
        .then(function(mediaStreamObj) {
            //connect the media stream to the first audio element
            let audio = document.querySelector('audio');

            if ("srcObject" in audio) {
                audio.srcObject = mediaStreamObj;
            } else {
                //old version
                audio.src = window.URL.createObjectURL(mediaStreamObj);
            }
            
            /*audio.onloadedmetadata = function(ev) {
                //show in the audio element what is being captured by the webcam
                audio.play();
            };*/
            
            //add listeners for saving audio/audio
            let start = document.getElementById('btnStart');
            let stop = document.getElementById('btnStop');
            let colstart = document.getElementById('colbtnStart');
            let audSave = document.getElementById('aud2');
            let audInput = document.getElementById('audio-input');

            //get parents file path not from audio tag
            
            let mediaRecorder = new MediaRecorder(mediaStreamObj);
            let chunks = [];
            let col = false; 

            start.addEventListener('click', (ev)=>{
                mediaRecorder.start();
                console.log(mediaRecorder.state);
            })
            colstart.addEventListener('click', (ev)=>{
                
                setTimeout(function(){
                    
                mediaRecorder.start();
                }, 200);
                console.log(mediaRecorder.state);
                col = true;
                parentAud.play();
                console.log("collab is true");
            })
            stop.addEventListener('click', (ev)=>{
                mediaRecorder.stop();
                //console.log(mediaRecorder.state);
            });
            mediaRecorder.ondataavailable = function(ev) {
                chunks.push(ev.data);
            }
            mediaRecorder.onstop = (ev)=>{
                
                let blob = new Blob(chunks, { 'type' : 'audio/mp3; codecs=0' });
                chunks = [];
                let audioURL = window.URL.createObjectURL(blob);
                if(col){
                    
            let parentAud = document.getElementById('parentAud');
            let parentAudID = document.getElementById('parentAudID');
        
                    parentAud.pause()
                duration = parentAud.duration*1000;
                console.log(duration);
                    console.log(parentAudID.innerHTML);
                    collab(audioURL, parentAud.src,duration);
                    startTimer(duration/1000);
                }
                else if(col == false)
                {
                    audSave.src = audioURL;
                    console.log(blob);
                    const dT = new ClipboardEvent('').clipboardData || // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                    new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
                    dT.items.add(new File([blob], 'audio.mp3', { 'type' : 'audio/mp3;' }));

                    audInput.files = dT.files;
                    

                    console.log("audio added to form succesfully!");
                }
                


    }
})
        .catch(function(err) { 
            console.log(err.name, err.message); 
        });
        

        /*********************************
        getUserMedia returns a Promise
        resolve - returns a MediaStream Object
        reject returns one of the following errors
        AbortError - generic unknown cause
        NotAllowedError (SecurityError) - user rejected permissions
        NotFoundError - missing media track
        NotReadableError - user permissions given but hardware/OS error
        OverconstrainedError - constraint audio settings preventing
        TypeError - audio: false, audio: false
        *********************************/
    </script>