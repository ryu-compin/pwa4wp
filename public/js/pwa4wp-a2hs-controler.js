// defer install popup
var pwa4wp_installevent;
console.log("a2hs controller loaded");
window.addEventListener('beforeinstallprompt', function (event) {
    console.log("install event occured");
    event.preventDefault();
    window.pwa4wp_installevent = event;
    if(typeof pwa4wp_open_install == 'function'){
        pwa4wp_open_install();
        console.log("call function - pwa4wp_open_install");
    }else{
        console.log("funtion pwa4wp_open_install does not exist, do nothing.");
    }
    return false;
});
console.log("a2hs controller exit");

