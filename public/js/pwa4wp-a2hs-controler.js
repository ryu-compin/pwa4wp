// defer install popup
    window.addEventListener('beforeinstallprompt', function (event) {
        if(this.debug){
            console.log("install event occured");
        }

        event.preventDefault();
        pwa4wp_installevent = event;
        if(typeof pwa4wp_open_install == 'function'){
            pwa4wp_open_install();
            if(this.debug){
                console.log("call function - pwa4wp_open_install");
            }
        }else{
            if(this.debug){
                console.log("funtion pwa4wp_open_install does not exist, do nothing.");
            }
        }
        return false;
    });

