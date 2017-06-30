function setDPR(){
    var desWidth=750;
document.getElementById('viewport').setAttribute('content','width=device-width,initial-scale=1,user-scalable=no,width=750,maximum-scale='+window.screen.width/750);
var iWidth = Math.min(document.documentElement.clientWidth, window.innerWidth);
//定义1rem宽度
document.getElementsByTagName('html')[0].style.fontSize=(((100*iWidth)/desWidth))+'px';
};
setDPR();
$(window).resize(function() {setDPR();});