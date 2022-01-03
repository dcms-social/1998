/** @license* @license





 SoundManager 2: JavaScript Sound for the Web


 ----------------------------------------------


 http://schillmania.com/projects/soundmanager2/





 Copyright (c) 2007, Scott Schiller. All rights reserved.


 Code provided under the BSD License:


 http://schillmania.com/projects/soundmanager2/license.txt





 V2.97a.20110424


*/


(function(R){function S(S,da){function l(c){return function(a){return!this._t||!this._t._a?(this._t&&this._t.sID?b._wD(k+"ignoring "+a.type+": "+this._t.sID):b._wD(k+"ignoring "+a.type),null):c.call(this,a)}}function wa(){if(b.debugURLParam.test(D))b.debugMode=!0;if(r(b.debugID))return!1;var c,a,e,f;if(b.debugMode&&!r(b.debugID)&&(!ea||!b.useConsole||b.useConsole&&ea&&!b.consoleOnly)){c=g.createElement("div");c.id=b.debugID+"-toggle";a={position:"fixed",bottom:"0px",right:"0px",width:"1.2em",height:"1.2em",


lineHeight:"1.2em",margin:"2px",textAlign:"center",border:"1px solid #999",cursor:"pointer",background:"#fff",color:"#333",zIndex:10001};c.appendChild(g.createTextNode("-"));c.onclick=xa;c.title="Toggle SM2 debug console";if(s.match(/msie 6/i))c.style.position="absolute",c.style.cursor="hand";for(f in a)a.hasOwnProperty(f)&&(c.style[f]=a[f]);a=g.createElement("div");a.id=b.debugID;a.style.display=b.debugMode?"block":"none";if(b.debugMode&&!r(c.id)){try{e=T(),e.appendChild(c)}catch(d){throw Error(o("appXHTML"));


}e.appendChild(a)}}}this.flashVersion=8;this.debugMode=!0;this.debugFlash=!1;this.useConsole=!0;this.waitForWindowLoad=this.consoleOnly=!1;this.nullURL="about:blank";this.allowPolling=!0;this.useFastPolling=!1;this.useMovieStar=!0;this.bgColor="#ffffff";this.useHighPerformance=!1;this.flashPollingInterval=null;this.flashLoadTimeout=1E3;this.wmode=null;this.allowScriptAccess="always";this.useHTML5Audio=this.useFlashBlock=!1;this.html5Test=/^probably$/i;this.useGlobalHTML5Audio=!0;this.requireFlash=


!1;this.audioFormats={mp3:{type:['audio/mpeg; codecs="mp3"',"audio/mpeg","audio/mp3","audio/MPA","audio/mpa-robust"],required:!0},mp4:{related:["aac","m4a"],type:['audio/mp4; codecs="mp4a.40.2"',"audio/aac","audio/x-m4a","audio/MP4A-LATM","audio/mpeg4-generic"],required:!0},ogg:{type:["audio/ogg; codecs=vorbis"],required:!1},wav:{type:['audio/wav; codecs="1"',"audio/wav","audio/wave","audio/x-wav"],required:!1}};this.defaultOptions={autoLoad:!1,stream:!0,autoPlay:!1,loops:1,onid3:null,onload:null,


whileloading:null,onplay:null,onpause:null,onresume:null,whileplaying:null,onstop:null,onfailure:null,onfinish:null,onbeforefinish:null,onbeforefinishtime:5E3,onbeforefinishcomplete:null,onjustbeforefinish:null,onjustbeforefinishtime:200,multiShot:!0,multiShotEvents:!1,position:null,pan:0,type:null,usePolicyFile:!1,volume:100};this.flash9Options={isMovieStar:null,usePeakData:!1,useWaveformData:!1,useEQData:!1,onbufferchange:null,ondataerror:null};this.movieStarOptions={bufferTime:3,serverURL:null,


onconnect:null,duration:null};this.version=null;this.versionNumber="V2.97a.20110424";this.movieURL=null;this.url=S||null;this.altURL=null;this.enabled=this.swfLoaded=!1;this.o=null;this.movieID="sm2-container";this.id=da||"sm2movie";this.swfCSS={swfBox:"sm2-object-box",swfDefault:"movieContainer",swfError:"swf_error",swfTimedout:"swf_timedout",swfLoaded:"swf_loaded",swfUnblocked:"swf_unblocked",sm2Debug:"sm2_debug",highPerf:"high_performance",flashDebug:"flash_debug"};this.oMC=null;this.sounds={};


this.soundIDs=[];this.muted=!1;this.debugID="soundmanager-debug";this.debugURLParam=/([#?&])debug=1/i;this.didFlashBlock=this.specialWmodeCase=!1;this.filePattern=null;this.filePatterns={flash8:/\.mp3(\?.*)?$/i,flash9:/\.mp3(\?.*)?$/i};this.baseMimeTypes=/^\s*audio\/(?:x-)?(?:mp(?:eg|3))\s*(?:$|;)/i;this.netStreamMimeTypes=/^\s*audio\/(?:x-)?(?:mp(?:eg|3))\s*(?:$|;)/i;this.netStreamTypes=["aac","flv","mov","mp4","m4v","f4v","m4a","mp4v","3gp","3g2"];this.netStreamPattern=RegExp("\\.("+this.netStreamTypes.join("|")+


")(\\?.*)?$","i");this.mimePattern=this.baseMimeTypes;this.features={buffering:!1,peakData:!1,waveformData:!1,eqData:!1,movieStar:!1};this.sandbox={type:null,types:{remote:"remote (domain-based) rules",localWithFile:"local with file access (no internet access)",localWithNetwork:"local with network (internet access only, no local access)",localTrusted:"local, trusted (local+internet access)"},description:null,noRemote:null,noLocal:null};this.hasHTML5=null;this.html5={usingFlash:null};this.ignoreFlash=


!1;var fa,b=this,k="HTML5::",r,s=navigator.userAgent,h=R,D=h.location.href.toString(),i=this.flashVersion,g=document,ga,U,y=[],ha=!0,v,E=!1,K=!1,m=!1,w=!1,ia=!1,j,La=0,L,t,ja,A,F,ka,V,ya,la,B,za,W,M,G,ma,T,X,na,Aa,Ma=["log","info","warn","error"],Ba,Y,Ca,N=null,oa=null,o,pa,H,xa,Z,$,qa,p,aa=!1,ra=!1,Da,Ea,C=null,Fa,ba,u=!1,O,z,sa,Ga,q,Ha=Array.prototype.slice,P=!1,ca,I,Ia,Ja=s.match(/pre\//i),Na=s.match(/(ipad|iphone|ipod)/i);s.match(/mobile/i);var x=s.match(/msie/i),Oa=s.match(/webkit/i),Q=s.match(/safari/i)&&


!s.match(/chrome/i),Pa=s.match(/opera/i),ta=!D.match(/usehtml5audio/i)&&!D.match(/sm2\-ignorebadua/i)&&Q&&s.match(/OS X 10_6_([3-9])/i),ea=typeof console!=="undefined"&&typeof console.log!=="undefined",ua=typeof g.hasFocus!=="undefined"?g.hasFocus():null,J=typeof g.hasFocus==="undefined"&&Q,Ka=!J;this._use_maybe=D.match(/sm2\-useHTML5Maybe\=1/i);this._overHTTP=g.location?g.location.protocol.match(/http/i):null;this._http=!this._overHTTP?"http:":"";this.useAltURL=!this._overHTTP;this._global_a=null;


if(Na||Ja)b.useHTML5Audio=!0,b.ignoreFlash=!0,b.useGlobalHTML5Audio&&(P=!0);if(Ja||this._use_maybe)b.html5Test=/^(probably|maybe)$/i;(function(){var c=D,a=null;if(c.indexOf("#sm2-usehtml5audio=")!==-1)a=c.charAt(c.indexOf("#sm2-usehtml5audio=")+19)==="1",typeof console!=="undefined"&&typeof console.log!=="undefined"&&console.log((a?"Enabling ":"Disabling ")+"useHTML5Audio via URL parameter"),b.useHTML5Audio=a})();this.supported=this.ok=function(){return C?m&&!w:b.useHTML5Audio&&b.hasHTML5};this.getMovie=


function(b){return x?h[b]:Q?r(b)||g[b]:r(b)};this.createSound=function(c){function a(){e=Z(e);b.sounds[d.id]=new fa(d);b.soundIDs.push(d.id);return b.sounds[d.id]}var e=null,f=null,d=null;if(!m||!b.ok())return qa("soundManager.createSound(): "+o(!m?"notReady":"notOK")),!1;arguments.length===2&&(c={id:arguments[0],url:arguments[1]});d=e=t(c);d.id.toString().charAt(0).match(/^[0-9]$/)&&b._wD("soundManager.createSound(): "+o("badID",d.id),2);b._wD("soundManager.createSound(): "+d.id+" ("+d.url+")",1);


if(p(d.id,!0))return b._wD("soundManager.createSound(): "+d.id+" exists",1),b.sounds[d.id];if(ba(d))f=a(),b._wD("Loading sound "+d.id+" via HTML5"),f._setup_html5(d);else{if(i>8&&b.useMovieStar){if(d.isMovieStar===null)d.isMovieStar=d.serverURL||d.type&&d.type.match(b.netStreamPattern)||d.url.match(b.netStreamPattern)?!0:!1;d.isMovieStar&&b._wD("soundManager.createSound(): using MovieStar handling");if(d.isMovieStar){if(d.usePeakData)j("noPeak"),d.usePeakData=!1;d.loops>1&&j("noNSLoop")}}d=$(d,"soundManager.createSound(): ");


f=a();if(i===8)b.o._createSound(d.id,d.onjustbeforefinishtime,d.loops||1,d.usePolicyFile);else if(b.o._createSound(d.id,d.url,d.onjustbeforefinishtime,d.usePeakData,d.useWaveformData,d.useEQData,d.isMovieStar,d.isMovieStar?d.bufferTime:!1,d.loops||1,d.serverURL,d.duration||null,d.autoPlay,!0,d.autoLoad,d.usePolicyFile),!d.serverURL)f.connected=!0,d.onconnect&&d.onconnect.apply(f);(d.autoLoad||d.autoPlay)&&!d.serverURL&&f.load(d)}d.autoPlay&&!d.serverURL&&f.play();return f};this.destroySound=function(c,


a){if(!p(c))return!1;var e=b.sounds[c],f;e._iO={};e.stop();e.unload();for(f=0;f<b.soundIDs.length;f++)if(b.soundIDs[f]===c){b.soundIDs.splice(f,1);break}a||e.destruct(!0);delete b.sounds[c];return!0};this.load=function(c,a){if(!p(c))return!1;return b.sounds[c].load(a)};this.unload=function(c){if(!p(c))return!1;return b.sounds[c].unload()};this.start=this.play=function(c,a){if(!m||!b.ok())return qa("soundManager.play(): "+o(!m?"notReady":"notOK")),!1;if(!p(c))return a instanceof Object||(a={url:a}),


a&&a.url?(b._wD('soundManager.play(): attempting to create "'+c+'"',1),a.id=c,b.createSound(a).play()):!1;return b.sounds[c].play(a)};this.setPosition=function(c,a){if(!p(c))return!1;return b.sounds[c].setPosition(a)};this.stop=function(c){if(!p(c))return!1;b._wD("soundManager.stop("+c+")",1);return b.sounds[c].stop()};this.stopAll=function(){b._wD("soundManager.stopAll()",1);for(var c in b.sounds)b.sounds[c]instanceof fa&&b.sounds[c].stop()};this.pause=function(c){if(!p(c))return!1;return b.sounds[c].pause()};


this.pauseAll=function(){for(var c=b.soundIDs.length;c--;)b.sounds[b.soundIDs[c]].pause()};this.resume=function(c){if(!p(c))return!1;return b.sounds[c].resume()};this.resumeAll=function(){for(var c=b.soundIDs.length;c--;)b.sounds[b.soundIDs[c]].resume()};this.togglePause=function(c){if(!p(c))return!1;return b.sounds[c].togglePause()};this.setPan=function(c,a){if(!p(c))return!1;return b.sounds[c].setPan(a)};this.setVolume=function(c,a){if(!p(c))return!1;return b.sounds[c].setVolume(a)};this.mute=function(c){var a=


0;typeof c!=="string"&&(c=null);if(c){if(!p(c))return!1;b._wD('soundManager.mute(): Muting "'+c+'"');return b.sounds[c].mute()}else{b._wD("soundManager.mute(): Muting all sounds");for(a=b.soundIDs.length;a--;)b.sounds[b.soundIDs[a]].mute();b.muted=!0}return!0};this.muteAll=function(){b.mute()};this.unmute=function(c){typeof c!=="string"&&(c=null);if(c){if(!p(c))return!1;b._wD('soundManager.unmute(): Unmuting "'+c+'"');return b.sounds[c].unmute()}else{b._wD("soundManager.unmute(): Unmuting all sounds");


for(c=b.soundIDs.length;c--;)b.sounds[b.soundIDs[c]].unmute();b.muted=!1}return!0};this.unmuteAll=function(){b.unmute()};this.toggleMute=function(c){if(!p(c))return!1;return b.sounds[c].toggleMute()};this.getMemoryUse=function(){if(i===8)return 0;if(b.o)return parseInt(b.o._getMemoryUse(),10)};this.disable=function(c){typeof c==="undefined"&&(c=!1);if(w)return!1;w=!0;j("shutdown",1);for(var a=b.soundIDs.length;a--;)Ba(b.sounds[b.soundIDs[a]]);L(c);q.remove(h,"load",F);return!0};this.canPlayMIME=function(c){var a;


b.hasHTML5&&(a=O({type:c}));return!C||a?a:c?c.match(b.mimePattern)?!0:!1:null};this.canPlayURL=function(c){var a;b.hasHTML5&&(a=O(c));return!C||a?a:c?c.match(b.filePattern)?!0:!1:null};this.canPlayLink=function(c){if(typeof c.type!=="undefined"&&c.type&&b.canPlayMIME(c.type))return!0;return b.canPlayURL(c.href)};this.getSoundById=function(c,a){if(!c)throw Error("soundManager.getSoundById(): sID is null/undefined");var e=b.sounds[c];!e&&!a&&b._wD('"'+c+'" is an invalid sound ID.',2);return e};this.onready=


function(b,a){if(b&&b instanceof Function)return m&&j("queue","onready"),a||(a=h),ja("onready",b,a),A(),!0;else throw o("needFunction","onready");};this.ontimeout=function(b,a){if(b&&b instanceof Function)return m&&j("queue"),a||(a=h),ja("ontimeout",b,a),A({type:"ontimeout"}),!0;else throw o("needFunction","ontimeout");};this.getMoviePercent=function(){return b.o&&typeof b.o.PercentLoaded!=="undefined"?b.o.PercentLoaded():null};this._wD=this._writeDebug=function(c,a,e){var f,d;if(!b.debugMode)return!1;


typeof e!=="undefined"&&e&&(c=c+" | "+(new Date).getTime());if(ea&&b.useConsole){e=Ma[a];if(typeof console[e]!=="undefined")console[e](c);else console.log(c);if(b.useConsoleOnly)return!0}try{f=r("soundmanager-debug");if(!f)return!1;d=g.createElement("div");if(++La%2===0)d.className="sm2-alt";a=typeof a==="undefined"?0:parseInt(a,10);d.appendChild(g.createTextNode(c));if(a){if(a>=2)d.style.fontWeight="bold";if(a===3)d.style.color="#ff3333"}f.insertBefore(d,f.firstChild)}catch(n){}return!0};this._debug=


function(){j("currentObj",1);for(var c=0,a=b.soundIDs.length;c<a;c++)b.sounds[b.soundIDs[c]]._debug()};this.reboot=function(){b._wD("soundManager.reboot()");b.soundIDs.length&&b._wD("Destroying "+b.soundIDs.length+" SMSound objects...");var c,a;for(c=b.soundIDs.length;c--;)b.sounds[b.soundIDs[c]].destruct();try{if(x)oa=b.o.innerHTML;N=b.o.parentNode.removeChild(b.o);b._wD("Flash movie removed.")}catch(e){j("badRemove",2)}oa=N=null;b.enabled=m=aa=ra=E=K=w=b.swfLoaded=!1;b.soundIDs=b.sounds=[];b.o=


null;for(c in y)if(y.hasOwnProperty(c))for(a=y[c].length;a--;)y[c][a].fired=!1;b._wD("soundManager: Rebooting...");h.setTimeout(function(){b.beginDelayedInit()},20)};this.destruct=function(){b._wD("soundManager.destruct()");b.disable(!0)};this.beginDelayedInit=function(){ia=!0;G();setTimeout(za,20);V()};this._html5_events={abort:l(function(){b._wD(k+"abort: "+this._t.sID)}),canplay:l(function(){b._wD(k+"canplay: "+this._t.sID+", "+this._t.url);this._t._onbufferchange(0);var c=!isNaN(this._t.position)?


this._t.position/1E3:null;this._t._html5_canplay=!0;if(this._t.position&&this.currentTime!==c){b._wD(k+"canplay: setting position to "+c+"");try{this.currentTime=c}catch(a){b._wD(k+"setting position failed: "+a.message,2)}}}),load:l(function(){this._t.loaded||(this._t._onbufferchange(0),this._t._whileloading(this._t.bytesTotal,this._t.bytesTotal,this._t._get_html5_duration()),this._t._onload(!0))}),emptied:l(function(){b._wD(k+"emptied: "+this._t.sID)}),ended:l(function(){b._wD(k+"ended: "+this._t.sID);


this._t._onfinish()}),error:l(function(){b._wD(k+"error: "+this.error.code);this._t._onload(!1)}),loadeddata:l(function(){b._wD(k+"loadeddata: "+this._t.sID)}),loadedmetadata:l(function(){b._wD(k+"loadedmetadata: "+this._t.sID)}),loadstart:l(function(){b._wD(k+"loadstart: "+this._t.sID);this._t._onbufferchange(1)}),play:l(function(){b._wD(k+"play: "+this._t.sID+", "+this._t.url);this._t._onbufferchange(0)}),playing:l(function(){b._wD(k+"playing: "+this._t.sID+", "+this._t.url);this._t._onbufferchange(0)}),


progress:l(function(c){if(this._t.loaded)return!1;var a,e,f;f=0;var d=c.type==="progress";e=c.target.buffered;var n=c.loaded||0,va=c.total||1;if(e&&e.length){for(a=e.length;a--;)f=e.end(a)-e.start(a);n=f/c.target.duration;if(d&&e.length>1){f=[];e=e.length;for(a=0;a<e;a++)f.push(c.target.buffered.start(a)+"-"+c.target.buffered.end(a));b._wD(k+"progress: timeRanges: "+f.join(", "))}d&&!isNaN(n)&&b._wD(k+"progress: "+this._t.sID+": "+Math.floor(n*100)+"% loaded")}isNaN(n)||(this._t._onbufferchange(0),


this._t._whileloading(n,va,this._t._get_html5_duration()),n&&va&&n===va&&b._html5_events.load.call(this,c))}),ratechange:l(function(){b._wD(k+"ratechange: "+this._t.sID)}),suspend:l(function(c){b._wD(k+"suspend: "+this._t.sID);b._html5_events.progress.call(this,c)}),stalled:l(function(){b._wD(k+"stalled: "+this._t.sID)}),timeupdate:l(function(){this._t._onTimer()}),waiting:l(function(){b._wD(k+"waiting: "+this._t.sID);this._t._onbufferchange(1)})};fa=function(c){var a=this,e,f,d;this.sID=c.id;this.url=


c.url;this._iO=this.instanceOptions=this.options=t(c);this.pan=this.options.pan;this.volume=this.options.volume;this._lastURL=null;this.isHTML5=!1;this._a=null;this.id3={};this._debug=function(){if(b.debugMode){var c=null,d=[],e,f;for(c in a.options)a.options[c]!==null&&(a.options[c]instanceof Function?(e=a.options[c].toString(),e=e.replace(/\s\s+/g," "),f=e.indexOf("{"),d.push(" "+c+": {"+e.substr(f+1,Math.min(Math.max(e.indexOf("\n")-1,64),64)).replace(/\n/g,"")+"... }")):d.push(" "+c+": "+a.options[c]));


b._wD("SMSound() merged options: {\n"+d.join(", \n")+"\n}")}};this._debug();this.load=function(c){var d=null;if(typeof c!=="undefined")a._iO=t(c,a.options),a.instanceOptions=a._iO;else if(c=a.options,a._iO=c,a.instanceOptions=a._iO,a._lastURL&&a._lastURL!==a.url)j("manURL"),a._iO.url=a.url,a.url=null;if(!a._iO.url)a._iO.url=a.url;b._wD("SMSound.load(): "+a._iO.url,1);if(a._iO.url===a.url&&a.readyState!==0&&a.readyState!==2)return j("onURL",1),a;a._lastURL=a.url;a.loaded=!1;a.readyState=1;a.playState=


0;if(ba(a._iO))d=a._setup_html5(a._iO),d._called_load?b._wD("HTML5 ignoring request to load again: "+a.sID):(b._wD(k+"load: "+a.sID),d.load(),d._called_load=!0,a._iO.autoPlay&&a.play());else try{a.isHTML5=!1,a._iO=$(Z(a._iO)),i===8?b.o._load(a.sID,a._iO.url,a._iO.stream,a._iO.autoPlay,a._iO.whileloading?1:0,a._iO.loops||1,a._iO.usePolicyFile):b.o._load(a.sID,a._iO.url,a._iO.stream?!0:!1,a._iO.autoPlay?!0:!1,a._iO.loops||1,a._iO.autoLoad?!0:!1,a._iO.usePolicyFile)}catch(e){j("smError",2),v("onload",


!1),na()}return a};this.unload=function(){if(a.readyState!==0){b._wD('SMSound.unload(): "'+a.sID+'"');if(a.isHTML5){if(f(),a._a)a._a.pause(),a._a.src=""}else i===8?b.o._unload(a.sID,b.nullURL):b.o._unload(a.sID);e()}return a};this.destruct=function(c){b._wD('SMSound.destruct(): "'+a.sID+'"');if(a.isHTML5){if(f(),a._a)a._a.pause(),a._a.src="",P||a._remove_html5_events()}else a._iO.onfailure=null,b.o._destroySound(a.sID);c||b.destroySound(a.sID,!0)};this.start=this.play=function(c,e){var f,e=e===void 0?


!0:e;c||(c={});a._iO=t(c,a._iO);a._iO=t(a._iO,a.options);a.instanceOptions=a._iO;if(a._iO.serverURL&&!a.connected)return a.getAutoPlay()||(b._wD("SMSound.play():  Netstream not connected yet - setting autoPlay"),a.setAutoPlay(!0)),a;ba(a._iO)&&(a._setup_html5(a._iO),d());if(a.playState===1&&!a.paused)if(f=a._iO.multiShot)b._wD('SMSound.play(): "'+a.sID+'" already playing (multi-shot)',1),a.isHTML5&&a.setPosition(a._iO.position);else return b._wD('SMSound.play(): "'+a.sID+'" already playing (one-shot)',


1),a;if(a.loaded)b._wD('SMSound.play(): "'+a.sID+'"');else if(a.readyState===0){b._wD('SMSound.play(): Attempting to load "'+a.sID+'"',1);if(!a.isHTML5)a._iO.autoPlay=!0;a.load(a._iO)}else if(a.readyState===2)return b._wD('SMSound.play(): Could not load "'+a.sID+'" - exiting',2),a;else b._wD('SMSound.play(): "'+a.sID+'" is loading - attempting to play..',1);if(a.paused&&a.position&&a.position>0)b._wD('SMSound.play(): "'+a.sID+'" is resuming from paused state',1),a.resume();else{b._wD('SMSound.play(): "'+


a.sID+'" is starting to play');a.playState=1;a.paused=!1;(!a.instanceCount||a._iO.multiShotEvents||i>8&&!a.isHTML5&&!a.getAutoPlay())&&a.instanceCount++;a.position=typeof a._iO.position!=="undefined"&&!isNaN(a._iO.position)?a._iO.position:0;if(!a.isHTML5)a._iO=$(Z(a._iO));if(a._iO.onplay&&e)a._iO.onplay.apply(a),a._onplay_called=!0;a.setVolume(a._iO.volume,!0);a.setPan(a._iO.pan,!0);a.isHTML5?(d(),a._setup_html5().play()):b.o._start(a.sID,a._iO.loops||1,i===9?a.position:a.position/1E3)}return a};


this.stop=function(c){if(a.playState===1){a._onbufferchange(0);a.resetOnPosition(0);if(!a.isHTML5)a.playState=0;a.paused=!1;a._iO.onstop&&a._iO.onstop.apply(a);if(a.isHTML5){if(a._a)a.setPosition(0),a._a.pause(),a.playState=0,a._onTimer(),f(),a.unload()}else b.o._stop(a.sID,c),a._iO.serverURL&&a.unload();a.instanceCount=0;a._iO={}}return a};this.setAutoPlay=function(c){b._wD("sound "+a.sID+" turned autoplay "+(c?"on":"off"));a._iO.autoPlay=c;a.isHTML5?a._a&&c&&a.play():b.o._setAutoPlay(a.sID,c);c&&


!a.instanceCount&&a.readyState===1&&(a.instanceCount++,b._wD("sound "+a.sID+" incremented instance count to "+a.instanceCount))};this.getAutoPlay=function(){return a._iO.autoPlay};this.setPosition=function(c){c===void 0&&(c=0);var d=a.isHTML5?Math.max(c,0):Math.min(a.duration||a._iO.duration,Math.max(c,0));a.position=d;c=a.position/1E3;a.resetOnPosition(a.position);a._iO.position=d;if(a.isHTML5){if(a._a)if(a._html5_canplay){if(a._a.currentTime!==c){b._wD("setPosition("+c+"): setting position");try{a._a.currentTime=


c}catch(e){b._wD("setPosition("+c+"): setting position failed: "+e.message,2)}}}else b._wD("setPosition("+c+"): delaying, sound not ready")}else c=i===9?a.position:c,a.readyState&&a.readyState!==2&&b.o._setPosition(a.sID,c,a.paused||!a.playState);a.isHTML5&&a.paused&&a._onTimer(!0);return a};this.pause=function(c){if(a.paused||a.playState===0&&a.readyState!==1)return a;b._wD("SMSound.pause()");a.paused=!0;a.isHTML5?(a._setup_html5().pause(),f()):(c||c===void 0)&&b.o._pause(a.sID);a._iO.onpause&&a._iO.onpause.apply(a);


return a};this.resume=function(){if(!a.paused)return a;b._wD("SMSound.resume()");a.paused=!1;a.playState=1;a.isHTML5?(a._setup_html5().play(),d()):(a._iO.isMovieStar&&a.setPosition(a.position),b.o._pause(a.sID));!a._onplay_called&&a._iO.onplay?(a._iO.onplay.apply(a),a._onplay_called=!0):a._iO.onresume&&a._iO.onresume.apply(a);return a};this.togglePause=function(){b._wD("SMSound.togglePause()");if(a.playState===0)return a.play({position:i===9&&!a.isHTML5?a.position:a.position/1E3}),a;a.paused?a.resume():


a.pause();return a};this.setPan=function(c,d){typeof c==="undefined"&&(c=0);typeof d==="undefined"&&(d=!1);a.isHTML5||b.o._setPan(a.sID,c);a._iO.pan=c;if(!d)a.pan=c,a.options.pan=c;return a};this.setVolume=function(c,d){typeof c==="undefined"&&(c=100);typeof d==="undefined"&&(d=!1);if(a.isHTML5){if(a._a)a._a.volume=Math.max(0,Math.min(1,c/100))}else b.o._setVolume(a.sID,b.muted&&!a.muted||a.muted?0:c);a._iO.volume=c;if(!d)a.volume=c,a.options.volume=c;return a};this.mute=function(){a.muted=!0;if(a.isHTML5){if(a._a)a._a.muted=


!0}else b.o._setVolume(a.sID,0);return a};this.unmute=function(){a.muted=!1;var c=typeof a._iO.volume!=="undefined";if(a.isHTML5){if(a._a)a._a.muted=!1}else b.o._setVolume(a.sID,c?a._iO.volume:a.options.volume);return a};this.toggleMute=function(){return a.muted?a.unmute():a.mute()};this.onposition=function(b,c,d){a._onPositionItems.push({position:b,method:c,scope:typeof d!=="undefined"?d:a,fired:!1});return a};this.processOnPosition=function(){var c,d;c=a._onPositionItems.length;if(!c||!a.playState||


a._onPositionFired>=c)return!1;for(;c--;)if(d=a._onPositionItems[c],!d.fired&&a.position>=d.position)d.method.apply(d.scope,[d.position]),d.fired=!0,b._onPositionFired++;return!0};this.resetOnPosition=function(c){var d,e;d=a._onPositionItems.length;if(!d)return!1;for(;d--;)if(e=a._onPositionItems[d],e.fired&&c<=e.position)e.fired=!1,b._onPositionFired--;return!0};this._onTimer=function(c){var d={};if(a._hasTimer||c)return a._a&&(c||(a.playState>0||a.readyState===1)&&!a.paused)?(a.duration=a._get_html5_duration(),


a.durationEstimate=a.duration,c=a._a.currentTime?a._a.currentTime*1E3:0,a._whileplaying(c,d,d,d,d),!0):(b._wD('_onTimer: Warn for "'+a.sID+'": '+(!a._a?"Could not find element. ":"")+(a.playState===0?"playState bad, 0?":"playState = "+a.playState+", OK")),!1)};this._get_html5_duration=function(){var b=a._a?a._a.duration*1E3:a._iO?a._iO.duration:void 0;return b&&!isNaN(b)&&b!==Infinity?b:a._iO?a._iO.duration:null};d=function(){a.isHTML5&&Da(a)};f=function(){a.isHTML5&&Ea(a)};e=function(){a._onPositionItems=


[];a._onPositionFired=0;a._hasTimer=null;a._onplay_called=!1;a._a=null;a._html5_canplay=!1;a.bytesLoaded=null;a.bytesTotal=null;a.position=null;a.duration=a._iO&&a._iO.duration?a._iO.duration:null;a.durationEstimate=null;a.failures=0;a.loaded=!1;a.playState=0;a.paused=!1;a.readyState=0;a.muted=!1;a.didBeforeFinish=!1;a.didJustBeforeFinish=!1;a.isBuffering=!1;a.instanceOptions={};a.instanceCount=0;a.peakData={left:0,right:0};a.waveformData={left:[],right:[]};a.eqData=[];a.eqData.left=[];a.eqData.right=


[]};e();this._setup_html5=function(c){var c=t(a._iO,c),d=P?b._global_a:a._a,f=decodeURI(c.url),g=d&&d._t?d._t.instanceOptions:null;if(d){if(d._t&&g.url===c.url&&(!a._lastURL||a._lastURL===g.url))return d;b._wD("setting new URL on existing object: "+f+(a._lastURL?", old URL: "+a._lastURL:""));P&&d._t&&d._t.playState&&c.url!==g.url&&d._t.stop();e();d.src=c.url;a.url=c.url;a._lastURL=c.url;d._called_load=!1}else if(b._wD("creating HTML5 Audio() element with URL: "+f),d=new Audio(c.url),d._called_load=


!1,P)b._global_a=d;a.isHTML5=!0;a._a=d;d._t=a;a._add_html5_events();d.loop=c.loops>1?"loop":"";c.autoLoad||c.autoPlay?(d.autobuffer="auto",d.preload="auto",a.load(),d._called_load=!0):(d.autobuffer=!1,d.preload="none");d.loop=c.loops>1?"loop":"";return d};this._add_html5_events=function(){if(a._a._added_events)return!1;var c;b._wD(k+"adding event listeners: "+a.sID);a._a._added_events=!0;for(c in b._html5_events)b._html5_events.hasOwnProperty(c)&&a._a&&a._a.addEventListener(c,b._html5_events[c],!1);


return!0};this._remove_html5_events=function(){b._wD(k+"removing event listeners: "+a.sID);a._a._added_events=!1;for(var c in b._html5_events)b._html5_events.hasOwnProperty(c)&&a._a&&a._a.removeEventListener(c,b._html5_events[c],!1)};this._whileloading=function(b,c,d,e){a.bytesLoaded=b;a.bytesTotal=c;a.duration=Math.floor(d);a.bufferLength=e;if(a._iO.isMovieStar)a.durationEstimate=a.duration;else if(a.durationEstimate=a._iO.duration?a.duration>a._iO.duration?a.duration:a._iO.duration:parseInt(a.bytesTotal/


a.bytesLoaded*a.duration,10),a.durationEstimate===void 0)a.durationEstimate=a.duration;a.readyState!==3&&a._iO.whileloading&&a._iO.whileloading.apply(a)};this._onid3=function(c,d){b._wD('SMSound._onid3(): "'+this.sID+'" ID3 data received.');var e=[],f,g;f=0;for(g=c.length;f<g;f++)e[c[f]]=d[f];a.id3=t(a.id3,e);a._iO.onid3&&a._iO.onid3.apply(a)};this._whileplaying=function(c,d,e,f,g){if(isNaN(c)||c===null)return!1;a.playState===0&&c>0&&(c=0);a.position=c;a.processOnPosition();if(i>8&&!a.isHTML5){if(a._iO.usePeakData&&


typeof d!=="undefined"&&d)a.peakData={left:d.leftPeak,right:d.rightPeak};if(a._iO.useWaveformData&&typeof e!=="undefined"&&e)a.waveformData={left:e.split(","),right:f.split(",")};if(a._iO.useEQData&&typeof g!=="undefined"&&g&&g.leftEQ&&(c=g.leftEQ.split(","),a.eqData=c,a.eqData.left=c,typeof g.rightEQ!=="undefined"&&g.rightEQ))a.eqData.right=g.rightEQ.split(",")}a.playState===1&&(!a.isHTML5&&b.flashVersion===8&&!a.position&&a.isBuffering&&a._onbufferchange(0),a._iO.whileplaying&&a._iO.whileplaying.apply(a),


(a.loaded||!a.loaded&&a._iO.isMovieStar)&&a._iO.onbeforefinish&&a._iO.onbeforefinishtime&&!a.didBeforeFinish&&a.duration-a.position<=a._iO.onbeforefinishtime&&a._onbeforefinish());return!0};this._onconnect=function(c){c=c===1;b._wD('SMSound._onconnect(): "'+a.sID+'"'+(c?" connected.":" failed to connect? - "+a.url),c?1:2);if(a.connected=c)a.failures=0,p(a.sID)&&(a.getAutoPlay()?a.play(void 0,a.getAutoPlay()):a._iO.autoLoad&&a.load()),a._iO.onconnect&&a._iO.onconnect.apply(a,[c])};this._onload=function(c){c=


c?!0:!1;b._wD('SMSound._onload(): "'+a.sID+'"'+(c?" loaded.":" failed to load? - "+a.url),c?1:2);!c&&!a.isHTML5&&(b.sandbox.noRemote===!0&&b._wD("SMSound._onload(): "+o("noNet"),1),b.sandbox.noLocal===!0&&b._wD("SMSound._onload(): "+o("noLocal"),1));a.loaded=c;a.readyState=c?3:2;a._onbufferchange(0);a._iO.onload&&a._iO.onload.apply(a,[c]);return!0};this._onfailure=function(c,d,e){a.failures++;b._wD('SMSound._onfailure(): "'+a.sID+'" count '+a.failures);if(a._iO.onfailure&&a.failures===1)a._iO.onfailure(a,


c,d,e);else b._wD("SMSound._onfailure(): ignoring")};this._onbeforefinish=function(){if(!a.didBeforeFinish)a.didBeforeFinish=!0,a._iO.onbeforefinish&&(b._wD('SMSound._onbeforefinish(): "'+a.sID+'"'),a._iO.onbeforefinish.apply(a))};this._onjustbeforefinish=function(){if(!a.didJustBeforeFinish)a.didJustBeforeFinish=!0,a._iO.onjustbeforefinish&&(b._wD('SMSound._onjustbeforefinish(): "'+a.sID+'"'),a._iO.onjustbeforefinish.apply(a))};this._onfinish=function(){var c=a._iO.onfinish;a._onbufferchange(0);


a.resetOnPosition(0);a._iO.onbeforefinishcomplete&&a._iO.onbeforefinishcomplete.apply(a);a.didBeforeFinish=!1;a.didJustBeforeFinish=!1;if(a.instanceCount){a.instanceCount--;if(!a.instanceCount)a.playState=0,a.paused=!1,a.instanceCount=0,a.instanceOptions={},a._iO={},f();if((!a.instanceCount||a._iO.multiShotEvents)&&c)b._wD('SMSound._onfinish(): "'+a.sID+'"'),c.apply(a)}};this._onbufferchange=function(c){if(a.playState===0)return!1;if(c&&a.isBuffering||!c&&!a.isBuffering)return!1;a.isBuffering=c===


1;a._iO.onbufferchange&&(b._wD("SMSound._onbufferchange(): "+c),a._iO.onbufferchange.apply(a));return!0};this._ondataerror=function(c){a.playState>0&&(b._wD("SMSound._ondataerror(): "+c),a._iO.ondataerror&&a._iO.ondataerror.apply(a))}};T=function(){return g.body?g.body:g._docElement?g.documentElement:g.getElementsByTagName("div")[0]};r=function(b){return g.getElementById(b)};t=function(c,a){var e={},f,d;for(f in c)c.hasOwnProperty(f)&&(e[f]=c[f]);f=typeof a==="undefined"?b.defaultOptions:a;for(d in f)f.hasOwnProperty(d)&&


typeof e[d]==="undefined"&&(e[d]=f[d]);return e};q=function(){function b(a){var a=Ha.call(a),c=a.length;e?(a[1]="on"+a[1],c>3&&a.pop()):c===3&&a.push(!1);return a}function a(a,b){var c=a.shift(),g=[f[b]];if(e)c[g](a[0],a[1]);else c[g].apply(c,a)}var e=h.attachEvent,f={add:e?"attachEvent":"addEventListener",remove:e?"detachEvent":"removeEventListener"};return{add:function(){a(b(arguments),"add")},remove:function(){a(b(arguments),"remove")}}}();ba=function(b){return!b.serverURL&&(b.type?O({type:b.type}):


O(b.url)||u)};O=function(c){if(!b.useHTML5Audio||!b.hasHTML5)return!1;var a,e=b.audioFormats;if(!z){z=[];for(a in e)e.hasOwnProperty(a)&&(z.push(a),e[a].related&&(z=z.concat(e[a].related)));z=RegExp("\\.("+z.join("|")+")","i")}a=typeof c.type!=="undefined"?c.type:null;c=typeof c==="string"?c.toLowerCase().match(z):null;if(!c||!c.length)if(a)c=a.indexOf(";"),c=(c!==-1?a.substr(0,c):a).substr(6);else return!1;else c=c[0].substr(1);if(c&&typeof b.html5[c]!=="undefined")return b.html5[c];else{if(!a)if(c&&


b.html5[c])return b.html5[c];else a="audio/"+c;a=b.html5.canPlayType(a);return b.html5[c]=a}};Ga=function(){function c(c){var d,e,f=!1;if(!a||typeof a.canPlayType!=="function")return!1;if(c instanceof Array){d=0;for(e=c.length;d<e&&!f;d++)if(b.html5[c[d]]||a.canPlayType(c[d]).match(b.html5Test))f=!0,b.html5[c[d]]=!0;return f}else return(c=a&&typeof a.canPlayType==="function"?a.canPlayType(c):!1)&&(c.match(b.html5Test)?!0:!1)}if(!b.useHTML5Audio||typeof Audio==="undefined")return!1;var a=typeof Audio!==


"undefined"?Pa?new Audio(null):new Audio:null,e,f={},d,g;I();d=b.audioFormats;for(e in d)if(d.hasOwnProperty(e)&&(f[e]=c(d[e].type),d[e]&&d[e].related))for(g=d[e].related.length;g--;)b.html5[d[e].related[g]]=f[e];f.canPlayType=a?c:null;b.html5=t(b.html5,f);return!0};W={notReady:"Not loaded yet - wait for soundManager.onload()/onready()",notOK:"Audio support is not available.",appXHTML:"soundManager::createMovie(): appendChild/innerHTML set failed. May be app/xhtml+xml DOM-related.",spcWmode:"soundManager::createMovie(): Removing wmode, preventing known SWF loading issue(s)",


swf404:"soundManager: Verify that %s is a valid path.",tryDebug:"Try soundManager.debugFlash = true for more security details (output goes to SWF.)",checkSWF:"See SWF output for more debug info.",localFail:"soundManager: Non-HTTP page ("+g.location.protocol+" URL?) Review Flash player security settings for this special case:\nhttp://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager04.html\nMay need to add/allow path, eg. c:/sm2/ or /users/me/sm2/",waitFocus:"soundManager: Special case: Waiting for focus-related event..",


waitImpatient:"soundManager: Getting impatient, still waiting for Flash%s...",waitForever:"soundManager: Waiting indefinitely for Flash (will recover if unblocked)...",needFunction:"soundManager: Function object expected for %s",badID:'Warning: Sound ID "%s" should be a string, starting with a non-numeric character',noMS:"MovieStar mode not enabled. Exiting.",currentObj:"--- soundManager._debug(): Current sound objects ---",waitEI:"soundManager::initMovie(): Waiting for ExternalInterface call from Flash..",


waitOnload:"soundManager: Waiting for window.onload()",docLoaded:"soundManager: Document already loaded",onload:"soundManager::initComplete(): calling soundManager.onload()",onloadOK:"soundManager.onload() complete",init:"-- soundManager::init() --",didInit:"soundManager::init(): Already called?",flashJS:"soundManager: Attempting to call Flash from JS..",noPolling:"soundManager: Polling (whileloading()/whileplaying() support) is disabled.",secNote:"Flash security note: Network/internet URLs will not load due to security restrictions. Access can be configured via Flash Player Global Security Settings Page: http://www.macromedia.com/support/documentation/en/flashplayer/help/settings_manager04.html",


badRemove:"Warning: Failed to remove flash movie.",noPeak:"Warning: peakData features unsupported for movieStar formats",shutdown:"soundManager.disable(): Shutting down",queue:"soundManager: Queueing %s handler",smFail:"soundManager: Failed to initialise.",smError:"SMSound.load(): Exception: JS-Flash communication failed, or JS error.",fbTimeout:"No flash response, applying ."+b.swfCSS.swfTimedout+" CSS..",fbLoaded:"Flash loaded",fbHandler:"soundManager::flashBlockHandler()",manURL:"SMSound.load(): Using manually-assigned URL",


onURL:"soundManager.load(): current URL already assigned.",badFV:'soundManager.flashVersion must be 8 or 9. "%s" is invalid. Reverting to %s.',as2loop:"Note: Setting stream:false so looping can work (flash 8 limitation)",noNSLoop:"Note: Looping not implemented for MovieStar formats",needfl9:"Note: Switching to flash 9, required for MP4 formats.",mfTimeout:"Setting flashLoadTimeout = 0 (infinite) for off-screen, mobile flash case",mfOn:"mobileFlash::enabling on-screen flash repositioning",policy:"Enabling usePolicyFile for data access"};


o=function(){var b=Ha.call(arguments),a=b.shift(),a=W&&W[a]?W[a]:"",e,f;if(a&&b&&b.length){e=0;for(f=b.length;e<f;e++)a=a.replace("%s",b[e])}return a};Z=function(b){if(i===8&&b.loops>1&&b.stream)j("as2loop"),b.stream=!1;return b};$=function(c,a){if(c&&!c.usePolicyFile&&(c.onid3||c.usePeakData||c.useWaveformData||c.useEQData))b._wD((a?a+":":"")+o("policy")),c.usePolicyFile=!0;return c};qa=function(c){typeof console!=="undefined"&&typeof console.warn!=="undefined"?console.warn(c):b._wD(c)};ga=function(){return!1};


Ba=function(b){for(var a in b)b.hasOwnProperty(a)&&typeof b[a]==="function"&&(b[a]=ga)};Y=function(c){typeof c==="undefined"&&(c=!1);if(w||c)j("smFail",2),b.disable(c)};Ca=function(c){var a=null;if(c)if(c.match(/\.swf(\?.*)?$/i)){if(a=c.substr(c.toLowerCase().lastIndexOf(".swf?")+4))return c}else c.lastIndexOf("/")!==c.length-1&&(c+="/");return(c&&c.lastIndexOf("/")!==-1?c.substr(0,c.lastIndexOf("/")+1):"./")+b.movieURL};la=function(){if(i!==8&&i!==9)b._wD(o("badFV",i,8)),b.flashVersion=8;var c=b.debugMode||


b.debugFlash?"_debug.swf":".swf";if(b.useHTML5Audio&&!u&&b.audioFormats.mp4.required&&b.flashVersion<9)b._wD(o("needfl9")),b.flashVersion=9;i=b.flashVersion;b.version=b.versionNumber+(u?" (HTML5-only mode)":i===9?" (AS3/Flash 9)":" (AS2/Flash 8)");if(i>8)b.defaultOptions=t(b.defaultOptions,b.flash9Options),b.features.buffering=!0;i>8&&b.useMovieStar?(b.defaultOptions=t(b.defaultOptions,b.movieStarOptions),b.filePatterns.flash9=RegExp("\\.(mp3|"+b.netStreamTypes.join("|")+")(\\?.*)?$","i"),b.mimePattern=


b.netStreamMimeTypes,b.features.movieStar=!0):(b.useMovieStar=!1,b.features.movieStar=!1);b.filePattern=b.filePatterns[i!==8?"flash9":"flash8"];b.movieURL=(i===8?"soundmanager2.swf":"soundmanager2_flash9.swf").replace(".swf",c);b.features.peakData=b.features.waveformData=b.features.eqData=i>8};Aa=function(c,a){if(!b.o||!b.allowPolling)return!1;b.o._setPolling(c,a)};X=function(c,a){function e(){b._wD("-- SoundManager 2 "+b.version+(!u&&b.useHTML5Audio?b.hasHTML5?" + HTML5 audio":", no HTML5 audio support":


"")+(!u?(b.useMovieStar?", MovieStar mode":"")+(b.useHighPerformance?", high performance mode, ":", ")+((b.flashPollingInterval?"custom ("+b.flashPollingInterval+"ms)":b.useFastPolling?"fast":"normal")+" polling")+(b.wmode?", wmode: "+b.wmode:"")+(b.debugFlash?", flash debug mode":"")+(b.useFlashBlock?", flashBlock mode":""):"")+" --",1)}var f=a?a:b.url,d=b.altURL?b.altURL:f,n;n=T();var h,k,i=H(),l,m=null,m=(m=g.getElementsByTagName("html")[0])&&m.dir&&m.dir.match(/rtl/i),c=typeof c==="undefined"?


b.id:c;if(E&&K)return!1;if(u)return la(),e(),b.oMC=r(b.movieID),U(),K=E=!0,!1;E=!0;la();b.url=Ca(b._overHTTP?f:d);a=b.url;b.wmode=!b.wmode&&b.useHighPerformance&&!b.useMovieStar?"transparent":b.wmode;if(b.wmode!==null&&(s.match(/msie 8/i)||!x&&!b.useHighPerformance)&&navigator.platform.match(/win32|win64/i))b.specialWmodeCase=!0,j("spcWmode"),b.wmode=null;n={name:c,id:c,src:a,width:"100%",height:"100%",quality:"high",allowScriptAccess:b.allowScriptAccess,bgcolor:b.bgColor,pluginspage:b._http+"//www.macromedia.com/go/getflashplayer",


type:"application/x-shockwave-flash",wmode:b.wmode,hasPriority:"true"};if(b.debugFlash)n.FlashVars="debug=1";b.wmode||delete n.wmode;if(x)f=g.createElement("div"),k='<object id="'+c+'" data="'+a+'" type="'+n.type+'" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+b._http+'//download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" width="'+n.width+'" height="'+n.height+'"><param name="movie" value="'+a+'" /><param name="AllowScriptAccess" value="'+b.allowScriptAccess+


'" /><param name="quality" value="'+n.quality+'" />'+(b.wmode?'<param name="wmode" value="'+b.wmode+'" /> ':"")+'<param name="bgcolor" value="'+b.bgColor+'" />'+(b.debugFlash?'<param name="FlashVars" value="'+n.FlashVars+'" />':"")+"</object>";else for(h in f=g.createElement("embed"),n)n.hasOwnProperty(h)&&f.setAttribute(h,n[h]);wa();i=H();if(n=T())if(b.oMC=r(b.movieID)?r(b.movieID):g.createElement("div"),b.oMC.id){l=b.oMC.className;b.oMC.className=(l?l+" ":b.swfCSS.swfDefault)+(i?" "+i:"");b.oMC.appendChild(f);


if(x)h=b.oMC.appendChild(g.createElement("div")),h.className=b.swfCSS.swfBox,h.innerHTML=k;K=!0}else{b.oMC.id=b.movieID;b.oMC.className=b.swfCSS.swfDefault+" "+i;h=i=null;if(!b.useFlashBlock)if(b.useHighPerformance)i={position:"fixed",width:"8px",height:"8px",bottom:"0px",left:"0px",overflow:"hidden"};else if(i={position:"absolute",width:"6px",height:"6px",top:"-9999px",left:"-9999px"},m)i.left=Math.abs(parseInt(i.left,10))+"px";if(Oa)b.oMC.style.zIndex=1E4;if(!b.debugFlash)for(l in i)i.hasOwnProperty(l)&&


(b.oMC.style[l]=i[l]);try{x||b.oMC.appendChild(f);n.appendChild(b.oMC);if(x)h=b.oMC.appendChild(g.createElement("div")),h.className=b.swfCSS.swfBox,h.innerHTML=k;K=!0}catch(p){throw Error(o("appXHTML"));}}e();b._wD("soundManager::createMovie(): Trying to load "+a+(!b._overHTTP&&b.altURL?" (alternate URL)":""),1);return!0};p=this.getSoundById;M=function(){if(u)return X(),!1;if(b.o)return!1;b.o=b.getMovie(b.id);if(!b.o)N?(x?b.oMC.innerHTML=oa:b.oMC.appendChild(N),N=null,E=!0):X(b.id,b.url),b.o=b.getMovie(b.id);


b.o&&(b._wD("soundManager::initMovie(): Got "+b.o.nodeName+" element ("+(E?"created via JS":"static HTML")+")"),j("waitEI"));b.oninitmovie instanceof Function&&setTimeout(b.oninitmovie,1);return!0};ka=function(c){if(c)b.url=c;M()};V=function(){setTimeout(ya,500)};ya=function(){if(aa)return!1;aa=!0;q.remove(h,"load",V);if(J&&!ua)return j("waitFocus"),!1;var c;m||(c=b.getMoviePercent(),b._wD(o("waitImpatient",c===100?" (SWF loaded)":c>0?" (SWF "+c+"% loaded)":"")));setTimeout(function(){c=b.getMoviePercent();


m||(b._wD("soundManager: No Flash response within expected time.\nLikely causes: "+(c===0?"Loading "+b.movieURL+" may have failed (and/or Flash "+i+"+ not present?), ":"")+"Flash blocked or JS-Flash security error."+(b.debugFlash?" "+o("checkSWF"):""),2),!b._overHTTP&&c&&(j("localFail",2),b.debugFlash||j("tryDebug",2)),c===0&&b._wD(o("swf404",b.url)),v("flashtojs",!1,": Timed out"+b._overHTTP?" (Check flash security or flash blockers)":" (No plugin/missing SWF?)"));!m&&Ka&&(c===null?b.useFlashBlock||


b.flashLoadTimeout===0?(b.useFlashBlock&&pa(),j("waitForever")):Y(!0):b.flashLoadTimeout===0?j("waitForever"):Y(!0))},b.flashLoadTimeout)};ka=function(c){if(c)b.url=c;M()};j=function(c,a){return c?b._wD(o(c),a):""};if(D.indexOf("debug=alert")+1&&b.debugMode)b._wD=function(b){R.alert(b)};xa=function(){var c=r(b.debugID),a=r(b.debugID+"-toggle");if(!c)return!1;ha?(a.innerHTML="+",c.style.display="none"):(a.innerHTML="-",c.style.display="block");ha=!ha};v=function(b,a,e){if(typeof sm2Debugger!=="undefined")try{sm2Debugger.handleEvent(b,


a,e)}catch(f){}return!0};H=function(){var c=[];b.debugMode&&c.push(b.swfCSS.sm2Debug);b.debugFlash&&c.push(b.swfCSS.flashDebug);b.useHighPerformance&&c.push(b.swfCSS.highPerf);return c.join(" ")};pa=function(){var c=o("fbHandler"),a=b.getMoviePercent(),e=b.swfCSS;if(b.ok()){if(b.didFlashBlock&&b._wD(c+": Unblocked"),b.oMC)b.oMC.className=[H(),e.swfDefault,e.swfLoaded+(b.didFlashBlock?" "+e.swfUnblocked:"")].join(" ")}else{if(C)b.oMC.className=H()+" "+e.swfDefault+" "+(a===null?e.swfTimedout:e.swfError),


b._wD(c+": "+o("fbTimeout")+(a?" ("+o("fbLoaded")+")":""));b.didFlashBlock=!0;A({type:"ontimeout",ignoreInit:!0});b.onerror instanceof Function&&b.onerror.apply(h)}};B=function(){function c(){q.remove(h,"focus",B);q.remove(h,"load",B)}if(ua||!J)return c(),!0;ua=Ka=!0;b._wD("soundManager::handleFocus()");Q&&J&&q.remove(h,"mousemove",B);aa=!1;c();return!0};L=function(c){if(m)return!1;if(u)return b._wD("-- SoundManager 2: loaded --"),m=!0,A(),F(),!0;b.useFlashBlock&&b.flashLoadTimeout&&!b.getMoviePercent()||


(m=!0);b._wD("-- SoundManager 2 "+(w?"failed to load":"loaded")+" ("+(w?"security/load error":"OK")+") --",1);if(w||c){if(b.useFlashBlock)b.oMC.className=H()+" "+(b.getMoviePercent()===null?b.swfCSS.swfTimedout:b.swfCSS.swfError);A({type:"ontimeout"});v("onload",!1);b.onerror instanceof Function&&b.onerror.apply(h);return!1}else v("onload",!0);q.add(h,"unload",ga);if(b.waitForWindowLoad&&!ia)return j("waitOnload"),q.add(h,"load",F),!1;else b.waitForWindowLoad&&ia&&j("docLoaded"),F();return!0};ja=


function(b,a,e){typeof y[b]==="undefined"&&(y[b]=[]);y[b].push({method:a,scope:e||null,fired:!1})};A=function(c){c||(c={type:"onready"});if(!m&&c&&!c.ignoreInit)return!1;var a={success:c&&c.ignoreInit?b.ok():!w},e=c&&c.type?y[c.type]||[]:[],f=[],d,g=C&&b.useFlashBlock&&!b.ok();for(d=0;d<e.length;d++)e[d].fired!==!0&&f.push(e[d]);if(f.length){b._wD("soundManager: Firing "+f.length+" "+c.type+"() item"+(f.length===1?"":"s"));d=0;for(c=f.length;d<c;d++)if(f[d].scope?f[d].method.apply(f[d].scope,[a]):


f[d].method(a),!g)f[d].fired=!0}return!0};F=function(){h.setTimeout(function(){b.useFlashBlock&&pa();A();b.onload instanceof Function&&(j("onload",1),b.onload.apply(h),j("onloadOK",1));b.waitForWindowLoad&&q.add(h,"load",F)},1)};I=function(){if(ca!==void 0)return ca;var b=!1,a=navigator,e=a.plugins,f,d=h.ActiveXObject;if(e&&e.length)(a=a.mimeTypes)&&a["application/x-shockwave-flash"]&&a["application/x-shockwave-flash"].enabledPlugin&&a["application/x-shockwave-flash"].enabledPlugin.description&&(b=


!0);else if(typeof d!=="undefined"){try{f=new d("ShockwaveFlash.ShockwaveFlash")}catch(g){}b=!!f}return ca=b};Fa=function(){var c,a;if(s.match(/iphone os (1|2|3_0|3_1)/i)){b.hasHTML5=!1;u=!0;if(b.oMC)b.oMC.style.display="none";return!1}if(b.useHTML5Audio){if(!b.html5||!b.html5.canPlayType)return b._wD("SoundManager: No HTML5 Audio() support detected."),b.hasHTML5=!1,!0;else b.hasHTML5=!0;if(ta&&(b._wD("soundManager::Note: Buggy HTML5 Audio in Safari on this OS X release, see https://bugs.webkit.org/show_bug.cgi?id=32159 - "+


(!ca?" would use flash fallback for MP3/MP4, but none detected.":"will use flash fallback for MP3/MP4, if available"),1),I()))return!0}else return!0;for(a in b.audioFormats)b.audioFormats.hasOwnProperty(a)&&b.audioFormats[a].required&&!b.html5.canPlayType(b.audioFormats[a].type)&&(c=!0);b.ignoreFlash&&(c=!1);u=b.useHTML5Audio&&b.hasHTML5&&!c&&!b.requireFlash;return I()&&c};U=function(){var c,a=[];j("init");if(m)return j("didInit"),!1;if(b.hasHTML5){for(c in b.audioFormats)b.audioFormats.hasOwnProperty(c)&&


a.push(c+": "+b.html5[c]);b._wD("-- SoundManager 2: HTML5 support tests ("+b.html5Test+"): "+a.join(", ")+" --",1)}if(u){if(!m)q.remove(h,"load",b.beginDelayedInit),b.enabled=!0,L();return!0}M();try{j("flashJS"),b.o._externalInterfaceTest(!1),b.allowPolling?Aa(!0,b.flashPollingInterval?b.flashPollingInterval:b.useFastPolling?10:50):j("noPolling",1),b.debugMode||b.o._disableDebug(),b.enabled=!0,v("jstoflash",!0)}catch(e){return b._wD("js/flash exception: "+e.toString()),v("jstoflash",!1),Y(!0),L(),


!1}L();q.remove(h,"load",b.beginDelayedInit);return!0};za=function(){if(ra)return!1;X();M();return ra=!0};G=function(){if(ma)return!1;ma=!0;wa();if(!b.useHTML5Audio&&!I())b._wD("SoundManager: No Flash detected, trying HTML5"),b.useHTML5Audio=!0;Ga();b.html5.usingFlash=Fa();C=b.html5.usingFlash;ma=!0;g.removeEventListener&&g.removeEventListener("DOMContentLoaded",G,!1);ka();return!0};Da=function(b){if(!b._hasTimer)b._hasTimer=!0};Ea=function(b){if(b._hasTimer)b._hasTimer=!1};na=function(){if(b.onerror instanceof


Function)b.onerror();b.disable()};Ia=function(){if(!ta||!I())return!1;var c=b.audioFormats,a,e;for(e in c)if(c.hasOwnProperty(e)&&(e==="mp3"||e==="mp4"))if(b._wD("soundManager: Using flash fallback for "+e+" format"),b.html5[e]=!1,c[e]&&c[e].related)for(a=c[e].related.length;a--;)b.html5[c[e].related[a]]=!1};this._setSandboxType=function(c){var a=b.sandbox;a.type=c;a.description=a.types[typeof a.types[c]!=="undefined"?c:"unknown"];b._wD("Flash security sandbox type: "+a.type);if(a.type==="localWithFile")a.noRemote=


!0,a.noLocal=!1,j("secNote",2);else if(a.type==="localWithNetwork")a.noRemote=!1,a.noLocal=!0;else if(a.type==="localTrusted")a.noRemote=!1,a.noLocal=!1};this._externalInterfaceOK=function(c){if(b.swfLoaded)return!1;var a=(new Date).getTime();b._wD("soundManager::externalInterfaceOK()"+(c?" (~"+(a-c)+" ms)":""));v("swf",!0);v("flashtojs",!0);b.swfLoaded=!0;J=!1;ta&&Ia();x?setTimeout(U,100):U()};sa=function(){g.readyState==="complete"&&(G(),g.detachEvent("onreadystatechange",sa));return!0};if(!b.hasHTML5||


C)q.add(h,"focus",B),q.add(h,"load",B),q.add(h,"load",V),Q&&J&&q.add(h,"mousemove",B);g.addEventListener?g.addEventListener("DOMContentLoaded",G,!1):g.attachEvent?g.attachEvent("onreadystatechange",sa):(v("onload",!1),na());g.readyState==="complete"&&setTimeout(G,100)}var da=null;if(typeof SM2_DEFER==="undefined"||!SM2_DEFER)da=new S;R.SoundManager=S;R.soundManager=da})(window);








soundManager.url = '/ajax/js/soundmanager2.swf';


soundManager.debugMode = false;


soundManager.consoleOnly = false;





var file,id,oldId,oldFile,player=false;





$(function(){


	$('.play').click(function(){


		id = $(this).attr('id');


		file = $(this).attr('file');		


		


		if(player == true && id != oldId){


			stop(oldFile);


			$('#'+oldId).next().fadeOut(10);


			$('#'+oldId).delay(10).fadeIn(10);


		}


		player = true;


		//alert(oldId);


		oldId = id;		


		oldFile = file;		


		play(file,id);


		$(this).fadeOut(200);


		$(this).next().delay(200).fadeIn(300);


	});


});


$(function(){


	$('.pause').click(function(){


		file = $(this).prev().attr('file');


		//alert(file);


		pause(file);


		$(this).fadeOut(200);


		$(this).prev().delay(200).fadeIn(300);


	});


});











function play(file,id){


soundManager.createSound(file,''+file);


soundManager.setVolume(file, 100);


//alert(id);


soundManager.play(file,{onfinish: function() {


	id = parseFloat(id);


	newId = id + 1;


	newFile = $('#'+newId).attr('file');


	//alert(newFile+'---'+newId);


	if(newFile != undefined){


		play(newFile,newId);


		$('#'+id).next().fadeOut(10);


		$('#'+id).delay(10).fadeIn(10);


		$('#'+newId).fadeOut(10);


		$('#'+newId).next().delay(10).fadeIn(10);


	}else{


		$('#'+id).next().fadeOut(10);


		$('#'+id).delay(10).fadeIn(10);


		//alert('end');


	}


	


}


});





}


function pause(file){


soundManager.pause(file);


}


function stop(oldId){


soundManager.stop(oldId);


}