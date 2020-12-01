<script type="text/javascript">

	var description = "collab";
	var context;
	var recorder;
	var div = document.querySelector("div");
	var duration = 30000;
	var chunks = [];
	var audio = new AudioContext();
	var mixedAudio = audio.createMediaStreamDestination();
	var player = new Audio();

    
	player.controls = "controls";
	

	function get(src) {
		return fetch(src)
		.then(function(response) {
			return response.arrayBuffer()
		})
	}

	function stopMix(duration, ...media) {
		setTimeout(function(media) {
			media.forEach(function(node) {
				node.stop()
			})
		}, duration, media)
	}
function collab(aud1, aud2,dur){
	var sources = [aud1, aud2];
	Promise.all(sources.map(get)).then(function(data) {
		var len = Math.max.apply(Math, data.map(function(buffer) {
			return buffer.byteLength
		}));
		context = new OfflineAudioContext(2, len, 44100);
		return Promise.all(data.map(function(buffer) {
			return audio.decodeAudioData(buffer)
			.then(function(bufferSource) {
				var source = context.createBufferSource();
				source.buffer = bufferSource;
				source.connect(context.destination);
				return source.start()
			})
		}))
		.then(function() {
			return context.startRendering()
		})
		.then(function(renderedBuffer) {
			return new Promise(function(resolve) {
				var mix = audio.createBufferSource();
				mix.buffer = renderedBuffer;
				mix.connect(audio.destination);
				mix.connect(mixedAudio);              
				recorder = new MediaRecorder(mixedAudio.stream);
				recorder.start(0);
				mix.start(0);
				//div.innerHTML = "playing and recording tracks..";
				
          // stop playback and recorder in 60 seconds

          stopMix(dur, mix, recorder)

          recorder.ondataavailable = function(event) {
          	chunks.push(event.data);
          };

          recorder.onstop = function(event) {
          	var blob2 = new Blob(chunks,  {
          		"type": "audio/mp3; codecs=0"
          	});
          	console.log("recording complete");
          	resolve(blob2)
          };                      
      })
		})
		.then(function(blob2) {
			console.log(blob2);
			//div.innerHTML = "mixed audio tracks ready for download..";
			var audioDownload = URL.createObjectURL(blob2);
			
			console.log("Succesfully mixed!");
			audSave = document.getElementById('aud2');
			audInput = document.getElementById('audio-input');
			audSave.src = audioDownload;
                    const dT = new ClipboardEvent('').clipboardData || // Firefox < 62 workaround exploiting https://bugzilla.mozilla.org/show_bug.cgi?id=1422655
                    new DataTransfer(); // specs compliant (as of March 2018 only Chrome)
                    dT.items.add(new File([blob2], 'audio.mp3', { 'type' : 'audio/mp3;' }));

                    audInput.files = dT.files;
                    
                    console.log("audio added to form succesfully!!!");

			player.src = audioDownload;
			document.body.appendChild(player);
		})
	})
	.catch(function(e) {
		console.log(e)
	});
}
</script>